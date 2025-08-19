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
use App\Http\Controllers\MSkpdController;
use App\Http\Controllers\KarpegController;
use App\Http\Controllers\MAgamaController;
use App\Http\Controllers\MJenisController;
use App\Http\Controllers\MKawinController;
use App\Http\Controllers\MUnit1Controller;
use App\Http\Controllers\MUnit2Controller;
use App\Http\Controllers\MUnit3Controller;
use App\Http\Controllers\UploadController;
use App\Http\Controllers\BerkalaController;
use App\Http\Controllers\BiodataController;
use App\Http\Controllers\LayananController;
use App\Http\Controllers\MEselonController;
use App\Http\Controllers\MGenderController;
use App\Http\Controllers\MInsjabController;
use App\Http\Controllers\MJenjabController;
use App\Http\Controllers\MKeljabController;
use App\Http\Controllers\MLatjabController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\PensiunController;
use App\Http\Controllers\MJabatanController;
use App\Http\Controllers\MPangkatController;
use App\Http\Controllers\MPegawaiController;
use App\Http\Controllers\GantiPassController;
use App\Http\Controllers\MGoldarahController;
use App\Http\Controllers\MLeveljabController;
use App\Http\Controllers\PengajuanController;
use App\Http\Controllers\MKedudukanController;
use App\Http\Controllers\MUnitkerjaController;
use App\Http\Controllers\KepangkatanController;
use App\Http\Controllers\MPendidikanController;
use App\Http\Controllers\PersyaratanController;
use App\Http\Controllers\AdminPegawaiController;
use App\Http\Controllers\SatyaLencanaController;
use App\Http\Controllers\MJenisDisiplinController;
use App\Http\Controllers\MStatusPegawaiController;
use App\Http\Controllers\KHukumanDisiplinController;
use App\Http\Controllers\MKategoriDisiplinController;
use App\Http\Controllers\PeriodeController;

Route::get('/', function () {
    if (Auth::check()) {
        return redirect(roleUser(Auth::user()));
    }
    return view('login2');
});

Route::get('/logout', function () {
    Auth::logout();
    return redirect('/');
});

Route::get('/login', function () {
    if (Auth::check()) {
        return redirect('/');
    }
    return view('login2');
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
        Route::get('gantipass', [PegawaiController::class, 'gantipass']);
        Route::post('gantipass', [PegawaiController::class, 'resetpass']);
        Route::get('home/{id}/deletedokumen/{persyaratan_id}', [PengajuanController::class, 'delete_dokumen']);
        Route::get('home/{id}/dokumen/kirim', [PengajuanController::class, 'kirim_dokumen']);
        Route::get('home/{id}/dokumen', [PengajuanController::class, 'dokumen']);
        Route::post('home/{id}/dokumen', [PengajuanController::class, 'upload_dokumen']);
        Route::get('home/{id}/layanan', [PengajuanController::class, 'layanan']);
        Route::get('home/{id}/delete', [PengajuanController::class, 'delete']);
        Route::post('home/{id}/layanan', [PengajuanController::class, 'store']);
        Route::post('home/ajukan-layanan', [PengajuanController::class, 'store']);
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
        Route::get('baru', [KepangkatanController::class, 'baru']);
        Route::get('diproses', [KepangkatanController::class, 'diproses']);
        Route::get('selesai', [KepangkatanController::class, 'selesai']);

        Route::get('dokumen/{id}/berkas-ok/{dokumen_id}', [KepangkatanController::class, 'verif_dokumen']);
        Route::post('dokumen/{id}/perbaikidokumen', [KepangkatanController::class, 'perbaiki_dokumen']);
        Route::get('dokumen/{id}', [KepangkatanController::class, 'dokumen_pengajuan']);
        Route::get('selesaipengajuan/{id}', [KepangkatanController::class, 'selesai_pengajuan']);
        Route::get('deletepengajuan/{id}', [KepangkatanController::class, 'delete_pengajuan']);
        Route::get('prosespengajuan/{id}', [KepangkatanController::class, 'proses_pengajuan']);

        Route::get('persyaratan', [KepangkatanController::class, 'persyaratan']);
        Route::post('persyaratan/create', [KepangkatanController::class, 'persyaratan_store']);
        Route::post('persyaratan/edit', [KepangkatanController::class, 'persyaratan_update']);
        Route::get('persyaratan/delete/{id}', [KepangkatanController::class, 'persyaratan_delete']);

        Route::get('jenis_kenaikan', [KepangkatanController::class, 'jenis_kenaikan']);
        Route::post('jenis_kenaikan/create', [KepangkatanController::class, 'jenis_kenaikan_store']);
        Route::post('jenis_kenaikan/edit', [KepangkatanController::class, 'jenis_kenaikan_update']);
        Route::get('jenis_kenaikan/delete/{id}', [KepangkatanController::class, 'jenis_kenaikan_delete']);

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
Route::group(['middleware' => ['auth', 'role:slks']], function () {
    Route::prefix('slks')->group(function () {

        Route::get('baru', [SatyaLencanaController::class, 'baru']);
        Route::get('diproses', [SatyaLencanaController::class, 'diproses']);
        Route::get('selesai', [SatyaLencanaController::class, 'selesai']);

        Route::get('dokumen/{id}/berkas-ok/{dokumen_id}', [SatyaLencanaController::class, 'verif_dokumen']);
        Route::post('dokumen/{id}/perbaikidokumen', [SatyaLencanaController::class, 'perbaiki_dokumen']);
        Route::get('dokumen/{id}', [SatyaLencanaController::class, 'dokumen_pengajuan']);
        Route::get('selesaipengajuan/{id}', [SatyaLencanaController::class, 'selesai_pengajuan']);
        Route::get('deletepengajuan/{id}', [SatyaLencanaController::class, 'delete_pengajuan']);
        Route::get('prosespengajuan/{id}', [SatyaLencanaController::class, 'proses_pengajuan']);

        Route::get('persyaratan', [SatyaLencanaController::class, 'persyaratan']);
        Route::post('persyaratan/create', [SatyaLencanaController::class, 'persyaratan_store']);
        Route::post('persyaratan/edit', [SatyaLencanaController::class, 'persyaratan_update']);
        Route::get('persyaratan/delete/{id}', [SatyaLencanaController::class, 'persyaratan_delete']);

        Route::get('jenis', [SatyaLencanaController::class, 'jenis']);
        Route::post('jenis/create', [SatyaLencanaController::class, 'jenis_store']);
        Route::post('jenis/edit', [SatyaLencanaController::class, 'jenis_update']);
        Route::get('jenis/delete/{id}', [SatyaLencanaController::class, 'jenis_delete']);

        Route::get('data', [SatyaLencanaController::class, 'index']);
        Route::get('gantipass', [GantiPassController::class, 'slks']);
        Route::post('gantipass', [GantiPassController::class, 'resetslks']);
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

Route::group(['middleware' => ['auth', 'role:disiplin']], function () {
    Route::prefix('disiplin')->group(function () {
        Route::get('kategori', [MKategoriDisiplinController::class, 'index']);
        Route::post('kategori', [MKategoriDisiplinController::class, 'store']);
        Route::post('kategori/edit', [MKategoriDisiplinController::class, 'update']);
        Route::get('kategori/{id}/delete', [MKategoriDisiplinController::class, 'delete']);

        //kelola data
        Route::get('jenis', [MJenisDisiplinController::class, 'index']);
        Route::get('jenis/add', [MJenisDisiplinController::class, 'create']);
        Route::post('jenis/add', [MJenisDisiplinController::class, 'store']);
        Route::get('jenis/{id}/edit', [MJenisDisiplinController::class, 'edit']);
        Route::post('jenis/{id}/edit', [MJenisDisiplinController::class, 'update']);
        Route::get('jenis/{id}/delete', [MJenisDisiplinController::class, 'delete']);
        Route::get('jenis/search', [MJenisDisiplinController::class, 'search']);

        Route::get('hukuman', [KHukumanDisiplinController::class, 'index']);

        Route::get('gantipass', [GantiPassController::class, 'disiplin']);
        Route::post('gantipass', [GantiPassController::class, 'resetDisiplin']);
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

Route::group(['middleware' => ['auth', 'role:kepegawaian']], function () {
    Route::prefix('kepegawaian')->group(function () {

        Route::get('data/agama', [MAgamaController::class, 'index']);
        Route::post('data/agama', [MAgamaController::class, 'store']);
        Route::post('data/agama/edit', [MAgamaController::class, 'update']);
        Route::get('data/agama/{id}/delete', [MAgamaController::class, 'delete']);

        Route::get('data/eselon', [MEselonController::class, 'index']);
        Route::post('data/eselon', [MEselonController::class, 'store']);
        Route::post('data/eselon/edit', [MEselonController::class, 'update']);
        Route::get('data/eselon/{id}/delete', [MEselonController::class, 'delete']);

        Route::get('data/gender', [MGenderController::class, 'index']);
        Route::post('data/gender', [MGenderController::class, 'store']);
        Route::post('data/gender/edit', [MGenderController::class, 'update']);
        Route::get('data/gender/{id}/delete', [MGenderController::class, 'delete']);

        Route::get('data/goldarah', [MGoldarahController::class, 'index']);
        Route::post('data/goldarah', [MGoldarahController::class, 'store']);
        Route::post('data/goldarah/edit', [MGoldarahController::class, 'update']);
        Route::get('data/goldarah/{id}/delete', [MGoldarahController::class, 'delete']);

        Route::get('data/jabatan', [MJabatanController::class, 'index']);
        Route::post('data/jabatan', [MJabatanController::class, 'store']);
        Route::post('data/jabatan/edit', [MJabatanController::class, 'update']);
        Route::get('data/jabatan/{id}/delete', [MJabatanController::class, 'delete']);

        Route::get('data/jenis', [MJenisController::class, 'index']);
        Route::post('data/jenis', [MJenisController::class, 'store']);
        Route::post('data/jenis/edit', [MJenisController::class, 'update']);
        Route::get('data/jenis/{id}/delete', [MJenisController::class, 'delete']);

        Route::get('data/pangkat', [MPangkatController::class, 'index']);
        Route::post('data/pangkat', [MPangkatController::class, 'store']);
        Route::post('data/pangkat/edit', [MPangkatController::class, 'update']);
        Route::get('data/pangkat/{id}/delete', [MPangkatController::class, 'delete']);

        Route::get('data/kawin', [MKawinController::class, 'index']);
        Route::post('data/kawin', [MKawinController::class, 'store']);
        Route::post('data/kawin/edit', [MKawinController::class, 'update']);
        Route::get('data/kawin/{id}/delete', [MKawinController::class, 'delete']);

        Route::get('data/kedudukan', [MKedudukanController::class, 'index']);
        Route::post('data/kedudukan', [MKedudukanController::class, 'store']);
        Route::post('data/kedudukan/edit', [MKedudukanController::class, 'update']);
        Route::get('data/kedudukan/{id}/delete', [MKedudukanController::class, 'delete']);

        Route::get('data/skpd', [MSkpdController::class, 'index']);
        Route::post('data/skpd', [MSkpdController::class, 'store']);
        Route::post('data/skpd/edit', [MSkpdController::class, 'update']);
        Route::get('data/skpd/{id}/delete', [MSkpdController::class, 'delete']);

        Route::get('data/pendidikan', [MPendidikanController::class, 'index']);
        Route::post('data/pendidikan', [MPendidikanController::class, 'store']);
        Route::post('data/pendidikan/edit', [MPendidikanController::class, 'update']);
        Route::get('data/pendidikan/{id}/delete', [MPendidikanController::class, 'delete']);

        Route::get('data/status', [MStatusPegawaiController::class, 'index']);
        Route::post('data/status', [MStatusPegawaiController::class, 'store']);
        Route::post('data/status/edit', [MStatusPegawaiController::class, 'update']);
        Route::get('data/status/{id}/delete', [MStatusPegawaiController::class, 'delete']);

        Route::get('data/unit1', [MUnit1Controller::class, 'index']);
        Route::post('data/unit1', [MUnit1Controller::class, 'store']);
        Route::post('data/unit1/edit', [MUnit1Controller::class, 'update']);
        Route::get('data/unit1/{id}/delete', [MUnit1Controller::class, 'delete']);

        Route::get('data/unit2', [MUnit2Controller::class, 'index']);
        Route::post('data/unit2', [MUnit2Controller::class, 'store']);
        Route::post('data/unit2/edit', [MUnit2Controller::class, 'update']);
        Route::get('data/unit2/{id}/delete', [MUnit2Controller::class, 'delete']);

        Route::get('data/unit3', [MUnit3Controller::class, 'index']);
        Route::post('data/unit3', [MUnit3Controller::class, 'store']);
        Route::post('data/unit3/edit', [MUnit3Controller::class, 'update']);
        Route::get('data/unit3/{id}/delete', [MUnit3Controller::class, 'delete']);

        Route::get('data/keljab', [MKeljabController::class, 'index']);
        Route::post('data/keljab', [MKeljabController::class, 'store']);
        Route::post('data/keljab/edit', [MKeljabController::class, 'update']);
        Route::get('data/keljab/{id}/delete', [MKeljabController::class, 'delete']);

        Route::get('data/insjab', [MInsjabController::class, 'index']);
        Route::post('data/insjab', [MInsjabController::class, 'store']);
        Route::post('data/insjab/edit', [MInsjabController::class, 'update']);
        Route::get('data/insjab/{id}/delete', [MInsjabController::class, 'delete']);

        Route::get('data/latjab', [MLatjabController::class, 'index']);
        Route::post('data/latjab', [MLatjabController::class, 'store']);
        Route::post('data/latjab/edit', [MLatjabController::class, 'update']);
        Route::get('data/latjab/{id}/delete', [MLatjabController::class, 'delete']);

        //kelola data
        Route::get('kelola/jenjab', [MJenjabController::class, 'index']);
        Route::get('kelola/jenjab/add', [MJenjabController::class, 'create']);
        Route::post('kelola/jenjab/add', [MJenjabController::class, 'store']);
        Route::get('kelola/jenjab/{id}/edit', [MJenjabController::class, 'edit']);
        Route::post('kelola/jenjab/{id}/edit', [MJenjabController::class, 'update']);
        Route::get('kelola/jenjab/{id}/delete', [MJenjabController::class, 'delete']);
        Route::get('kelola/jenjab/search', [MJenjabController::class, 'search']);

        Route::get('kelola/unitkerja', [MUnitkerjaController::class, 'index']);
        Route::get('kelola/unitkerja/add', [MUnitkerjaController::class, 'create']);
        Route::post('kelola/unitkerja/add', [MUnitkerjaController::class, 'store']);
        Route::get('kelola/unitkerja/{id}/edit', [MUnitkerjaController::class, 'edit']);
        Route::post('kelola/unitkerja/{id}/edit', [MUnitkerjaController::class, 'update']);
        Route::get('kelola/unitkerja/{id}/delete', [MUnitkerjaController::class, 'delete']);
        Route::get('kelola/unitkerja/search', [MUnitkerjaController::class, 'search']);

        Route::get('kelola/pegawai', [MPegawaiController::class, 'index']);
        Route::get('kelola/pegawai/search', [MPegawaiController::class, 'search']);

        Route::get('kelola/leveljab', [MLeveljabController::class, 'index']);
        Route::post('kelola/leveljab', [MLeveljabController::class, 'store']);
        Route::post('kelola/leveljab/edit', [MLeveljabController::class, 'update']);
        Route::get('kelola/leveljab/{id}/delete', [MLeveljabController::class, 'delete']);

        Route::get('gantipass', [GantiPassController::class, 'kepegawaian']);
        Route::post('gantipass', [GantiPassController::class, 'resetKepegawaian']);
    });
});

Route::group(['middleware' => ['auth', 'role:superadmin|pegawai|kepangkatan|admin|pensiun|karpeg|disiplin|kepegawaian|slks']], function () {
    Route::get('/superadmin/home', [HomeController::class, 'superadmin']);
    Route::get('/pegawai/home', [HomeController::class, 'pegawai']);
    Route::get('/kepangkatan/home', [HomeController::class, 'kepangkatan']);
    Route::get('/slks/home', [HomeController::class, 'slks']);
    Route::get('/pensiun/home', [HomeController::class, 'pensiun']);
    Route::get('/karpeg/home', [HomeController::class, 'karpeg']);
    Route::get('/admin/home', [HomeController::class, 'admin']);
    Route::get('/disiplin/home', [HomeController::class, 'disiplin']);
    Route::get('/kepegawaian/home', [HomeController::class, 'kepegawaian']);

    Route::get('/periode', [PeriodeController::class, 'index']);
    Route::post('/periode', [PeriodeController::class, 'store']);
    Route::post('/periode/edit', [PeriodeController::class, 'update']);
    Route::get('/periode/delete/{id}', [PeriodeController::class, 'delete']);
});
