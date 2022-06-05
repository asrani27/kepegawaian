<?php

namespace App\Http\Controllers;

use App\Models\M_goldarah;
use Illuminate\Http\Request;

class MGoldarahController extends Controller
{
    public function index()
    {
        $data = M_goldarah::orderBy('id', 'DESC')->paginate(20);
        return view('kepegawaian.goldarah.index', compact('data'));
    }

    public function store(Request $req)
    {
        $attr = $req->all();
        $check = M_goldarah::where('nama', $req->nama)->first();
        if ($check == null) {
            M_goldarah::create($attr);
            toastr()->success('Berhasil disimpan');
            return redirect('/kepegawaian/data/goldarah');
        } else {
            toastr()->error('Sudah Ada');
            return back();
        }
    }
    public function update(Request $req)
    {
        $attr = $req->all();
        $check = M_goldarah::where('nama', $req->nama)->first();
        if ($check == null) {
            M_goldarah::find($req->goldarah_id)->update($attr);
            toastr()->success('Berhasil disimpan');
            return redirect('/kepegawaian/data/goldarah');
        } else {
            if ($req->goldarah_id == $check->id) {
                M_goldarah::find($req->goldarah_id)->update($attr);
                toastr()->success('Berhasil diupdate');
                return redirect('/kepegawaian/data/goldarah');
            } else {
                toastr()->error('Sudah ada');
                return back();
            }
        }
    }
    public function delete($id)
    {
        try {
            M_goldarah::find($id)->delete();
            toastr()->success('Berhasil dihapus');
            return back();
        } catch (\Exception $e) {
            toastr()->error('Tidak bisa di hapus karena ada relasi dengan data lain');
            return back();
        }
    }
}
