<?php

namespace App\Http\Controllers;

use App\Models\M_kedudukan;
use Illuminate\Http\Request;

class MKedudukanController extends Controller
{
    public function index()
    {
        $data = M_kedudukan::orderBy('id', 'DESC')->paginate(20);
        return view('kepegawaian.kedudukan.index', compact('data'));
    }

    public function store(Request $req)
    {
        $attr = $req->all();
        $check = M_kedudukan::where('nama', $req->nama)->first();
        if ($check == null) {
            M_kedudukan::create($attr);
            toastr()->success('Berhasil disimpan');
            return redirect('/kepegawaian/data/kedudukan');
        } else {
            toastr()->error('Sudah Ada');
            return back();
        }
    }
    public function update(Request $req)
    {
        $attr = $req->all();
        $check = M_kedudukan::where('nama', $req->nama)->first();
        if ($check == null) {
            M_kedudukan::find($req->kedudukan_id)->update($attr);
            toastr()->success('Berhasil disimpan');
            return redirect('/kepegawaian/data/kedudukan');
        } else {
            if ($req->kedudukan_id == $check->id) {
                M_kedudukan::find($req->kedudukan_id)->update($attr);
                toastr()->success('Berhasil diupdate');
                return redirect('/kepegawaian/data/kedudukan');
            } else {
                toastr()->error('Sudah ada');
                return back();
            }
        }
    }
    public function delete($id)
    {
        try {
            M_kedudukan::find($id)->delete();
            toastr()->success('Berhasil dihapus');
            return back();
        } catch (\Exception $e) {
            toastr()->error('Tidak bisa di hapus karena ada relasi dengan data lain');
            return back();
        }
    }
}
