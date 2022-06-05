<?php

namespace App\Http\Controllers;

use App\Models\M_jabatan;
use Illuminate\Http\Request;

class MJabatanController extends Controller
{
    public function index()
    {
        $data = M_jabatan::orderBy('id', 'DESC')->get();
        return view('kepegawaian.jabatan.index', compact('data'));
    }

    public function store(Request $req)
    {
        $attr = $req->all();
        $check = M_jabatan::where('nama', $req->nama)->first();
        if ($check == null) {
            M_jabatan::create($attr);
            toastr()->success('Berhasil disimpan');
            return redirect('/kepegawaian/data/jabatan');
        } else {
            toastr()->error('Sudah Ada');
            return back();
        }
    }
    public function update(Request $req)
    {
        $attr = $req->all();
        $check = M_jabatan::where('nama', $req->nama)->first();
        if ($check == null) {
            M_jabatan::find($req->jabatan_id)->update($attr);
            toastr()->success('Berhasil disimpan');
            return redirect('/kepegawaian/data/jabatan');
        } else {
            if ($req->jabatan_id == $check->id) {
                M_jabatan::find($req->jabatan_id)->update($attr);
                toastr()->success('Berhasil diupdate');
                return redirect('/kepegawaian/data/jabatan');
            } else {
                toastr()->error('Sudah ada');
                return back();
            }
        }
    }
    public function delete($id)
    {
        try {
            M_jabatan::find($id)->delete();
            toastr()->success('Berhasil dihapus');
            return back();
        } catch (\Exception $e) {
            toastr()->error('Tidak bisa di hapus karena ada relasi dengan data lain');
            return back();
        }
    }
}
