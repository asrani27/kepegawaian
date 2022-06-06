<?php

namespace App\Http\Controllers;

use App\Models\M_unit2;
use Illuminate\Http\Request;

class MUnit2Controller extends Controller
{
    public function index()
    {
        $data = M_unit2::orderBy('id', 'DESC')->paginate(20);
        return view('kepegawaian.unit2.index', compact('data'));
    }

    public function store(Request $req)
    {
        $attr = $req->all();
        $check = M_unit2::where('nama', $req->nama)->first();
        if ($check == null) {
            M_unit2::create($attr);
            toastr()->success('Berhasil disimpan');
            return redirect('/kepegawaian/data/unit2');
        } else {
            toastr()->error('Sudah Ada');
            return back();
        }
    }
    public function update(Request $req)
    {
        $attr = $req->all();
        $check = M_unit2::where('nama', $req->nama)->first();
        if ($check == null) {
            M_unit2::find($req->unit2_id)->update($attr);
            toastr()->success('Berhasil disimpan');
            return redirect('/kepegawaian/data/unit2');
        } else {
            if ($req->unit2_id == $check->id) {
                M_unit2::find($req->unit2_id)->update($attr);
                toastr()->success('Berhasil diupdate');
                return redirect('/kepegawaian/data/unit2');
            } else {
                toastr()->error('Sudah ada');
                return back();
            }
        }
    }
    public function delete($id)
    {
        try {
            M_unit2::find($id)->delete();
            toastr()->success('Berhasil dihapus');
            return back();
        } catch (\Exception $e) {
            toastr()->error('Tidak bisa di hapus karena ada relasi dengan data lain');
            return back();
        }
    }
}
