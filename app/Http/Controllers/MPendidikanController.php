<?php

namespace App\Http\Controllers;

use App\Models\M_pendidikan;
use Illuminate\Http\Request;

class MPendidikanController extends Controller
{
    public function index()
    {
        $data = M_pendidikan::orderBy('id', 'DESC')->paginate(20);
        return view('kepegawaian.pendidikan.index', compact('data'));
    }

    public function store(Request $req)
    {
        $attr = $req->all();
        $check = M_pendidikan::where('nama', $req->nama)->first();
        if ($check == null) {
            M_pendidikan::create($attr);
            toastr()->success('Berhasil disimpan');
            return redirect('/kepegawaian/data/pendidikan');
        } else {
            toastr()->error('Sudah Ada');
            return back();
        }
    }
    public function update(Request $req)
    {
        $attr = $req->all();
        $check = M_pendidikan::where('nama', $req->nama)->first();
        if ($check == null) {
            M_pendidikan::find($req->pendidikan_id)->update($attr);
            toastr()->success('Berhasil disimpan');
            return redirect('/kepegawaian/data/pendidikan');
        } else {
            if ($req->pendidikan_id == $check->id) {
                M_pendidikan::find($req->pendidikan_id)->update($attr);
                toastr()->success('Berhasil diupdate');
                return redirect('/kepegawaian/data/pendidikan');
            } else {
                toastr()->error('Sudah ada');
                return back();
            }
        }
    }
    public function delete($id)
    {
        try {
            M_pendidikan::find($id)->delete();
            toastr()->success('Berhasil dihapus');
            return back();
        } catch (\Exception $e) {
            toastr()->error('Tidak bisa di hapus karena ada relasi dengan data lain');
            return back();
        }
    }
}
