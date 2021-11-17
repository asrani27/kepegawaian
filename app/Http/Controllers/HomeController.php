<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Soal;
use App\Models\Waktu;
use App\Models\Berkala;
use App\Models\Jawaban;
use App\Models\Layanan;
use App\Models\Pegawai;
use App\Models\Peserta;
use App\Models\Kategori;
use App\Models\Pengajuan;
use App\Models\BenarSalah;
use App\Models\Kepangkatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function admin()
    {
        return view('skpd.home');
    }

    public function superadmin()
    {
        $pengajuan = Pengajuan::orderBy('status','ASC')->paginate(10);
        $t_pegawai = count(Pegawai::all());
        $t_pns = count(Pegawai::where('status_pegawai', 'PNS')->get());
        $t_cpns = count(Pegawai::where('status_pegawai', 'CPNS')->get());
        
        return view('superadmin.home',compact('pengajuan','t_pegawai','t_pns','t_cpns'));
    }

    public function gantipass()
    {
        return view('superadmin.gantipass.index');
    }

    public function resetpass(Request $req)
    {
        if($req->password1 == $req->password2){
            $u = Auth::user();
            $u->password = bcrypt($req->password1);
            $u->save();
    
            Auth::logout();
            toastr()->success('Berhasil Di Ubah, Login Dengan Password Baru');
            return redirect('/');
        }else{
            toastr()->error('Password Tidak Sama');
            return back();
        }
    }

    public function soal()
    {
        return Soal::get();
    }

    public function pegawai()
    {    
        $page = 'profil';
        $pegawai = Auth::user()->pegawai;
        $layanan = Layanan::get();
        $pengajuan = Pengajuan::where('pegawai_id', $pegawai->id)->get();
        return view('pegawai.home',compact('page','pegawai','layanan','pengajuan'));
    }

    public function kepangkatan()
    {
        //Sub Bidang Kepangkatan
        $pangkat = count(Kepangkatan::get());
        $berkala = count(Berkala::get());
        return view('kepangkatan.home',compact('berkala','pangkat'));
    }
}
