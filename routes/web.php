<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SoalController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UjianController;
use App\Http\Controllers\WaktuController;
use App\Http\Controllers\UploadController;
use App\Http\Controllers\BiodataController;
use App\Http\Controllers\LayananController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\PesertaController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\PengajuanController;
use App\Http\Controllers\PersyaratanController;

Route::get('/', function(){
    if(Auth::check()){
        if(Auth::user()->hasRole('superadmin')){
            return redirect('/superadmin/home');
        }elseif(Auth::user()->hasRole('admin')){
            return redirect('/admin/home');
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
        
        Route::resource('persyaratan', PersyaratanController::class);
        Route::resource('layanan', LayananController::class);
        Route::resource('pegawai', PegawaiController::class);
        Route::resource('waktu', WaktuController::class);
        Route::resource('kategori', KategoriController::class);
        Route::resource('soal', SoalController::class);
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


Route::group(['middleware' => ['auth', 'role:superadmin|pegawai']], function () {
    Route::get('/superadmin/home', [HomeController::class, 'superadmin']);
    Route::get('/pegawai/home', [HomeController::class, 'pegawai']);
});