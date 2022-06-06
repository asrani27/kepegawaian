<?php

namespace App\Http\Controllers;

use App\Models\M_skpd;
use Illuminate\Http\Request;

class MSkpdController extends Controller
{
    public function index()
    {
        $data = M_skpd::orderBy('id', 'DESC')->get();
        return view('kepegawaian.skpd.index', compact('data'));
    }

    public function store(Request $req)
    {
        $attr = $req->all();
        $check = M_skpd::where('nama', $req->nama)->first();
        if ($check == null) {
            M_skpd::create($attr);
            toastr()->success('Berhasil disimpan');
            return redirect('/kepegawaian/data/skpd');
        } else {
            toastr()->error('Sudah Ada');
            return back();
        }
    }
    public function update(Request $req)
    {
        $attr = $req->all();
        $check = M_skpd::where('nama', $req->nama)->first();
        if ($check == null) {
            M_skpd::find($req->skpd_id)->update($attr);
            toastr()->success('Berhasil disimpan');
            return redirect('/kepegawaian/data/skpd');
        } else {
            if ($req->skpd_id == $check->id) {
                M_skpd::find($req->skpd_id)->update($attr);
                toastr()->success('Berhasil diupdate');
                return redirect('/kepegawaian/data/skpd');
            } else {
                toastr()->error('Sudah ada');
                return back();
            }
        }
    }
    public function delete($id)
    {
        try {
            M_skpd::find($id)->delete();
            toastr()->success('Berhasil dihapus');
            return back();
        } catch (\Exception $e) {
            toastr()->error('Tidak bisa di hapus karena ada relasi dengan data lain');
            return back();
        }
    }
}
