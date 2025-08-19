<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Soal;
use App\Models\Karis;
use App\Models\Karsu;
use App\Models\Waktu;
use App\Models\Karpeg;
use App\Models\Berkala;
use App\Models\Jawaban;
use App\Models\Layanan;
use App\Models\Pegawai;
use App\Models\Pensiun;
use App\Models\Peserta;
use App\Models\Kategori;
use App\Models\Pengajuan;
use App\Models\BenarSalah;
use App\Models\Kepangkatan;
use App\Models\SatyaLencana;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{
    public function admin()
    {
        return view('skpd.home');
    }

    public function superadmin()
    {
        $pengajuan = Pengajuan::orderBy('status', 'ASC')->paginate(10);
        $t_pegawai = count(Pegawai::all());
        $t_pns = count(Pegawai::where('status_pegawai', 'PNS')->get());
        $t_cpns = count(Pegawai::where('status_pegawai', 'CPNS')->get());

        return view('superadmin.home', compact('pengajuan', 't_pegawai', 't_pns', 't_cpns'));
    }

    public function gantipass()
    {
        return view('superadmin.gantipass.index');
    }

    public function resetpass(Request $req)
    {
        if ($req->password1 == $req->password2) {
            $u = Auth::user();
            $u->password = Hash::make($req->password1);
            $u->save();

            Auth::logout();
            toastr()->success('Berhasil Di Ubah, Login Dengan Password Baru');
            return redirect('/');
        } else {
            toastr()->error('Password Tidak Sama');
            return back();
        }
    }

    // public function soal()
    // {
    //     return Soal::get();
    // }

    public function pegawai()
    {
        $page = 'profil';
        $pegawai = Auth::user()->pegawai;
        $layanan = Layanan::get();
        $pengajuan = Pengajuan::where('pegawai_id', $pegawai->id)->get();
        return view('pegawai.home', compact('page', 'pegawai', 'layanan', 'pengajuan'));
    }

    public function kepangkatan()
    {
        //Sub Bidang Kepangkatan
        $pangkat = count(Pengajuan::where('jenis', 'kepangkatan')->where('status', 0)->get());
        $diproses = count(Pengajuan::where('jenis', 'kepangkatan')->where('status', 1)->where('verifikator', '!=', null)->get());
        $selesai = count(Pengajuan::where('jenis', 'kepangkatan')->where('status', 2)->get());

        $data = Pengajuan::where('jenis', 'kepangkatan')->where('status', '1')->orWhere('status', 0)->get()->map(function ($item) {
            $item->gol_pangkat = $item->pegawai->gol_pangkat;
            return $item;
        })->sortBy(function ($item) {
            return sortValue($item->gol_pangkat);
        })->values();

        return view('kepangkatan.home', compact('pangkat', 'diproses', 'selesai', 'data'));
    }

    public function slks()
    {
        //Sub Bidang slks
        $slks = count(Pengajuan::where('jenis', 'kepangkatan')->where('status', 0)->whereNull('verifikator')->get());
        $diproses = count(Pengajuan::where('jenis', 'slks')->where('status', 1)->where('verifikator', '!=', null)->get());
        $selesai = count(Pengajuan::where('jenis', 'slks')->where('status', 2)->get());

        $data = Pengajuan::where('jenis', 'slks')->where('status', '1')->get()->map(function ($item) {
            $item->gol_pangkat = $item->pegawai->gol_pangkat;
            return $item;
        })->sortBy(function ($item) {
            return sortValue($item->gol_pangkat);
        })->values();

        return view('slks.home', compact('slks', 'diproses', 'selesai', 'data'));
    }

    public function pensiun()
    {
        //Sub Bidang Pensiun
        $SL = count(SatyaLencana::get());
        $pensiun = count(Pensiun::get());
        return view('pensiun.home', compact('pensiun', 'SL'));
    }

    public function karpeg()
    {
        //Sub bidang data dan informasi, mengurus karpeg, karis dan karsu
        $karpeg = count(Karpeg::get());
        $karsu = count(Karsu::get());
        $karis = count(Karis::get());
        return view('karpeg.home', compact('karpeg', 'karsu', 'karis'));
    }

    public function disiplin()
    {
        return view('disiplin.home');
    }

    public function kepegawaian()
    {
        return view('kepegawaian.home');
    }
}
