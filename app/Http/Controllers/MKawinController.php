<?php

namespace App\Http\Controllers;

use App\Models\M_kawin;
use Illuminate\Http\Request;

class MKawinController extends Controller
{
    public function index()
    {
        $data = M_kawin::orderBy('id', 'DESC')->paginate(20);
        return view('kepegawaian.kawin.index', compact('data'));
    }

    public function store(Request $req)
    {
        $attr = $req->all();
        $check = M_kawin::where('nama', $req->nama)->first();
        if ($check == null) {
            M_kawin::create($attr);
            toastr()->success('Berhasil disimpan');
            return redirect('/kepegawaian/data/kawin');
        } else {
            toastr()->error('Sudah Ada');
            return back();
        }
    }
    public function update(Request $req)
    {
        $attr = $req->all();
        $check = M_kawin::where('nama', $req->nama)->first();
        if ($check == null) {
            M_kawin::find($req->kawin_id)->update($attr);
            toastr()->success('Berhasil disimpan');
            return redirect('/kepegawaian/data/kawin');
        } else {
            if ($req->kawin_id == $check->id) {
                M_kawin::find($req->kawin_id)->update($attr);
                toastr()->success('Berhasil diupdate');
                return redirect('/kepegawaian/data/kawin');
            } else {
                toastr()->error('Sudah ada');
                return back();
            }
        }
    }
    public function delete($id)
    {
        try {
            M_kawin::find($id)->delete();
            toastr()->success('Berhasil dihapus');
            return back();
        } catch (\Exception $e) {
            toastr()->error('Tidak bisa di hapus karena ada relasi dengan data lain');
            return back();
        }
    }
}
