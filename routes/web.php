<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PersyaratanController;
use App\Models\Pegawai;
use App\Models\Persyaratan;
use App\Models\TmtGajiSelesai;
use Carbon\Carbon;
/*  
|------------------------------------------------- -------------------------
| Web Routes SPP
|--------------------------------------------------------------------------
*/ 
Route::get('/tes', function () {

    $p = Pegawai::with('persyaratan')->get();

    $t = Persyaratan::with('pegawai')->find(1);

    $s = TmtGajiSelesai::find(1);

    $r = Pegawai::where('status', 'pensiun')->get();
    // dd($r);
    $d = Pegawai::where([
        ['status','=' ,'aktif'],
        ['jabatan','like', '%kepala dinas%']
    ])->get(['nama','jabatan']);
    dd($d);

    // dd($p->persyaratan->p_gaji_berkala);
    return view('tes', compact('p'));
});
// index
Route::get('/', function () {
    $pegawais = Pegawai::with('persyaratan')
    ->where('status', 'aktif')
    ->get(['id','nama','tmt_p_terakhir','tmt_gaji_berkala','tmt_pensiun']);

    return view('index', compact('pegawais'));
})->name('home');
// Login
Route::get('/login', [LoginController::class, 'index'])->middleware('guest')->name('login');
// Authentication
Route::post('/login', [LoginController::class, 'authenticate'])->name('authenticate');
// Prevent logout with url
Route::get('/logout', function () {
    return view('404');
});
// Route access denied
Route::get('/access-denied', function () {
    return view('401');
})->name('access-denied');

Route::group(['middleware' => 'auth'], function(){
    // logout
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
    // dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::group(['middleware' => 'admin'], function(){
        // Get TMT gaji Expired
        Route::get('/dashboard/process-tmt-gaji', [DashboardController::class, 'proccessTmtGajiBerkala'])
        ->name('process-tmt-gaji');
        // Get TMT gaji Done
        Route::get('/dashboard/tmt-gaji-done', [DashboardController::class, 'getTmtGajiDone'])
        ->name('tmt-gaji-done');
        // Get TMT pangkat Expired
        Route::get('/dashboard/process-tmt-pangkat', [DashboardController::class, 'proccessTmtPangkat'])
        ->name('process-tmt-pangkat');
        // Get TMT pangkat Done
        Route::get('/dashboard/tmt-pangkat-done', [DashboardController::class, 'getTmtPangkatDone'])
        ->name('tmt-pangkat-done');
        // Get TMT pensiun Expired
        Route::get('/dashboard/process-tmt-pensiun', [DashboardController::class, 'proccessPensiun'])
        ->name('process-tmt-pensiun');
        // Get TMT pensiun Done
        Route::get('/dashboard/tmt-pensiun-done', [DashboardController::class, 'getTmtPensiunDone'])
        ->name('tmt-pensiun-done');
        // Get pegawai list 
        Route::resource('pegawai', PegawaiController::class)->except(['create','show']);
        // Get admin list
        Route::resource('admin', AdminController::class)->except(['create','show']);

        Route::name('persyaratan-gaji.')->group(function () {
            // Get persyaratan gaji
            Route::get('/persyaratan/gaji', [PersyaratanController::class, 'getPersyaratanGaji'])
            ->name('index');
            // create persyaratan gaji
            Route::post('/persyaratan/gaji/create', [PersyaratanController::class, 'createPersyaratanGaji'])
            ->name('create');
            // update persyaratan gaji
            Route::put('/persyaratan/gaji/{persyaratanGaji}', [PersyaratanController::class, 'updatePersyaratanGaji'])
            ->name('update');
            // delete persyaratan gaji
            Route::delete('/persyaratan/gaji/{persyaratanGaji}', [PersyaratanController::class, 'deletePersyaratanGaji'])
            ->name('delete');
        });

        Route::name('persyaratan-pangkat.')->group(function () {
            // Get persyaratan pangkat
            Route::get('/persyaratan/pangkat', [PersyaratanController::class, 'getPersyaratanPangkat'])
            ->name('index');
            // create persyaratan pangkat
            Route::post('/persyaratan/pangkat/create', [PersyaratanController::class, 'createPersyaratanPangkat'])
            ->name('create');
            // update persyaratan pangkat
            Route::put('/persyaratan/pangkat/{persyaratanPangkat}', [PersyaratanController::class, 'updatePersyaratanPangkat'])
            ->name('update');
            // delete persyaratan pangkat
            Route::delete('/persyaratan/pangkat/{persyaratanPangkat}', [PersyaratanController::class, 'deletePersyaratanPangkat'])
            ->name('delete');
        });

        Route::name('persyaratan-pensiun.')->group(function () {
            // Get persyaratan pensiun
            Route::get('/persyaratan/pensiun', [PersyaratanController::class, 'getPersyaratanPensiun'])
            ->name('index');
            // create persyaratan pensiun
            Route::post('/persyaratan/pensiun/create', [PersyaratanController::class, 'createPersyaratanPensiun'])
            ->name('create');
            // update persyaratan pensiun
            Route::put('/persyaratan/pensiun/{persyaratanPensiun}', [PersyaratanController::class, 'updatePersyaratanPensiun'])
            ->name('update');
            // delete persyaratan pensiun
            Route::delete('/persyaratan/pensiun/{persyaratanPensiun}', [PersyaratanController::class, 'deletePersyaratanPensiun'])
            ->name('delete');
        });

    });
    
    Route::name('settings.')->group(function () {
        // Get setting page
        Route::get('/settings', [SettingsController::class, 'index'])->name('index');
        // Update user login
        Route::put('/settings/update/{user}', [SettingsController::class, 'updateUserLogin'])
        ->name('update-user-login');
    });

});