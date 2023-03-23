<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PersyaratanGaji;
use App\Models\PersyaratanPangkat;
use App\Models\PersyaratanPensiun;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Validation\Rule;

class PersyaratanController extends Controller
{
    public function getPersyaratanGaji()
    {
        $persyaratanGajis = PersyaratanGaji::get();
        return view('dashboard.admin.persyaratan-gaji', compact('persyaratanGajis'));
    }

    public function getPersyaratanPangkat()
    {
        $persyaratanPangkats = PersyaratanPangkat::get();
        return view('dashboard.admin.persyaratan-pangkat', compact('persyaratanPangkats'));
    }

    public function getPersyaratanPensiun()
    {
        $persyaratanPensiuns = PersyaratanPensiun::get();
        return view('dashboard.admin.persyaratan-pensiun', compact('persyaratanPensiuns'));         
    }

    // Persyaratan Gaji
    public function createPersyaratanGaji(Request $request, PersyaratanGaji $persyaratanGaji)
    {
        $validate = $request->validate([
            'nama' => 'required|string|unique:persyaratan_gajis',
        ]);

        $persyaratanGaji->create($validate);

        Alert::toast('<p style="color: white; margin-top: 10px;">Persyaratan gaji berhasil ditambahkan</p>','success')
        ->toHtml()
        ->background('#212529')
        ->position($position = 'bottom-right');

        return redirect()->route('persyaratan-gaji.index');
    }

    public function updatePersyaratanGaji(Request $request, PersyaratanGaji $persyaratanGaji)
    {
        $validate = $request->validate([
            'nama' => ['required','string', Rule::unique('persyaratan_gajis')->ignore($persyaratanGaji->id)],
        ]);

        $persyaratanGaji->update($validate);

        Alert::toast('<p style="color: white; margin-top: 10px;">Persyaratan gaji berhasil diperbarui</p>','success')
        ->toHtml()
        ->background('#212529')
        ->position($position = 'bottom-right');

        return redirect()->route('persyaratan-gaji.index');
    }

    public function deletePersyaratanGaji(PersyaratanGaji $persyaratanGaji)
    {
        $persyaratanGaji->delete();

        Alert::toast('<p style="color: white; margin-top: 10px;">Persyaratan gaji berhasil dihapus</p>','success')
        ->toHtml()
        ->background('#212529')
        ->position($position = 'bottom-right');

        return redirect()->route('persyaratan-gaji.index');
    }

    // Persyaratan Pangkat
    public function createPersyaratanPangkat(Request $request, PersyaratanPangkat $persyaratanPangkat)
    {
        $validate = $request->validate([
            'nama' => 'required|string|unique:persyaratan_pangkats',
        ]);

        $persyaratanPangkat->create($validate);

        Alert::toast('<p style="color: white; margin-top: 10px;">Persyaratan pangkat berhasil ditambahkan</p>','success')
        ->toHtml()
        ->background('#212529')
        ->position($position = 'bottom-right');

        return redirect()->route('persyaratan-pangkat.index');
    }

    public function updatePersyaratanPangkat(Request $request, PersyaratanPangkat $persyaratanPangkat)
    {
        $validate = $request->validate([
            'nama' => ['required','string', Rule::unique('persyaratan_pangkats')
            ->ignore($persyaratanPangkat->id)],
        ]);

        $persyaratanPangkat->update($validate);

        Alert::toast('<p style="color: white; margin-top: 10px;">Persyaratan pangkat berhasil diperbarui</p>','success')
        ->toHtml()
        ->background('#212529')
        ->position($position = 'bottom-right');

        return redirect()->route('persyaratan-pangkat.index');
    }

    public function deletePersyaratanPangkat(PersyaratanPangkat $persyaratanPangkat)
    {
        $persyaratanPangkat->delete();

        Alert::toast('<p style="color: white; margin-top: 10px;">Persyaratan pangkat berhasil dihapus</p>','success')
        ->toHtml()
        ->background('#212529')
        ->position($position = 'bottom-right');

        return redirect()->route('persyaratan-pangkat.index');
    }

    // Persyaratan Pensiun
    public function createPersyaratanPensiun(Request $request, PersyaratanPensiun $persyaratanPensiun)
    {
        $validate = $request->validate([
            'nama' => 'required|string|unique:persyaratan_pensiuns',
        ]);

        $persyaratanPensiun->create($validate);

        Alert::toast('<p style="color: white; margin-top: 10px;">Persyaratan pensiun berhasil ditambahkan</p>','success')
        ->toHtml()
        ->background('#212529')
        ->position($position = 'bottom-right');

        return redirect()->route('persyaratan-pensiun.index');
    }

    public function updatePersyaratanPensiun(Request $request, PersyaratanPensiun $persyaratanPensiun)
    {
        $validate = $request->validate([
            'nama' => ['required','string', Rule::unique('persyaratan_pensiuns')
            ->ignore($persyaratanPensiun->id)],
        ]);

        $persyaratanPensiun->update($validate);

        Alert::toast('<p style="color: white; margin-top: 10px;">Persyaratan pensiun berhasil diperbarui</p>','success')
        ->toHtml()
        ->background('#212529')
        ->position($position = 'bottom-right');

        return redirect()->route('persyaratan-pensiun.index');
    }

    public function deletePersyaratanPensiun(PersyaratanPensiun $persyaratanPensiun)
    {
        $persyaratanPensiun->delete();

        Alert::toast('<p style="color: white; margin-top: 10px;">Persyaratan pensiun berhasil dihapus</p>','success')
        ->toHtml()
        ->background('#212529')
        ->position($position = 'bottom-right');

        return redirect()->route('persyaratan-pensiun.index');
    }
}
