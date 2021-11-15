<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Berkala;
use App\Models\Pegawai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class BerkalaController extends Controller
{
    // Function Untuk Admin SKPD
    public function index()
    {
        $data = Berkala::where('skpd_id', Auth::user()->skpd->id)->orderBy('created_at','DESC')->paginate(10);
        return view('skpd.berkala.index',compact('data'));
    }

    public function create()
    {
        $pegawai = Pegawai::where('skpd_id',Auth::user()->skpd->id)->get();
        return view('skpd.berkala.create',compact('pegawai'));
    }

    public function store(Request $req)
    {
        //Simpan Di Table Berkala
        $peg = Pegawai::find($req->pegawai_id);
        $check = Berkala::where('nip', $peg->nip)->latest()->first();
        if($check == null){
            $b = new Berkala;
            $b->pegawai_id    = $req->pegawai_id;
            $b->nama          = $peg->nama;
            $b->tanggal_lahir = $peg->tanggal_lahir;
            $b->nip           = $peg->nip;
            $b->pangkat       = $peg->nm_pangkat; 
            $b->golongan      = $peg->gol_pangkat;
            $b->jabatan       = $peg->ket_jabatan;
            $b->unit_kerja    = $peg->unit_kerja;
            $b->skpd_id       = Auth::user()->skpd->id;
            $b->save();
            
            toastr()->success('Berkala Berhasil Di Simpan, Lanjutkan Ke Upload Persyaratan');
            return redirect('/admin/berkala');
        }else{
            $now = Carbon::today()->format('Y-m-d');
            $validate_tanggal = Carbon::parse($check->created_at)->addYears(1)->format('Y-m-d');
            if($now > $validate_tanggal){
                $b = new Berkala;
                $b->pegawai_id  = $req->pegawai_id;
                $b->nama        = $peg->nama;
                $b->nip         = $peg->nip;
                $b->tanggal_lahir = $peg->tanggal_lahir;
                $b->pangkat     = $peg->nm_pangkat;
                $b->golongan    = $peg->gol_pangkat;
                $b->jabatan     = $peg->ket_jabatan;
                $b->unit_kerja  = $peg->unit_kerja;
                $b->skpd_id     = Auth::user()->skpd->id;
                $b->save();
                
                toastr()->success('Berkala Berhasil Di Simpan, Lanjutkan Ke Upload Persyaratan');
                return redirect('/admin/home');
            }else{
                toastr()->error('Belum Bisa Mengajukan karena belum memenuhi syarat 2 tahun');
                return back();
            }
        }
    }
    
    public function upload($id)
    {
        $pegawai = Berkala::find($id);
        return view('skpd.berkala.upload',compact('pegawai'));
    }
    
    public function storeUpload(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'sk_cpns'  => 'mimes:pdf|max:5120',
            'sk_pns'  => 'mimes:pdf|max:5120',
            'sk_pangkat'  => 'mimes:pdf|max:5120',
            'sk_berkala'  => 'mimes:pdf|max:5120',
        ]);

        if ($validator->fails()) {
            toastr()->error('File harus PDF dan Maks 5MB');
            return back();
        }
        
        $berkala = Berkala::find($id);

        $sk_cpns = $request->sk_cpns == null ? $berkala->sk_cpns : 'SKCPNS_'.$berkala->nip.'.pdf';
        $sk_pns  = $request->sk_pns == null ? $berkala->sk_pns : 'SKPNS_'.$berkala->nip.'.pdf';
        $sk_pangkat = $request->sk_pangkat == null ? $berkala->sk_pangkat : 'SKPANGKAT_'.$berkala->nip.'.pdf';
        $sk_berkala = $request->sk_berkala == null ? $berkala->sk_berkala : 'SKBERKALA_'.$berkala->nip.'.pdf';
        
        $berkala->update([
            'sk_cpns' => $sk_cpns,
            'sk_pns' => $sk_pns,
            'sk_pangkat' => $sk_pangkat,
            'sk_berkala' => $sk_berkala,
        ]);

        if($request->hasFile('sk_cpns'))
        {
            $request->sk_cpns->storeAs('/public/'.$berkala->nip.'/berkala/'.$berkala->id,$sk_cpns);
        }
        if($request->hasFile('sk_pns'))
        {
            $request->sk_pns->storeAs('/public/'.$berkala->nip.'/berkala/'.$berkala->id,$sk_pns);
        }
        if($request->hasFile('sk_pangkat'))
        {
            $request->sk_pangkat->storeAs('/public/'.$berkala->nip.'/berkala/'.$berkala->id,$sk_pangkat);
        }
        if($request->hasFile('sk_berkala'))
        {
            $request->sk_pangkat->storeAs('/public/'.$berkala->nip.'/berkala/'.$berkala->id,$sk_berkala);
        }

        toastr()->success('Berhasil Di Upload');
        return redirect('/admin/berkala');
    }

    public function validasi_kirim($id)
    {
        Berkala::find($id)->update(['validasi_skpd' => 1]);
        toastr()->success('Berhasil Di Verfikasi Dan Di Kirim Ke BKD');
        return back();
    }

    // Fucntion Untuk Admin Sub Bidang Kepangkatan
    public function k_index()
    {
        $data = Berkala::where('validasi_skpd',1)->paginate(10);
        $ttd = Pegawai::where('ttd', 1)->first();
        return view('kepangkatan.berkala.index',compact('data','ttd'));
    }

    public function sk_berkala($id)
    {
        $data = Berkala::find($id);
        $ttd = Pegawai::where('ttd', 1)->first();
        return view('kepangkatan.berkala.sk',compact('data','ttd'));
    } 

    public function sk_berkala_edit($id)
    {
        $data = Berkala::find($id);
        return view('kepangkatan.berkala.sk_edit',compact('data'));
    }

    public function simpan_sk_berkala(Request $req, $id)
    {
        $attr = $req->all();
        $attr['gaji_lama']      = str_replace(',','',$req->gaji_lama);
        $attr['gaji_baru']      = str_replace(',','',$req->gaji_baru);
        $attr['status_sk']      = 1;
        
        Berkala::find($id)->update($attr);
        toastr()->success('SK Berhasil Di Buat');
        return redirect('/kepangkatan/berkala');
    }

    public function cetak_sk_berkala()
    {

    }
    
    public function k_tolak()
    {

    }
    
    public function k_editpejabat()
    {
        $pegawai = Pegawai::where('skpd_id', 25)->get();
        $ttd = Pegawai::where('ttd', 1)->first();
        return view('kepangkatan.berkala.ttd',compact('pegawai','ttd'));
    }

    public function s_editpejabat(Request $req)
    {
        $pegawai_ttd_sebelumnya = Pegawai::where('ttd', 1)->first();
        if($pegawai_ttd_sebelumnya != null){
            $pegawai_ttd_sebelumnya->update(['ttd' => null]);
        }
        Pegawai::find($req->pegawai_id)->update(['ttd' => 1]);
        toastr()->success('Pejabat TTD Berhasil Di Update');
        return redirect('/kepangkatan/berkala');
    }

    public function printSK($id)
    {
        $data = Berkala::find($id);
        return view('kepangkatan.berkala.print',compact('data'));
    }
}
