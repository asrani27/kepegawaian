<?php

namespace App\Http\Controllers;

use App\Models\Karis;
use App\Models\Pegawai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class KarisController extends Controller
{
    
    public function user()
    {
        return Auth::user();
    }

    //function untuk admin skpd
    public function index()
    {   
        $data = Karis::where('skpd_id', $this->user()->skpd->id)->orderBy('created_at','DESC')->paginate(10);
        return view('skpd.karis.index',compact('data'));
    }

    public function create()
    {
        $pegawai = Pegawai::where('skpd_id',$this->user()->skpd->id)->get();
        return view('skpd.karis.create',compact('pegawai'));
    }

    public function store(Request $req)
    {
        $attr = $req->all();
        $attr['skpd_id'] = $this->user()->skpd->id;
        
        Karis::create($attr);
        toastr()->success('Berhasil Di Simpan');
        return redirect('/admin/karis');
    }
    
    public function uploadSyarat(Request $req, $id)
    {
        $validator = Validator::make($req->all(), [
            'file'  => 'mimes:pdf|max:2058',
        ]);

        if ($validator->fails()) {
            toastr()->error('File harus PDF dan Maks 2MB');
            return back();
        }
        
        $karis = Karis::find($id);

        $filename = $req->penamaan.'_'.$karis->pegawai->nip.'.pdf';
        
        if($req->hasFile('file'))
        {
            $req->file->storeAs('/public/'.$karis->pegawai->nip.'/karis/'.$karis->id,$filename);
        }

        $karis->update([
            $req->field => $filename,
        ]);
        toastr()->success('Berhasil Di Simpan');
        return back();
    }
    
    public function validasi_kirim($id)
    {
        Karis::find($id)->update(['status' =>1]);
        toastr()->success('Berhasil Di Kirim ke BKD');
        return  redirect('/admin/karis');
    }

    public function detail($id)
    {
        $karis  = Karis::find($id);
        $pegawai = $karis->pegawai;
        return view('skpd.karis.detail',compact('pegawai','id','karis'));
    }

    public function delete($id)
    {
        Karis::find($id)->delete();
        toastr()->success('Berhasil Di Hapus');
        return back();
    }

    //function untuk admin sub bidang data dan informasi
    public function k_index()
    {   
        $data = Karis::where('status', 1)->orWhere('status', 3)->orderBy('created_at','DESC')->paginate(10);
        $btl = Karis::where('status',2)->orderBy('created_at','DESC')->paginate(10);
        return view('karpeg.karis.index',compact('data','btl'));
    }

    public function k_tolak(Request $req)
    {
        Karis::find($req->karis_id)->update([
            'status' => 2, 
            'keterangan' => $req->keterangan_tolak,
        ]);

        toastr()->success('Berhasil Dikembalikan ke SKPD terkait');
        return back();
    }

    public function k_dokumen($id)
    {
        $karis =  Karis::find($id);
        $pegawai = $karis->pegawai;
        return view('karpeg.karis.detail',compact('karis','pegawai'));
    }

    public function k_selesai($id)
    {
        Karis::find($id)->update([
            'status' => 3, 
        ]);

        toastr()->success('Berhasil Disetujui');
        return back();
    }
}
