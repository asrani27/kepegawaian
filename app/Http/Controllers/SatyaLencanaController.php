<?php

namespace App\Http\Controllers;

use ZipArchive;
use App\Models\Upload;
use App\Models\Layanan;
use App\Models\Pegawai;
use ZipStream\ZipStream;
use App\Models\Pengajuan;
use App\Models\Persyaratan;
use App\Models\SatyaLencana;
use Illuminate\Http\Request;
use App\Exports\PengajuanExport;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class SatyaLencanaController extends Controller
{
    public function downloadSlks()
    {
        $folder = 'slks';
        $zipFileName = 'slks.zip';

        $zipPath = storage_path('app/' . $zipFileName);

        if (file_exists($zipPath)) {
            unlink($zipPath);
        }

        $zip = new ZipArchive;
        if ($zip->open($zipPath, ZipArchive::CREATE | ZipArchive::OVERWRITE) === true) {
            $files = Storage::disk('public')->allFiles($folder);

            foreach ($files as $file) {
                $filePath = Storage::disk('public')->path($file);
                $zip->addFile($filePath, $file);
            }

            $zip->close();
        }
        return response()->download($zipPath)->deleteFileAfterSend(true);
    }
    public function baru()
    {
        return $this->renderSLKSView('baru');
    }

    public function diproses()
    {
        return $this->renderSLKSView('diproses');
    }

    public function selesai()
    {
        return $this->renderSLKSView('selesai');
    }

    private function renderSLKSView($tipe)
    {
        $slks = Pengajuan::where('jenis', 'slks')->where('status', 1)->whereNull('verifikator')->count();
        $diproses = Pengajuan::where('jenis', 'slks')->where('status', 1)->whereNotNull('verifikator')->count();
        $selesai = Pengajuan::where('jenis', 'slks')->where('status', 2)->count();

        $query = Pengajuan::with('pegawai')
            ->where('jenis', 'slks');

        if ($tipe === 'baru') {
            $query->where('status', 1)->whereNull('verifikator');
        } elseif ($tipe === 'diproses') {
            $query->where('status', 1)->whereNotNull('verifikator');
        } elseif ($tipe === 'selesai') {
            $query->where('status', 2);
        }

        $data = $query->get()->map(function ($item) {
            $item->gol_pangkat = $item->pegawai->gol_pangkat;
            return $item;
        })->sortBy(function ($item) {
            return sortValue($item->gol_pangkat);
        })->values();

        return view('slks.home', compact('slks', 'diproses', 'selesai', 'data'));
    }
    public function export()
    {
        return Excel::download(new PengajuanExport, 'slks.xlsx');
    }
    public function user()
    {
        return Auth::user();
    }

    //Function untuk umpeg SKPD
    public function index()
    {
        $data = Pengajuan::where('status', 2)->where('jenis', 'slks')->paginate(10);
        return view('slks.index', compact('data'));
    }

    public function create()
    {
        $pegawai = Pegawai::where('skpd_id', Auth::user()->skpd->id)->get();
        return view('skpd.satyalencana.create', compact('pegawai'));
    }

    public function store(Request $req)
    {
        $attr = $req->all();
        $attr['skpd_id'] = $this->user()->skpd->id;

        SatyaLencana::create($attr);
        toastr()->success('Berhasil Di Simpan');
        return redirect('/admin/satyalencana');
    }

    public function upload($id)
    {
        $pegawai = SatyaLencana::find($id)->pegawai;
        return view('skpd.satyalencana.upload', compact('pegawai', 'id'));
    }

    public function storeUpload(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'sk_cpns'  => 'mimes:pdf|max:5120',
            'sk_pns'  => 'mimes:pdf|max:5120',
            'sk_jabatan'  => 'mimes:pdf|max:5120',
            'skp1tahun'  => 'mimes:pdf|max:5120',
        ]);

        if ($validator->fails()) {
            toastr()->error('File harus PDF dan Maks 5MB');
            return back();
        }

        $SL = SatyaLencana::find($id);

        $sk_cpns    = $request->sk_cpns == null ? $SL->sk_cpns : 'SKCPNS_' . $SL->pegawai->nip . '.pdf';
        $sk_pns     = $request->sk_pns == null ? $SL->sk_pns : 'SKPNS_' . $SL->pegawai->nip . '.pdf';
        $sk_jabatan = $request->sk_jabatan == null ? $SL->sk_jabatan : 'SKJABATAN_' . $SL->pegawai->nip . '.pdf';
        $skp1thn    = $request->skp1thn == null ? $SL->skp1thn : 'SKP1THN_' . $SL->pegawai->nip . '.pdf';

        $SL->update([
            'sk_cpns' => $sk_cpns,
            'sk_pns' => $sk_pns,
            'sk_jabatan' => $sk_jabatan,
            'skp1thn' => $skp1thn,
        ]);

        if ($request->hasFile('sk_cpns')) {
            $request->sk_cpns->storeAs('/public/' . $SL->pegawai->nip . '/satyalencana/' . $SL->id, $sk_cpns);
        }
        if ($request->hasFile('sk_pns')) {
            $request->sk_pns->storeAs('/public/' . $SL->pegawai->nip . '/satyalencana/' . $SL->id, $sk_pns);
        }
        if ($request->hasFile('sk_jabatan')) {
            $request->sk_jabatan->storeAs('/public/' . $SL->pegawai->nip . '/satyalencana/' . $SL->id, $sk_jabatan);
        }
        if ($request->hasFile('skp1thn')) {
            $request->skp1thn->storeAs('/public/' . $SL->pegawai->nip . '/satyalencana/' . $SL->id, $skp1thn);
        }

        toastr()->success('Berhasil Di Upload');
        return redirect('/admin/satyalencana');
    }

    public function validasi_kirim($id)
    {
        SatyaLencana::find($id)->update([
            'validasi_skpd' => 1,
            'status' => null
        ]);
        toastr()->success('Berhasil Di Verfikasi Dan Di Kirim Ke BKD');
        return back();
    }

    //Function untuk admin sub bidang pensiun dan satya lencana
    public function p_index()
    {
        $data = SatyaLencana::where('status', null)->where('validasi_skpd', 1)->orderBy('created_at', 'DESC')->paginate(10);
        $tolak = SatyaLencana::where('status', 2)->orderBy('created_at', 'DESC')->paginate(10);
        return view('pensiun.satyalencana.index', compact('data', 'tolak'));
    }



    public function jenis()
    {
        $data = Layanan::where('jenis', 'slks')->paginate(10);
        return view('slks.jenis.index', compact('data'));
    }
    public function jenis_store(Request $req)
    {
        $param = $req->all();
        $param['jenis'] = 'slks';
        Layanan::create($param);
        return back();
    }
    public function jenis_update(Request $req)
    {
        $attr = $req->all();
        Layanan::find($req->jenis_id)->update($attr);
        toastr()->success('Berhasil Diupdate');
        return back();
    }
    public function jenis_delete($id)
    {
        Layanan::find($id)->delete();
        toastr()->success('Berhasil Di Hapus');
        return back();
    }

    public function persyaratan()
    {
        $data = Persyaratan::where('jenis', 'slks')->paginate(100);
        return view('slks.persyaratan.index', compact('data'));
    }
    public function persyaratan_store(Request $req)
    {
        $param = $req->all();
        $param['jenis'] = 'slks';
        $param['nama_jenis'] = Layanan::find($req->layanan_id)->nama;

        Persyaratan::create($param);
        return back();
    }
    public function persyaratan_update(Request $req)
    {
        $param = $req->all();
        $param['nama_jenis'] = Layanan::find($req->layanan_id)->nama;

        // M_jenis_kenaikan_pangkat::find($req->jenis_id)->update($attr);
        Persyaratan::find($req->syarat_id)->update($param);
        toastr()->success('Berhasil Diupdate');
        return back();
    }
    public function persyaratan_delete($id)
    {
        Persyaratan::find($id)->delete();
        toastr()->success('Berhasil Di Hapus');
        return back();
    }

    public function delete_pengajuan($id)
    {
        Pengajuan::find($id)->delete();
        toastr()->success('Berhasil Di Hapus');
        return back();
    }
    public function selesai_pengajuan($id)
    {
        Pengajuan::find($id)->update(['status' => 2]);
        toastr()->success('Pengajuan selesai');
        return back();
    }
    public function proses_pengajuan($id)
    {
        Pengajuan::find($id)->update([
            'verifikator' => Auth::user()->id,
        ]);
        toastr()->success('proses di lanjutkan');
        return back();
    }
    public function dokumen_pengajuan($id)
    {
        $data = Pengajuan::find($id);
        if ($data->verifikator == null) {
            toastr()->error('Harap klik tombol proses terlebih dahulu');
            return back();
        } else {
            $layanan_id = $data->layanan->id;
            return view('slks.dokumen', compact('data', 'layanan_id', 'id'));
        }
    }

    public function verif_dokumen($id, $dokumen_id)
    {
        $data = Upload::find($dokumen_id)->update(['verifikasi' => 1]);
        toastr()->success('berhasil di verifikasi');
        return back();
    }
    public function perbaiki_dokumen(Request $req)
    {
        $data = Upload::find($req->persyaratan_id)->update(['verifikasi' => 2, 'keterangan' => $req->keterangan]);
        toastr()->success('berhasil di simpan');
        return back();
    }
}
