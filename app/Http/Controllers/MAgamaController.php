<?php

namespace App\Http\Controllers;

use App\Models\M_agama;
use Illuminate\Http\Request;

class MAgamaController extends Controller
{
    public function index()
    {
        $data = M_agama::orderBy('id', 'DESC')->paginate(20);
        return view('kepegawaian.agama.index', compact('data'));
    }

    public function store(Request $req)
    {
        $attr = $req->all();
        $check = M_agama::where('nama', $req->nama)->first();
        if ($check == null) {
            M_agama::create($attr);
            toastr()->success('Berhasil disimpan');
            return redirect('/kepegawaian/data/agama');
        } else {
            toastr()->error('Sudah Ada');
            return back();
        }
    }
    public function update(Request $req)
    {
        $attr = $req->all();
        $check = M_agama::where('nama', $req->nama)->first();
        if ($check == null) {
            M_agama::find($req->agama_id)->update($attr);
            toastr()->success('Berhasil disimpan');
            return redirect('/kepegawaian/data/agama');
        } else {
            if ($req->agama_id == $check->id) {
                M_agama::find($req->agama_id)->update($attr);
                toastr()->success('Berhasil diupdate');
                return redirect('/kepegawaian/data/agama');
            } else {
                toastr()->error('Sudah ada');
                return back();
            }
        }
    }
    public function delete($id)
    {
        try {
            M_agama::find($id)->delete();
            toastr()->success('Berhasil dihapus');
            return back();
        } catch (\Exception $e) {
            toastr()->error('Tidak bisa di hapus karena ada relasi dengan data lain');
            return back();
        }
    }
}
