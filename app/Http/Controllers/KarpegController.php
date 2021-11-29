<?php

namespace App\Http\Controllers;

use App\Models\Karpeg;
use App\Models\Pegawai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class KarpegController extends Controller
{
    public function user()
    {
        return Auth::user();
    }

    //function untuk admin skpd
    public function index()
    {   
        $data = Karpeg::where('skpd_id', $this->user()->skpd->id)->orderBy('created_at','DESC')->paginate(10);
        return view('skpd.karpeg.index',compact('data'));
    }

    public function create()
    {
        $pegawai = Pegawai::where('skpd_id',$this->user()->skpd->id)->get();
        return view('skpd.karpeg.create',compact('pegawai'));
    }

    public function store(Request $req)
    {
        $attr = $req->all();
        $attr['skpd_id'] = $this->user()->skpd->id;
        
        Karpeg::create($attr);
        toastr()->success('Berhasil Di Simpan');
        return redirect('/admin/karpeg');
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
        
        $karpeg = Karpeg::find($id);

        $filename = $req->penamaan.'_'.$karpeg->pegawai->nip.'.pdf';
        
        if($req->hasFile('file'))
        {
            $req->file->storeAs('/public/'.$karpeg->pegawai->nip.'/karpeg/'.$karpeg->id,$filename);
        }

        $karpeg->update([
            $req->field => $filename,
        ]);
        toastr()->success('Berhasil Di Simpan');
        return back();
    }
    
    public function validasi_kirim($id)
    {
        Karpeg::find($id)->update(['status' =>1]);
        toastr()->success('Berhasil Di Kirim ke BKD');
        return  redirect('/admin/karpeg');
    }

    public function detail($id)
    {
        $karpeg  = Karpeg::find($id);
        $pegawai = $karpeg->pegawai;
        return view('skpd.karpeg.detail',compact('pegawai','id','karpeg'));
    }

    public function delete($id)
    {
        Karpeg::find($id)->delete();
        toastr()->success('Berhasil Di Hapus');
        return back();
    }

    //function untuk admin sub bidang data dan informasi
    public function k_index()
    {   
        $data = Karpeg::where('status', 1)->orWhere('status', 3)->orderBy('created_at','DESC')->paginate(10);
        $btl = Karpeg::where('status',2)->orderBy('created_at','DESC')->paginate(10);
        return view('karpeg.karpeg.index',compact('data','btl'));
    }

    public function k_tolak(Request $req)
    {
        Karpeg::find($req->karpeg_id)->update([
            'status' => 2, 
            'keterangan' => $req->keterangan_tolak,
            'validassi_skpd' => null,
        ]);

        toastr()->success('Berhasil Dikembalikan ke SKPD terkait');
        return back();
    }

    public function k_dokumen($id)
    {
        $karpeg =  Karpeg::find($id);
        $pegawai = $karpeg->pegawai;
        return view('karpeg.karpeg.detail',compact('karpeg','pegawai'));
    }

    public function k_selesai($id)
    {
        Karpeg::find($id)->update([
            'status' => 3, 
        ]);

        toastr()->success('Berhasil Disetujui');
        return back();
    }
}
