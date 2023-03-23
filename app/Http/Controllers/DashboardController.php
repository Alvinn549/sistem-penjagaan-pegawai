<?php  

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pegawai;
use App\Models\TmtGajiSelesai;
use App\Models\TmtPangkatSelesai;
use App\Models\TmtPensiunSelesai;
use App\Models\PersyaratanGaji;
use App\Models\PersyaratanPangkat;
use App\Models\PersyaratanPensiun;
use Carbon\Carbon;

class DashboardController extends Controller
{

    public function index()
    {
        $today = Carbon::today()->isoFormat('dddd, D MMMM Y');

        $process_tmt_gaji_count = 0;
        $process_tmt_pangkat_count = 0;
        $process_tmt_pensiun_count = 0;

        $tmt_gaji_done_count = count(TmtGajiSelesai::get('id'));
        $tmt_pangkat_done_count = count(TmtPangkatSelesai::get('id'));
        $tmt_pensiun_done_count = count(TmtPensiunSelesai::get('id'));

        $pegawais = Pegawai::where('status', 'aktif')
        ->get(['id','tmt_gaji_berkala','tmt_p_terakhir','tmt_pensiun']);

        foreach($pegawais as $pegawai) 
        {
            if($pegawai->tmt_gaji_berkala)
            {
                if (Carbon::parse($pegawai->tmt_gaji_berkala)->startOfMonth()->addYears(2) <= today()) 
                {
                // tmt_gaji_expired_count
                    $process_tmt_gaji_count++;

                } 
                elseif(Carbon::today()->diffInDays(Carbon::parse($pegawai->tmt_gaji_berkala)->startOfMonth()->addYears(2)) <= 61 ) 
                {

                    $process_tmt_gaji_count++;

                }
            }

            if($pegawai->tmt_p_terakhir)
            {
                if (Carbon::parse($pegawai->tmt_p_terakhir)->startOfMonth()->addYears(4) <= today() ) 
                {

                    $process_tmt_pangkat_count++;

                }
                elseif (Carbon::today()->diffInDays(Carbon::parse($pegawai->tmt_p_terakhir)->startOfMonth()->addYears(4)) <= 61 ) 
                {

                    $process_tmt_pangkat_count++;

                }
            }

            if ($pegawai->tmt_pensiun) 
            {
                if (Carbon::parse($pegawai->tmt_pensiun) <= today() ) 
                {

                    $process_tmt_pensiun_count++;
                    
                }
                elseif(Carbon::today()->diffInMonths(Carbon::parse($pegawai->tmt_pensiun)) <= 12)
                {

                    $process_tmt_pensiun_count++;

                }
            }
        }
        // dd($process_tmt_pensiun_count);

        return view('dashboard.admin.index', compact([
            'today',
            'process_tmt_gaji_count',
            'process_tmt_pangkat_count',
            'process_tmt_pensiun_count' ,
            'tmt_gaji_done_count',
            'tmt_pangkat_done_count' ,
            'tmt_pensiun_done_count'
        ]));
    }

    public function proccessTmtGajiBerkala()
    { 
        $count = 0;

        $tmt_gaji_lists = Pegawai::where('status', 'aktif')
        ->with('persyaratan')
        ->orderBy('tmt_gaji_berkala', 'ASC')
        ->get(['id','nama','nip','tmt_gaji_berkala']);

        $persyaratanGajis = PersyaratanGaji::get();

        foreach($tmt_gaji_lists as $tmt_gaji_list) 
        {
            if(Carbon::parse($tmt_gaji_list->tmt_gaji_berkala)->startOfMonth()->addYears(2) <= today())
            {
                $count++;
            }
            elseif(Carbon::today()->diffInDays(Carbon::parse($tmt_gaji_list->tmt_gaji_berkala)->startOfMonth()->addYears(2)) <= 61)
            {
                $count++;
            }
        }

        return view('dashboard.admin.process-tmt-gaji' , compact([
            'count',
            'tmt_gaji_lists',
            'persyaratanGajis'
        ]));
    }

    public function proccessTmtPangkat()
    {
        $count = 0;

        $tmt_pangkat_lists = Pegawai::where('status', 'aktif')
        ->with('persyaratan')
        ->orderBy('tmt_p_terakhir', 'ASC')
        ->get(['id','nama','nip','tmt_p_terakhir']);

        $persyaratanPangkats = PersyaratanPangkat::get();

        foreach($tmt_pangkat_lists as $tmt_pangkat_list){
            if (Carbon::parse($tmt_pangkat_list->tmt_p_terakhir)->startOfMonth()->addYears(4)->startOfDay() <= today() ) 
            {

                $count++;

            }
            elseif (Carbon::today()->diffInDays(Carbon::parse($tmt_pangkat_list->tmt_p_terakhir)->startOfMonth()->addYears(4)) <= 61) 
            {

                $count++;

            }
        }
        // dd($count);

        return view('dashboard.admin.process-tmt-pangkat' , compact([
            'count',
            'tmt_pangkat_lists',
            'persyaratanPangkats'
        ]));
    }

    public function proccessPensiun()
    {
        $count = 0;

        $tmt_pensiun_lists = Pegawai::where('status', 'aktif')
        ->with('persyaratan')
        ->orderBy('tmt_pensiun', 'ASC')
        ->get(['id','nama','nip','tmt_pensiun']);

        // dd($tmt_pensiun_lists);

        $persyaratanPensiuns = PersyaratanPensiun::get();

        foreach($tmt_pensiun_lists as $tmt_pensiun_list) 
        {
            if(Carbon::parse($tmt_pensiun_list->tmt_pensiun) <= today())
            {
                $count++;
            }
            elseif(Carbon::today()->diffInMonths(Carbon::parse($tmt_pensiun_list->tmt_pensiun)) <= 12)
            {
                $count++;
            }
        }

        // dd($count);

        return view('dashboard.admin.process-pensiun' , compact([
            'count',
            'tmt_pensiun_lists', 
            'persyaratanPensiuns'
        ]));
    }

    public function getTmtPangkatDone()
    {
        $tmt_pangkat_dones = TmtPangkatSelesai::with('pegawai')->latest()->get();

        return view('dashboard.admin.tmt-pangkat-done', compact(['tmt_pangkat_dones']));
    }

    public function getTmtGajiDone()
    {
        $tmt_gaji_dones = TmtGajiSelesai::with('pegawai')->latest()->get();

        return view('dashboard.admin.tmt-gaji-done', compact(['tmt_gaji_dones']));
    }

    public function getTmtPensiunDone()
    {
        $tmt_pensiun_dones = TmtPensiunSelesai::with('pegawai')->latest()->get();

        return view('dashboard.admin.tmt-pensiun-done', compact(['tmt_pensiun_dones']));
    }
}
