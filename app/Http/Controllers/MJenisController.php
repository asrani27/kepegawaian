<?php

namespace App\Http\Controllers;

use App\Models\M_jenis;
use Illuminate\Http\Request;

class MJenisController extends Controller
{
    public function index()
    {
        $data = M_jenis::orderBy('id', 'DESC')->paginate(10);
        return view('kepegawaian.jenis.index', compact('data'));
    }

    public function store(Request $req)
    {
        $attr = $req->all();
        $check = M_jenis::where('nama', $req->nama)->first();
        if ($check == null) {
            M_jenis::create($attr);
            toastr()->success('Berhasil disimpan');
            return redirect('/kepegawaian/data/jenis');
        } else {
            toastr()->error('Sudah Ada');
            return back();
        }
    }
    public function update(Request $req)
    {
        $attr = $req->all();
        $check = M_jenis::where('nama', $req->nama)->first();
        if ($check == null) {
            M_jenis::find($req->jenis_id)->update($attr);
            toastr()->success('Berhasil disimpan');
            return redirect('/kepegawaian/data/jenis');
        } else {
            if ($req->jenis_id == $check->id) {
                M_jenis::find($req->jenis_id)->update($attr);
                toastr()->success('Berhasil diupdate');
                return redirect('/kepegawaian/data/jenis');
            } else {
                toastr()->error('Sudah ada');
                return back();
            }
        }
    }
    public function delete($id)
    {
        try {
            M_jenis::find($id)->delete();
            toastr()->success('Berhasil dihapus');
            return back();
        } catch (\Exception $e) {
            toastr()->error('Tidak bisa di hapus karena ada relasi dengan data lain');
            return back();
        }
    }
}
