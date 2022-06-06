<?php

namespace App\Http\Controllers;

use App\Models\M_keljab;
use Illuminate\Http\Request;

class MKeljabController extends Controller
{
    public function index()
    {
        $data = M_keljab::orderBy('id', 'DESC')->get();
        return view('kepegawaian.keljab.index', compact('data'));
    }

    public function store(Request $req)
    {
        $attr = $req->all();
        $check = M_keljab::where('nama', $req->nama)->first();
        if ($check == null) {
            M_keljab::create($attr);
            toastr()->success('Berhasil disimpan');
            return redirect('/kepegawaian/data/keljab');
        } else {
            toastr()->error('Sudah Ada');
            return back();
        }
    }
    public function update(Request $req)
    {
        $attr = $req->all();
        $check = M_keljab::where('nama', $req->nama)->first();
        if ($check == null) {
            M_keljab::find($req->keljab_id)->update($attr);
            toastr()->success('Berhasil disimpan');
            return redirect('/kepegawaian/data/keljab');
        } else {
            if ($req->keljab_id == $check->id) {
                M_keljab::find($req->keljab_id)->update($attr);
                toastr()->success('Berhasil diupdate');
                return redirect('/kepegawaian/data/keljab');
            } else {
                toastr()->error('Sudah ada');
                return back();
            }
        }
    }
    public function delete($id)
    {
        try {
            M_keljab::find($id)->delete();
            toastr()->success('Berhasil dihapus');
            return back();
        } catch (\Exception $e) {
            toastr()->error('Tidak bisa di hapus karena ada relasi dengan data lain');
            return back();
        }
    }
}
