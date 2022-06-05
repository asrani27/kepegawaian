<?php

namespace App\Http\Controllers;

use App\Models\M_eselon;
use Illuminate\Http\Request;

class MEselonController extends Controller
{
    public function index()
    {
        $data = M_eselon::orderBy('id', 'DESC')->paginate(20);
        return view('kepegawaian.eselon.index', compact('data'));
    }

    public function store(Request $req)
    {
        $attr = $req->all();
        $check = M_eselon::where('nama', $req->nama)->first();
        if ($check == null) {
            M_eselon::create($attr);
            toastr()->success('Berhasil disimpan');
            return redirect('/kepegawaian/data/eselon');
        } else {
            toastr()->error('Sudah Ada');
            return back();
        }
    }
    public function update(Request $req)
    {
        $attr = $req->all();
        $check = M_eselon::where('nama', $req->nama)->first();
        if ($check == null) {
            M_eselon::find($req->eselon_id)->update($attr);
            toastr()->success('Berhasil disimpan');
            return redirect('/kepegawaian/data/eselon');
        } else {
            if ($req->eselon_id == $check->id) {
                M_eselon::find($req->eselon_id)->update($attr);
                toastr()->success('Berhasil diupdate');
                return redirect('/kepegawaian/data/eselon');
            } else {
                toastr()->error('Sudah ada');
                return back();
            }
        }
    }
    public function delete($id)
    {
        try {
            M_eselon::find($id)->delete();
            toastr()->success('Berhasil dihapus');
            return back();
        } catch (\Exception $e) {
            toastr()->error('Tidak bisa di hapus karena ada relasi dengan data lain');
            return back();
        }
    }
}
