<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use App\Models\Kepangkatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KepangkatanController extends Controller
{
    public function index()
    {
        $data = Kepangkatan::orderBy('created_at','DESC')->paginate(10);
        return view('skpd.kepangkatan.index',compact('data'));
    }
    
    public function k_index()
    {
        return view('kepangkatan.pangkat.index');
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
}
