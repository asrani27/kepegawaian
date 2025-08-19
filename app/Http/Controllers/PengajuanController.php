<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Upload;
use App\Models\Layanan;
use App\Models\Periode;
use App\Models\Pengajuan;
use App\Models\Persyaratan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PengajuanController extends Controller
{
    public function pegawai()
    {
        return Auth::user()->pegawai;
    }

    public function layanan($id)
    {
        $detailLayanan = Layanan::find($id);
        $layanan = Layanan::get();
        $pegawai = $this->pegawai();
        return view('pegawai.layanan.index', compact('layanan', 'detailLayanan', 'pegawai'));
    }
    public function dokumen($id)
    {
        $layanan_id = Pengajuan::find($id)->layanan_id;
        $data = Pengajuan::find($id);

        return view('pegawai.dokumen', compact('id', 'layanan_id', 'data'));
    }
    public function kirim_dokumen($id)
    {
        $data = Pengajuan::find($id);
        $data->update(['status' => '1']);
        toastr()->success('berhasil di kirim');
        return redirect('/pegawai/home');
    }
    public function delete_dokumen($id, $persyaratan_id)
    {
        Upload::where('pengajuan_id', $id)->where('persyaratan_id', $persyaratan_id)->where('pegawai_id', Auth::user()->pegawai->id)->delete();
        toastr()->success('Berhasil Di hapus');
        return redirect('/pegawai/home/' . $id . '/dokumen');
    }
    public function upload_dokumen(Request $req, $id)
    {
        $validator = Validator::make($req->all(), [
            'file' => 'required|file|mimes:pdf|max:1024',
        ]);
        if ($validator->fails()) {
            toastr()->error('maks 1 MB');
            return back();
        }
        $persyaratan = Persyaratan::find($req->persyaratan_id)->nama;
        $jenis = Persyaratan::find($req->persyaratan_id)->jenis;

        $path = Auth::user()->pegawai->nip . '/' . 'pengajuan' . $id;
        if ($jenis == 'slks') {
            $filename = str_replace(' ', '_', Auth::user()->pegawai->nip . '_' . Auth::user()->pegawai->nama . '_slks.pdf');
        } else {
            $filename = str_replace(' ', '_', Auth::user()->pegawai->nip . '_' . Auth::user()->pegawai->nama . '_' . $persyaratan . '.pdf');
        }
        $upload = $req->file('file')->storeAs($jenis . "/" . $path, $filename, 'public');

        $check = Upload::where('pengajuan_id', $id)->where('persyaratan_id', $req->persyaratan_id)->where('pegawai_id', Auth::user()->pegawai->id)->first();
        if ($check == null) {
            $new = new Upload();
            $new->pegawai_id = Auth::user()->pegawai->id;
            $new->pengajuan_id = $id;
            $new->persyaratan_id = $req->persyaratan_id;
            $new->file = $filename;
            $new->save();
        } else {
            $update = $check;
            $update->file = $filename;
            $update->save();
        }
        toastr()->success('Berhasil Di upload');
        return redirect('/pegawai/home/' . $id . '/dokumen');
        // $layanan_id = Pengajuan::find($id)->layanan_id;
        // $data = Pengajuan::find($id);
        // return view('pegawai.dokumen', compact('id', 'layanan_id', 'data'));
    }
    public function upload_perbaikan(Request $req, $id)
    {
        $validator = Validator::make($req->all(), [
            'file' => 'required|file|mimes:pdf|max:1024',
        ]);
        if ($validator->fails()) {
            toastr()->error('maks 1 MB');
            return back();
        }
        $persyaratan = Persyaratan::find($req->persyaratan_id)->nama;
        $jenis = Persyaratan::find($req->persyaratan_id)->jenis;

        $path = Auth::user()->pegawai->nip . '/' . 'pengajuan' . $id;
        if ($jenis == 'slks') {
            $filename = str_replace(' ', '_', Auth::user()->pegawai->nip . '_' . Auth::user()->pegawai->nama . '_slks.pdf');
        } else {
            $filename = str_replace(' ', '_', Auth::user()->pegawai->nip . '_' . Auth::user()->pegawai->nama . '_' . $persyaratan . '.pdf');
        }
        $upload = $req->file('file')->storeAs($jenis . "/" . $path, $filename, 'public');

        $check = Upload::where('pengajuan_id', $id)->where('persyaratan_id', $req->persyaratan_id)->where('pegawai_id', Auth::user()->pegawai->id)->first();
        if ($check == null) {
            $new = new Upload();
            $new->pegawai_id = Auth::user()->pegawai->id;
            $new->pengajuan_id = $id;
            $new->persyaratan_id = $req->persyaratan_id;
            $new->file = $filename;
            $new->save();
        } else {
            $update = $check;
            $update->file = $filename;
            $update->perbaikan = 1;
            $update->save();
        }
        toastr()->success('Berhasil Di upload');
        return redirect('/pegawai/home/' . $id . '/dokumen');
    }

    public function store(Request $req)
    {
        $layanan = Layanan::find($req->layanan_id);
        if (!$layanan) {
            toastr()->error('Layanan tidak ditemukan.');
            return back();
        }

        $periode = Periode::where('jenis', $layanan->jenis)->first();
        if (!$periode) {
            toastr()->error('Periode Pengajuan Kepangkatan Belum Dibuka');
            return back();
        }

        $tanggalSekarang = now();
        $mulai = Carbon::parse($periode->mulai);
        $sampai = Carbon::parse($periode->sampai);

        if (!$tanggalSekarang->between($mulai, $sampai)) {
            toastr()->error('Pengajuan Kepangkatan mulai tgl: ' . $mulai->translatedFormat('d F Y') . ' s/d ' . $sampai->translatedFormat('d F Y'));
            return back();
        }

        $pegawaiId = $this->pegawai()->id;
        $pengajuanLama = Pengajuan::where([
            ['layanan_id', $layanan->id],
            ['pegawai_id', $pegawaiId],
            ['status', 0],
        ])->first();

        if ($pengajuanLama) {
            toastr()->error('Anda sudah mengajukan layanan ini dan masih tahap proses');
            return back();
        }

        Pengajuan::create([
            'layanan_id' => $layanan->id,
            'pegawai_id' => $pegawaiId,
            'jenis'      => $layanan->jenis,
        ]);

        toastr()->success('Berhasil Diajukan');
        return redirect('/pegawai/home');
    }


    public function delete($id)
    {
        Pengajuan::find($id)->delete();
        toastr()->success('Berhasil Di Hapus');
        return back();
    }
}
