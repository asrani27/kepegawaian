<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PmkController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SkpdController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\KarisController;
use App\Http\Controllers\KarsuController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\KarpegController;
use App\Http\Controllers\UploadController;
use App\Http\Controllers\BerkalaController;
use App\Http\Controllers\BiodataController;
use App\Http\Controllers\LayananController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\PensiunController;
use App\Http\Controllers\GantiPassController;
use App\Http\Controllers\PengajuanController;
use App\Http\Controllers\KepangkatanController;
use App\Http\Controllers\PersyaratanController;
use App\Http\Controllers\AdminPegawaiController;
use App\Http\Controllers\SatyaLencanaController;

Route::get('/', function(){
    if(Auth::check()){
        return redirect(roleUser(Auth::user()));
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
        Route::post('kepangkatan/{id}', [KepangkatanController::class, 'uploadSyarat']);
        Route::get('kepangkatan/{id}/kirim', [KepangkatanController::class, 'validasi_kirim']);

        Route::get('pmk', [PmkController::class, 'index']);

        Route::get('satyalencana', [SatyaLencanaController::class, 'index']);
        Route::get('satyalencana/create', [SatyaLencanaController::class, 'create']);
        Route::post('satyalencana/create', [SatyaLencanaController::class, 'store']);
        Route::get('satyalencana/{id}/upload', [SatyaLencanaController::class, 'upload']);
        Route::post('satyalencana/{id}/upload', [SatyaLencanaController::class, 'storeUpload']);
        Route::get('satyalencana/{id}/kirim', [SatyaLencanaController::class, 'validasi_kirim']);

        Route::get('pensiun', [PensiunController::class, 'index']);
        Route::get('pensiun/create', [PensiunController::class, 'create']);
        Route::post('pensiun/create', [PensiunController::class, 'store']);
        Route::get('pensiun/{id}', [PensiunController::class, 'detail']);
        Route::get('pensiun/{id}/kirim', [PensiunController::class, 'validasi_kirim']);
        Route::post('pensiun/{id}', [PensiunController::class, 'uploadSyarat']);
        
        Route::get('karpeg', [KarpegController::class, 'index']);
        Route::get('karpeg/create', [KarpegController::class, 'create']);
        Route::post('karpeg/create', [KarpegController::class, 'store']);
        Route::get('karpeg/{id}', [KarpegController::class, 'detail']);
        Route::post('karpeg/{id}', [KarpegController::class, 'uploadSyarat']);
        Route::get('karpeg/{id}/kirim', [KarpegController::class, 'validasi_kirim']);
        Route::get('karpeg/{id}/delete', [KarpegController::class, 'delete']);
        
        Route::get('karsu', [KarsuController::class, 'index']);
        Route::get('karsu/create', [KarsuController::class, 'create']);
        Route::post('karsu/create', [KarsuController::class, 'store']);
        Route::get('karsu/{id}', [KarsuController::class, 'detail']);
        Route::post('karsu/{id}', [KarsuController::class, 'uploadSyarat']);
        Route::get('karsu/{id}/kirim', [KarsuController::class, 'validasi_kirim']);
        Route::get('karsu/{id}/delete', [KarsuController::class, 'delete']);
        
        Route::get('karis', [KarisController::class, 'index']);
        Route::get('karis/create', [KarisController::class, 'create']);
        Route::post('karis/create', [KarisController::class, 'store']);
        Route::get('karis/{id}', [KarisController::class, 'detail']);
        Route::post('karis/{id}', [KarisController::class, 'uploadSyarat']);
        Route::get('karis/{id}/kirim', [KarisController::class, 'validasi_kirim']);
        Route::get('karis/{id}/delete', [KarisController::class, 'delete']);

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
        Route::post('pangkat/ditolak', [KepangkatanController::class, 'k_tolak']);
        Route::get('pangkat/{id}/dokumen', [KepangkatanController::class, 'k_dokumen']);
        Route::get('pangkat/{id}/zip', [KepangkatanController::class, 'downloadZip']);

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

Route::group(['middleware' => ['auth', 'role:pensiun']], function () {
    Route::prefix('pensiun')->group(function () {
        Route::get('satyalencana', [SatyaLencanaController::class, 'p_index']);
        Route::get('pensiun/{id}/dokumen', [PensiunController::class, 'p_dokumen']);

        Route::get('pensiun', [PensiunController::class, 'p_index']);
        Route::post('pensiun/ditolak', [PensiunController::class, 'p_tolak']);
        Route::get('gantipass', [GantiPassController::class, 'pensiun']);
        Route::post('gantipass', [GantiPassController::class, 'resetPensiun']);
    });
});    

Route::group(['middleware' => ['auth', 'role:karpeg']], function () {
    Route::prefix('karpeg')->group(function () {
        Route::get('karpeg', [KarpegController::class, 'k_index']);
        Route::post('karpeg/ditolak', [KarpegController::class, 'k_tolak']);
        Route::get('karpeg/{id}/dokumen', [KarpegController::class, 'k_dokumen']);
        Route::get('karpeg/{id}/selesai', [KarpegController::class, 'k_selesai']);

        Route::get('karis', [KarisController::class, 'k_index']);
        Route::post('karis/ditolak', [KarisController::class, 'k_tolak']);
        Route::get('karis/{id}/dokumen', [KarisController::class, 'k_dokumen']);
        Route::get('karis/{id}/selesai', [KarisController::class, 'k_selesai']);

        Route::get('karsu', [KarsuController::class, 'k_index']);
        Route::post('karsu/ditolak', [KarsuController::class, 'k_tolak']);
        Route::get('karsu/{id}/dokumen', [KarsuController::class, 'k_dokumen']);
        Route::get('karsu/{id}/selesai', [KarsuController::class, 'k_selesai']);
        
        Route::get('gantipass', [GantiPassController::class, 'karpeg']);
        Route::post('gantipass', [GantiPassController::class, 'resetKarpeg']);
    });
});    

Route::group(['middleware' => ['auth', 'role:superadmin|pegawai|kepangkatan|admin|pensiun|karpeg']], function () {
    Route::get('/superadmin/home', [HomeController::class, 'superadmin']);
    Route::get('/pegawai/home', [HomeController::class, 'pegawai']);
    Route::get('/kepangkatan/home', [HomeController::class, 'kepangkatan']);
    Route::get('/pensiun/home', [HomeController::class, 'pensiun']);
    Route::get('/karpeg/home', [HomeController::class, 'karpeg']);
    Route::get('/admin/home', [HomeController::class, 'admin']);
});