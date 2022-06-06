<?php

namespace App\Http\Controllers;

use App\Models\M_unit1;
use Illuminate\Http\Request;

class MUnit1Controller extends Controller
{

    public function index()
    {
        $data = M_unit1::orderBy('id', 'DESC')->paginate(20);
        return view('kepegawaian.unit1.index', compact('data'));
    }

    public function store(Request $req)
    {
        $attr = $req->all();
        $check = M_unit1::where('nama', $req->nama)->first();
        if ($check == null) {
            M_unit1::create($attr);
            toastr()->success('Berhasil disimpan');
            return redirect('/kepegawaian/data/unit1');
        } else {
            toastr()->error('Sudah Ada');
            return back();
        }
    }
    public function update(Request $req)
    {
        $attr = $req->all();
        $check = M_unit1::where('nama', $req->nama)->first();
        if ($check == null) {
            M_unit1::find($req->unit1_id)->update($attr);
            toastr()->success('Berhasil disimpan');
            return redirect('/kepegawaian/data/unit1');
        } else {
            if ($req->unit1_id == $check->id) {
                M_unit1::find($req->unit1_id)->update($attr);
                toastr()->success('Berhasil diupdate');
                return redirect('/kepegawaian/data/unit1');
            } else {
                toastr()->error('Sudah ada');
                return back();
            }
        }
    }
    public function delete($id)
    {
        try {
            M_unit1::find($id)->delete();
            toastr()->success('Berhasil dihapus');
            return back();
        } catch (\Exception $e) {
            toastr()->error('Tidak bisa di hapus karena ada relasi dengan data lain');
            return back();
        }
    }
}
