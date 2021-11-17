<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use App\Models\Kepangkatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class KepangkatanController extends Controller
{
    public function index()
    {
        $data = Kepangkatan::orderBy('created_at','DESC')->paginate(10);
        return view('skpd.kepangkatan.index',compact('data'));
    }
    
    public function k_index()
    {   
        $data = Kepangkatan::where('status', 1)->orderBy('created_at','DESC')->paginate(10);
        return view('kepangkatan.pangkat.index',compact('data'));
    }
    
    public function k_dokumen($id)
    {
        $data =  Kepangkatan::find($id);
        return view('kepangkatan.pangkat.detail',compact('data'));
    }
    
    public function create()
    {
        $pegawai = Pegawai::where('skpd_id',Auth::user()->skpd->id)->get();
        return view('skpd.kepangkatan.create',compact('pegawai'));
    }
    
    public function store(Request $req)
    {
        $attr = $req->all();
        Kepangkatan::create($attr);
        toastr()->success('Berhasil Di Simpan');
        return redirect('/admin/kepangkatan');
    }

    public function detail($id)
    {
        $pangkat = Kepangkatan::find($id);
        $pegawai = $pangkat->pegawai;
        return view('skpd.kepangkatan.detail',compact('pegawai','id','pangkat'));
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
        
        $pangkat = Kepangkatan::find($id);

        $filename = $req->penamaan.'_'.$pangkat->pegawai->nip.'.pdf';
        
        if($req->hasFile('file'))
        {
            $req->file->storeAs('/public/'.$pangkat->pegawai->nip.'/pangkat/'.$req->jenis.'/'.$pangkat->id,$filename);
        }

        $pangkat->update([
            $req->field => $filename,
        ]);
        toastr()->success('Berhasil Di Simpan');
        return back();
    }

    public function validasi_kirim($id)
    {
        Kepangkatan::find($id)->update(['status' =>1]);
        toastr()->success('Berhasil Di Kirim ke BKD');
        return  redirect('/admin/kepangkatan');
    }
}
