<?php

namespace App\Http\Controllers;

use App\Models\Karsu;
use App\Models\Pegawai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class KarsuController extends Controller
{
    public function user()
    {
        return Auth::user();
    }

    //function untuk admin skpd
    public function index()
    {   
        $data = Karsu::where('skpd_id', $this->user()->skpd->id)->orderBy('created_at','DESC')->paginate(10);
        return view('skpd.karsu.index',compact('data'));
    }

    public function create()
    {
        $pegawai = Pegawai::where('skpd_id',$this->user()->skpd->id)->get();
        return view('skpd.karsu.create',compact('pegawai'));
    }

    public function store(Request $req)
    {
        $attr = $req->all();
        $attr['skpd_id'] = $this->user()->skpd->id;
        
        Karsu::create($attr);
        toastr()->success('Berhasil Di Simpan');
        return redirect('/admin/karsu');
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
        
        $karsu = Karsu::find($id);

        $filename = $req->penamaan.'_'.$karsu->pegawai->nip.'.pdf';
        
        if($req->hasFile('file'))
        {
            $req->file->storeAs('/public/'.$karsu->pegawai->nip.'/karsu/'.$karsu->id,$filename);
        }

        $karsu->update([
            $req->field => $filename,
        ]);
        toastr()->success('Berhasil Di Simpan');
        return back();
    }
    
    public function validasi_kirim($id)
    {
        Karsu::find($id)->update(['status' =>1]);
        toastr()->success('Berhasil Di Kirim ke BKD');
        return  redirect('/admin/karsu');
    }

    public function detail($id)
    {
        $karsu  = Karsu::find($id);
        $pegawai = $karsu->pegawai;
        return view('skpd.karsu.detail',compact('pegawai','id','karsu'));
    }

    public function delete($id)
    {
        Karsu::find($id)->delete();
        toastr()->success('Berhasil Di Hapus');
        return back();
    }

    //function untuk admin sub bidang data dan informasi
    public function k_index()
    {   
        $data = Karsu::where('status', 1)->orWhere('status', 3)->orderBy('created_at','DESC')->paginate(10);
        $btl = Karsu::where('status',2)->orderBy('created_at','DESC')->paginate(10);
        return view('karpeg.karsu.index',compact('data','btl'));
    }

    public function k_tolak(Request $req)
    {
        Karsu::find($req->karsu_id)->update([
            'status' => 2, 
            'keterangan' => $req->keterangan_tolak,
        ]);

        toastr()->success('Berhasil Dikembalikan ke SKPD terkait');
        return back();
    }

    public function k_dokumen($id)
    {
        $karsu =  Karsu::find($id);
        $pegawai = $karsu->pegawai;
        return view('karpeg.karsu.detail',compact('karsu','pegawai'));
    }

    public function k_selesai($id)
    {
        Karsu::find($id)->update([
            'status' => 3, 
        ]);

        toastr()->success('Berhasil Disetujui');
        return back();
    }

    
}
