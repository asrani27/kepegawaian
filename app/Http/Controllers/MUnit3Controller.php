<?php

namespace App\Http\Controllers;

use App\Models\M_unit3;
use Illuminate\Http\Request;

class MUnit3Controller extends Controller
{
    public function index()
    {
        $data = M_unit3::orderBy('id', 'DESC')->paginate(20);
        return view('kepegawaian.unit3.index', compact('data'));
    }

    public function store(Request $req)
    {
        $attr = $req->all();
        $check = M_unit3::where('nama', $req->nama)->first();
        if ($check == null) {
            M_unit3::create($attr);
            toastr()->success('Berhasil disimpan');
            return redirect('/kepegawaian/data/unit3');
        } else {
            toastr()->error('Sudah Ada');
            return back();
        }
    }
    public function update(Request $req)
    {
        $attr = $req->all();
        $check = M_unit3::where('nama', $req->nama)->first();
        if ($check == null) {
            M_unit3::find($req->unit3_id)->update($attr);
            toastr()->success('Berhasil disimpan');
            return redirect('/kepegawaian/data/unit3');
        } else {
            if ($req->unit3_id == $check->id) {
                M_unit3::find($req->unit3_id)->update($attr);
                toastr()->success('Berhasil diupdate');
                return redirect('/kepegawaian/data/unit3');
            } else {
                toastr()->error('Sudah ada');
                return back();
            }
        }
    }
    public function delete($id)
    {
        try {
            M_unit3::find($id)->delete();
            toastr()->success('Berhasil dihapus');
            return back();
        } catch (\Exception $e) {
            toastr()->error('Tidak bisa di hapus karena ada relasi dengan data lain');
            return back();
        }
    }
}
