<?php

namespace App\Http\Controllers;

use App\Models\M_insjab;
use Illuminate\Http\Request;

class MInsjabController extends Controller
{
    public function index()
    {
        $data = M_insjab::orderBy('id', 'DESC')->paginate(20);
        return view('kepegawaian.insjab.index', compact('data'));
    }

    public function store(Request $req)
    {
        $attr = $req->all();
        $check = M_insjab::where('nama', $req->nama)->first();
        if ($check == null) {
            M_insjab::create($attr);
            toastr()->success('Berhasil disimpan');
            return redirect('/kepegawaian/data/insjab');
        } else {
            toastr()->error('Sudah Ada');
            return back();
        }
    }
    public function update(Request $req)
    {
        $attr = $req->all();
        $check = M_insjab::where('nama', $req->nama)->first();
        if ($check == null) {
            M_insjab::find($req->insjab_id)->update($attr);
            toastr()->success('Berhasil disimpan');
            return redirect('/kepegawaian/data/insjab');
        } else {
            if ($req->insjab_id == $check->id) {
                M_insjab::find($req->insjab_id)->update($attr);
                toastr()->success('Berhasil diupdate');
                return redirect('/kepegawaian/data/insjab');
            } else {
                toastr()->error('Sudah ada');
                return back();
            }
        }
    }
    public function delete($id)
    {
        try {
            M_insjab::find($id)->delete();
            toastr()->success('Berhasil dihapus');
            return back();
        } catch (\Exception $e) {
            toastr()->error('Tidak bisa di hapus karena ada relasi dengan data lain');
            return back();
        }
    }
}
