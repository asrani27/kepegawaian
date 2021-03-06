<?php

namespace App\Http\Controllers;

use App\Models\M_pangkat;
use Illuminate\Http\Request;

class MPangkatController extends Controller
{

    public function index()
    {
        $data = M_pangkat::orderBy('id', 'DESC')->get();
        return view('kepegawaian.pangkat.index', compact('data'));
    }

    public function store(Request $req)
    {
        $attr = $req->all();
        $check = M_pangkat::where('pangkat', $req->pangkat)->first();
        if ($check == null) {
            M_pangkat::create($attr);
            toastr()->success('Berhasil disimpan');
            return redirect('/kepegawaian/data/pangkat');
        } else {
            toastr()->error('Sudah Ada');
            return back();
        }
    }
    public function update(Request $req)
    {
        $attr = $req->all();
        $check = M_pangkat::where('pangkat', $req->pangkat)->first();
        if ($check == null) {
            M_pangkat::find($req->pangkat_id)->update($attr);
            toastr()->success('Berhasil disimpan');
            return redirect('/kepegawaian/data/pangkat');
        } else {
            if ($req->pangkat_id == $check->id) {
                M_pangkat::find($req->pangkat_id)->update($attr);
                toastr()->success('Berhasil diupdate');
                return redirect('/kepegawaian/data/pangkat');
            } else {
                toastr()->error('Sudah ada');
                return back();
            }
        }
    }
    public function delete($id)
    {
        try {
            M_pangkat::find($id)->delete();
            toastr()->success('Berhasil dihapus');
            return back();
        } catch (\Exception $e) {
            toastr()->error('Tidak bisa di hapus karena ada relasi dengan data lain');
            return back();
        }
    }
}
