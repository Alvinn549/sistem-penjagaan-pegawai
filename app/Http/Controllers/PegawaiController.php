<?php    

namespace App\Http\Controllers;  

use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\Pegawai;
use App\Models\TmtGajiSelesai;
use App\Models\TmtPangkatSelesai;
use App\Models\TmtPensiunSelesai;
use App\Models\Persyaratan;
use Session; 
use Carbon\Carbon; 
use Illuminate\Validation\Rule;

class PegawaiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response 
     */
    public function index(Request $request)
    {
        return view('dashboard.admin.pegawai'); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $validate = $request->validate([
            'nama' => 'required|string|max:64',
            'tanggal_lahir' => 'required|date',
            'nip' => 'required|numeric|unique:pegawais',
            'jabatan' => ['required','string','regex:/^[\pL\s\-]+$/u',function ($attribute, $value, $fail) {
                $getKadin = Pegawai::where([
                    ['status','=' ,'aktif'],
                    ['jabatan','like', '%Kepala Dinas%']
                ])->get('jabatan')->first();

                if($getKadin){
                    if (strcasecmp($value, $getKadin->jabatan)  == 0) 
                    {
                        $fail('Kepala Dinas sekarang masih aktif ! ');
                    }
                }
            }
        ],
        'eselon' => 'required',
        'golongan' =>'required|string',
        'tmt_capeg' => 'required|date',
        'pendidikan_capeg' => 'required|string|regex:/^[\pL\s\-]+$/u',
        'pendidikan_terakhir' => 'required|string|regex:/^[\pL\s\-]+$/u',
        'tmt_gaji_berkala' => 'required|date',
        'tmt_p_terakhir' => 'required|date',
    ]);

        if ($request->eselon == 'II A' || $request->eselon == 'II B') 
        {
            $tanggal_pensiun = Carbon::parse($request->tanggal_lahir)->startOfMonth()->addMonths(1)->addYears(60);
        } 
        else
        {
            $tanggal_pensiun = Carbon::parse($request->tanggal_lahir)->startOfMonth()->addMonths(1)->addYears(58);
        }

        $pegawai = Pegawai::create([
            'nama' => $request->nama,
            'tanggal_lahir' => $request->tanggal_lahir,
            'nip' => $request->nip,
            'jabatan' => $request->jabatan,
            'golongan' => $request->golongan,
            'eselon' => $request->eselon,
            'tmt_capeg' => $request->tmt_capeg,
            'pendidikan_capeg' => $request->pendidikan_capeg,
            'pendidikan_terakhir' => $request->pendidikan_terakhir,
            'tmt_gaji_berkala' => Carbon::parse($request->tmt_gaji_berkala)->startOfMonth(),
            'tmt_p_terakhir' => Carbon::parse($request->tmt_p_terakhir)->startOfMonth(),
            'tmt_pensiun' => $tanggal_pensiun
        ]);

        Alert::toast('<p style="color: white; margin-top: 10px;">'.$pegawai->nama.' berhasil disimpan</p>','success')
        ->toHtml()
        ->background('#212529')
        ->position($position = 'bottom-right');

        return redirect()->route('pegawai.index');
    } 

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pegawai  $pegawai
     * @return \Illuminate\Http\Response
     */
    public function show(Pegawai $pegawai)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pegawai  $pegawai
     * @return \Illuminate\Http\Response
     */
    public function edit(Pegawai $pegawai)
    {
        return view('dashboard.admin.pegawai-edit', compact('pegawai'));
    }
 
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pegawai  $pegawai
     * @return \Illuminate\Http\Response
     */ 
    public function update(Request $request, Pegawai $pegawai)
    {
        if(request('process-gaji-berkala')) 
        {
            if(request('update-persyaratan-gaji-berkala')) 
            {
                if($request->persyaratan == null)
                {
                    Alert::toast('<p style="color: white; margin-top: 10px;">Persyaratan gaji berkala tidak boleh kosong</p>','error')
                    ->toHtml()
                    ->background('#212529')
                    ->position($position = 'bottom-right');

                    return back(); 
                }

                $persyaratan = Persyaratan::where('pegawai_id', $pegawai->id)->first();
                $persyaratan->update(['p_gaji_berkala' => $request->persyaratan]);

                Alert::toast('<p style="color: white; margin-top: 10px;">Persyaratan gaji berkala '.$pegawai->nama.' berhasil diperbarui</p>','success')
                ->toHtml()
                ->background('#212529')
                ->position($position = 'bottom-right');

                return back();
            }

            $validate = $request->validate(['tmt_gaji_berkala' => 'required|date']);

            if(Carbon::parse($pegawai->persyaratan->updated_at) <= Carbon::today() || $pegawai->persyaratan['p_gaji_berkala'] == null ) 
            {
                Alert::toast('<p style="color: white; margin-top: 10px;">Persyaratan '.$pegawai->nama.' belum diperbarui</p>','error')
                ->toHtml()
                ->background('#212529')
                ->position($position = 'bottom-right');

                return back();
            } 

            if($request->tmt_gaji_berkala < Carbon::parse($pegawai->tmt_gaji_berkala)->startOfMonth()->subMonths(1)->addYears(2) ) 
            {

                Alert::toast('<p style="color: white; margin-top: 10px;">Masukkan tanggal lebih dari tmt berkala yang baru</p>','error')
                ->toHtml()
                ->background('#212529')
                ->position($position = 'bottom-right');

                return back();
            } 

            $tmt_gaji_selesai = TmtGajiSelesai::create([
                'pegawai_id' => $pegawai->id,
                'tmt_gaji_lama' => $pegawai->tmt_gaji_berkala,
                'tmt_gaji_baru' => $request->tmt_gaji_berkala,
                'tanggal_diproses' => now(),
            ]);

            $pegawai->update($validate);

            Alert::toast('<p style="color: white; margin-top: 10px;">TMT gaji berkala '.$pegawai->nama.' berhasil diperbarui</p>','success')
            ->toHtml()
            ->background('#212529')
            ->position($position = 'bottom-right');

            return redirect()->route('dashboard');
        }
        elseif(request('proccess-kenaikan-pangkat')) 
        {
            if (isset($request->persyaratan)) {
                $persyaratan = Persyaratan::where('pegawai_id', $pegawai->id)->first();
                $persyaratan->update(['p_pangkat' => $request->persyaratan]);

                Alert::toast('<p style="color: white; margin-top: 10px;">Persyaratan gaji berkala '.$pegawai->nama.' berhasil diperbarui</p>','success')
                ->toHtml()
                ->background('#212529')
                ->position($position = 'bottom-right');

                return back(); 
            }

            $validate = $request->validate(['tmt_p_terakhir' => 'required|date']);

            if(Carbon::parse($pegawai->persyaratan->updated_at) <= Carbon::today() || $pegawai->persyaratan['p_pangkat'] == null ) 
            {
                Alert::toast('<p style="color: white; margin-top: 10px;">Persyaratan '.$pegawai->nama.' belum diperbarui</p>','error')
                ->toHtml()
                ->background('#212529')
                ->position($position = 'bottom-right');

                return back();
            } 

            if($request->tmt_p_terakhir < Carbon::parse($pegawai->tmt_p_terakhir)->startOfMonth()->subMonths(1)->addYears(4)) 
            {

                Alert::toast('<p style="color: white; margin-top: 10px;">Masukkan tanggal lebih dari tmt pangkat yang baru</p>','error')
                ->toHtml()
                ->background('#212529')
                ->position($position = 'bottom-right');

                return back();

            }

            // dd($request->all());

            $tmt_pangkat_selesai = TmtPangkatSelesai::create([
                'pegawai_id' => $pegawai->id,
                'tmt_pangkat_lama' => $pegawai->tmt_p_terakhir,
                'tmt_pangkat_baru' => $request->tmt_p_terakhir,
                'tanggal_diproses' => now(),
            ]);

            $pegawai->update($validate);


            Alert::toast('<p style="color: white; margin-top: 10px;">TMT pangkat '.$pegawai->nama.' berhasil diperbarui</p>','success')
            ->toHtml()
            ->background('#212529')
            ->position($position = 'bottom-right');

            return redirect()->route('dashboard');

        }
        elseif(request('proccess-pensiun')) 
        {
            if (isset($request->persyaratan)) {
                // dd($request->all());
                $persyaratan = Persyaratan::where('pegawai_id', $pegawai->id)->first();
                $persyaratan->update(['p_pensiun' => $request->persyaratan]);

                Alert::toast('<p style="color: white; margin-top: 10px;">Persyaratan pensiun '.$pegawai->nama.' berhasil diperbarui</p>','success')
                ->toHtml()
                ->background('#212529')
                ->position($position = 'bottom-right');

                return back();  
            }

            if(!$request->status)
            {
                Alert::toast('<p style="color: white; margin-top: 10px;">Status '.$pegawai->nama.' belum di checklist </p>','error')
                ->toHtml()
                ->background('#212529')
                ->position($position = 'bottom-right');
                return back();
            }

            if(Carbon::parse($pegawai->persyaratan->updated_at) <= Carbon::today() || $pegawai->persyaratan['p_pensiun'] == null ) 
            {
                Alert::toast('<p style="color: white; margin-top: 10px;">Persyaratan '.$pegawai->nama.' belum diperbarui</p>','error')
                ->toHtml()
                ->background('#212529')
                ->position($position = 'bottom-right');

                return back();
            }
            // dd($request->all());

            $tmt_pensiun_selesai = TmtPensiunSelesai::create([
                'pegawai_id' => $pegawai->id,
                'tmt_pensiun_lama' => $pegawai->tmt_pensiun,
                'tanggal_diproses' => now(),
            ]);

            $pegawai->update([
                'status' => $request->status
            ]);

            Alert::toast('<p style="color: white; margin-top: 10px;">'.$pegawai->nama.' berhasil diperbarui</p>','success')
            ->toHtml()
            ->background('#212529')
            ->position($position = 'bottom-right');

            return redirect()->route('dashboard');

        }

        $validate = $request->validate([
            'nama' => 'required|string',
            'nip' => ['required','numeric', Rule::unique('pegawais')->ignore($pegawai->id)],
            'golongan' =>'required|string',
            'jabatan' => 'required|string|regex:/^[\pL\s\-]+$/u',
            'eselon' => 'required',
            'tmt_capeg' => 'required|date',
            'pendidikan_capeg' => 'required|string',
            'pendidikan_terakhir' => 'required|string',
            'tmt_p_terakhir' => 'required|date',
            'tmt_gaji_berkala' => 'required|date',
        ]);

        if ($request->eselon == 'II A' || $request->eselon == 'II B') 
        {
            $tanggal_pensiun = Carbon::parse($request->tanggal_lahir)->startOfMonth()->addMonths(1)->addYears(60);
        } 
        else
        {
            $tanggal_pensiun = Carbon::parse($request->tanggal_lahir)->startOfMonth()->addMonths(1)->addYears(58);
        }

        $getKadin = Pegawai::where([
            ['status','=' ,'aktif'],
            ['jabatan','like', '%Kepala Dinas%']
        ])->get(['id', 'jabatan'])->first();
        
        if ($getKadin) 
        {
            if (strcasecmp($request->jabatan, $getKadin->jabatan) == 0)
            {
                if($pegawai->id != $getKadin->id) 
                {
                    Alert::warning('Peringatan','Kepala Dinas saat ini masih aktif');
                    return back();
                }
            }
        }

        $pegawai->update([
            'nama' => $request->nama,
            'tanggal_lahir' => $request->tanggal_lahir,
            'nip' => $request->nip,
            'eselon' => $request->eselon,
            'golongan' => $request->golongan,
            'jabatan' => $request->jabatan,
            'tmt_capeg' => $request->tmt_capeg,
            'pendidikan_capeg' => $request->pendidikan_capeg,
            'pendidikan_terakhir' => $request->pendidikan_terakhir,
            'tmt_gaji_berkala' => Carbon::parse($request->tmt_gaji_berkala)->startOfMonth(),
            'tmt_p_terakhir' => Carbon::parse($request->tmt_p_terakhir)->startOfMonth(),
            'tmt_pensiun' => $tanggal_pensiun
        ]);

        Alert::toast('<p style="color: white; margin-top: 10px;">'.$pegawai->nama.' berhasil diperbarui</p>','success')
        ->toHtml()
        ->background('#212529')
        ->position($position = 'bottom-right');

        return redirect()->route('pegawai.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pegawai  $pegawai
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pegawai $pegawai)
    {
        $getKadin = Pegawai::where([
            ['status','=' ,'aktif'],
            ['jabatan','like', '%Kepala Dinas%']
        ])->get(['id', 'jabatan'])->first();

        if ($getKadin) 
        {
            if($pegawai->id == $getKadin->id) {
                Alert::warning('Peringatan','Kepala Dinas saat ini masih aktif');
                return back();
            }
        }

        $pegawai->delete();

        Alert::toast('<p style="color: white; margin-top: 10px;">'.$pegawai->nama.' berhasil dihapus</p>','success')
        ->toHtml()
        ->background('#212529')
        ->position($position = 'bottom-right');

        return redirect()->route('pegawai.index');
    }
}
