<?php

namespace App\Http\Controllers;

use App\Models\M_latjab;
use Illuminate\Http\Request;

class MLatjabController extends Controller
{
    public function index()
    {
        $data = M_latjab::orderBy('id', 'DESC')->paginate(20);
        return view('kepegawaian.latjab.index', compact('data'));
    }

    public function store(Request $req)
    {
        $attr = $req->all();
        $check = M_latjab::where('nama', $req->nama)->first();
        if ($check == null) {
            M_latjab::create($attr);
            toastr()->success('Berhasil disimpan');
            return redirect('/kepegawaian/data/latjab');
        } else {
            toastr()->error('Sudah Ada');
            return back();
        }
    }
    public function update(Request $req)
    {
        $attr = $req->all();
        $check = M_latjab::where('nama', $req->nama)->first();
        if ($check == null) {
            M_latjab::find($req->latjab_id)->update($attr);
            toastr()->success('Berhasil disimpan');
            return redirect('/kepegawaian/data/latjab');
        } else {
            if ($req->latjab_id == $check->id) {
                M_latjab::find($req->latjab_id)->update($attr);
                toastr()->success('Berhasil diupdate');
                return redirect('/kepegawaian/data/latjab');
            } else {
                toastr()->error('Sudah ada');
                return back();
            }
        }
    }
    public function delete($id)
    {
        try {
            M_latjab::find($id)->delete();
            toastr()->success('Berhasil dihapus');
            return back();
        } catch (\Exception $e) {
            toastr()->error('Tidak bisa di hapus karena ada relasi dengan data lain');
            return back();
        }
    }
}
