<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PmkController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SkpdController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UploadController;
use App\Http\Controllers\BerkalaController;
use App\Http\Controllers\BiodataController;
use App\Http\Controllers\LayananController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\GantiPassController;
use App\Http\Controllers\PengajuanController;
use App\Http\Controllers\KepangkatanController;
use App\Http\Controllers\PersyaratanController;
use App\Http\Controllers\AdminPegawaiController;

Route::get('/', function(){
    if(Auth::check()){
        if(Auth::user()->hasRole('superadmin')){
            return redirect('/superadmin/home');
        }elseif(Auth::user()->hasRole('admin')){
            return redirect('/admin/home');
        }elseif(Auth::user()->hasRole('kepangkatan')){
            return redirect('/kepangkatan/home');
        }else{
            return redirect('/pegawai/home');
        }
    }
    return view('login');
});

Route::get('/logout', function(){
    Auth::logout();
    return redirect('/');
});

Route::get('/login', function(){
    if(Auth::check()){
        return redirect('/');
    }
    return view('login');
})->name('login');

Route::post('/login', [LoginController::class, 'login']);
Route::get('/daftar', [LoginController::class, 'daftar']);
Route::post('/daftar', [LoginController::class, 'simpanDaftar']);

Route::group(['middleware' => ['auth', 'role:superadmin']], function () {
    Route::prefix('superadmin')->group(function () {
        Route::get('gantipass', [HomeController::class, 'gantipass']);
        Route::post('gantipass', [HomeController::class, 'resetpass']);
        Route::get('/pegawai/checktobkd', [PegawaiController::class, 'checktobkd']);
        Route::get('/pegawai/account', [PegawaiController::class, 'account']);
        Route::get('/pegawai/search', [PegawaiController::class, 'search']);
        Route::post('/pegawai/import', [PegawaiController::class, 'import']);
        
        Route::get('/pegawai/{id}/detail', [PegawaiController::class, 'detail']);
        Route::get('/pegawai/{id}/detail/edit_profil', [PegawaiController::class, 'editProfil']);
        Route::get('/pegawai/{id}/pasangan', [PegawaiController::class, 'pasangan']);
        Route::get('/pegawai/{id}/anak', [PegawaiController::class, 'anak']);
        Route::get('/pegawai/{id}/orangtua', [PegawaiController::class, 'orangtua']);
        Route::get('/pegawai/{id}/pendidikan', [PegawaiController::class, 'pendidikan']);

        Route::get('/pegawai/import/{id}/sync', [PegawaiController::class, 'sinkronBkd']);
        Route::get('/pegawai/import/{id}/delete', [PegawaiController::class, 'importDelete']);
        Route::get('/pegawai/{id}/akun', [PegawaiController::class, 'akun']);
        Route::get('/pegawai/{id}/reset', [PegawaiController::class, 'pass']);
        
        Route::get('/skpd/{id}/akun', [SkpdController::class, 'akun']);
        Route::get('/skpd/{id}/reset', [SkpdController::class, 'reset']);

        Route::resource('admin', AdminController::class);
        Route::resource('persyaratan', PersyaratanController::class);
        Route::resource('layanan', LayananController::class);
        Route::resource('pegawai', PegawaiController::class);
        Route::resource('skpd', SkpdController::class);
    });
});

Route::group(['middleware' => ['auth', 'role:pegawai']], function () {
    Route::prefix('pegawai')->group(function () {
        Route::get('home/{id}/layanan', [PengajuanController::class, 'layanan']);
        Route::get('home/{id}/delete', [PengajuanController::class, 'delete']);
        Route::post('home/{id}/layanan', [PengajuanController::class, 'store']);
        Route::get('biodata', [BiodataController::class, 'index']);
        Route::post('biodata/foto', [BiodataController::class, 'foto']);
        Route::get('pasangan', [BiodataController::class, 'pasangan']);
        Route::get('anak', [BiodataController::class, 'anak']);
        Route::get('orangtua', [BiodataController::class, 'orangtua']);
        Route::get('pendidikan', [BiodataController::class, 'pendidikan']);
        Route::resource('biodata', BiodataController::class);
        Route::get('upload/{id}/delete', [UploadController::class, 'deleteFile']);
        Route::resource('upload', UploadController::class);
    });    
});

Route::group(['middleware' => ['auth', 'role:admin']], function () {
    Route::prefix('admin')->group(function () {
        Route::get('pegawai', [AdminPegawaiController::class, 'index']);
        Route::get('pegawai/sync', [AdminPegawaiController::class, 'sync']);
        Route::get('pegawai/sync/unitkerja', [AdminPegawaiController::class, 'syncUnitKerja']);
        Route::get('pegawai/search', [AdminPegawaiController::class, 'search']);
        Route::get('berkala', [BerkalaController::class, 'index']);
        Route::get('berkala/create', [BerkalaController::class, 'create']);
        Route::post('berkala/create', [BerkalaController::class, 'store']);

        Route::get('berkala/{id}/upload', [BerkalaController::class, 'upload']);
        Route::post('berkala/{id}/upload', [BerkalaController::class, 'storeUpload']);
        Route::get('berkala/{id}/kirim', [BerkalaController::class, 'validasi_kirim']);
        
        Route::get('kepangkatan', [KepangkatanController::class, 'index']);
        Route::get('kepangkatan/create', [KepangkatanController::class, 'create']);
        Route::post('kepangkatan/create', [KepangkatanController::class, 'store']);
        Route::get('kepangkatan/{id}', [KepangkatanController::class, 'detail']);
        Route::get('kepangkatan/{id}/kirim', [KepangkatanController::class, 'validasi_kirim']);
        Route::post('kepangkatan/{id}', [KepangkatanController::class, 'uploadSyarat']);

        Route::get('pmk', [PmkController::class, 'index']);
        Route::get('gantipass', [GantiPassController::class, 'admin']);
        Route::post('gantipass', [GantiPassController::class, 'resetadmin']);
    });    
});


Route::group(['middleware' => ['auth', 'role:kepangkatan']], function () {
    Route::prefix('kepangkatan')->group(function () {
        Route::get('berkala', [BerkalaController::class, 'k_index']);
        Route::get('gantipass', [GantiPassController::class, 'kepangkatan']);
        Route::post('gantipass', [GantiPassController::class, 'resetKepangkatan']);
        Route::get('pangkat', [KepangkatanController::class, 'k_index']);
        Route::get('pangkat/{id}/dokumen', [KepangkatanController::class, 'k_dokumen']);

        Route::get('berkala/editpejabat', [BerkalaController::class, 'k_editpejabat']);
        Route::post('berkala/editpejabat', [BerkalaController::class, 's_editpejabat']);
        Route::get('berkala/{id}/print', [BerkalaController::class, 'printSK']);
        Route::post('berkala/ditolak', [BerkalaController::class, 'k_tolak']);
        Route::post('berkala/upload', [BerkalaController::class, 'k_upload']);
        Route::get('berkala/{id}/sk', [BerkalaController::class, 'sk_berkala']);
        Route::get('berkala/{id}/sk/edit', [BerkalaController::class, 'sk_berkala_edit']);
        Route::post('berkala/{id}/sk', [BerkalaController::class, 'simpan_sk_berkala']);
        Route::get('berkala/{id}/sk/cetak', [BerkalaController::class, 'cetak_sk_berkala']);
    });
});  
Route::group(['middleware' => ['auth', 'role:superadmin|pegawai|kepangkatan|admin']], function () {
    Route::get('/superadmin/home', [HomeController::class, 'superadmin']);
    Route::get('/pegawai/home', [HomeController::class, 'pegawai']);
    Route::get('/kepangkatan/home', [HomeController::class, 'kepangkatan']);
    Route::get('/admin/home', [HomeController::class, 'admin']);
});