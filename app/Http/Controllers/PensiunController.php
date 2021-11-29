<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use App\Models\Pensiun;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PensiunController extends Controller
{
    public function user()
    {
        return Auth::user();
    }

    public function index()
    {
        $data = Pensiun::where('skpd_id', $this->user()->skpd->id)->orderBy('created_at','DESC')->paginate(10);
        return view('skpd.pensiun.index',compact('data'));
    }
    
    public function create()
    {
        $pegawai = Pegawai::where('skpd_id',$this->user()->skpd->id)->get();
        return view('skpd.pensiun.create',compact('pegawai'));
    }
    
    public function store(Request $req)
    {
        $attr = $req->all();
        $attr['skpd_id'] = $this->user()->skpd->id;
        
        Pensiun::create($attr);
        toastr()->success('Berhasil Di Simpan');
        return redirect('/admin/pensiun');
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
        
        $pensiun = Pensiun::find($id);

        $filename = $req->penamaan.'_'.$pensiun->pegawai->nip.'.pdf';
        
        if($req->hasFile('file'))
        {
            $req->file->storeAs('/public/'.$pensiun->pegawai->nip.'/pensiun/'.$pensiun->jenis.'/'.$pensiun->id,$filename);
        }

        $pensiun->update([
            $req->field => $filename,
        ]);
        toastr()->success('Berhasil Di Simpan');
        return back();
    }
    
    public function detail($id)
    {
        $pensiun = Pensiun::find($id);
        $pegawai = $pensiun->pegawai;
        return view('skpd.pensiun.detail',compact('pegawai','id','pensiun'));
    }

    public function validasi_kirim($id)
    {
        Pensiun::find($id)->update(['status' =>1]);
        toastr()->success('Berhasil Di Kirim ke BKD');
        return  redirect('/admin/pensiun');
    }
    
    public function p_index()
    {
        $data = Pensiun::where('status', 1)->orderBy('created_at','DESC')->paginate(10);
        $tolak = Pensiun::where('status',2)->orderBy('created_at','DESC')->paginate(10);
        return view('pensiun.pensiun.index',compact('data','tolak'));
    }

    public function p_dokumen($id)
    {
        $pensiun =  Pensiun::find($id);
        $pegawai = $pensiun->pegawai;
        return view('pensiun.pensiun.detail',compact('pensiun','pegawai'));
    }

    public function p_tolak(Request $req)
    {
        Pensiun::find($req->pensiun_id)->update([
            'status' => 2, 
            'keterangan' => $req->keterangan_tolak,
        ]);

        toastr()->success('Berhasil Dikembalikan ke SKPD terkait');
        return back();
    }
}
