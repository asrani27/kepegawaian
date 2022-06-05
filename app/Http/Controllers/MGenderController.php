<?php

namespace App\Http\Controllers;

use App\Models\M_gender;
use Illuminate\Http\Request;

class MGenderController extends Controller
{
    public function index()
    {
        $data = M_gender::orderBy('id', 'DESC')->paginate(20);
        return view('kepegawaian.gender.index', compact('data'));
    }

    public function store(Request $req)
    {
        $attr = $req->all();
        $check = M_gender::where('nama', $req->nama)->first();
        if ($check == null) {
            M_gender::create($attr);
            toastr()->success('Berhasil disimpan');
            return redirect('/kepegawaian/data/gender');
        } else {
            toastr()->error('Sudah Ada');
            return back();
        }
    }
    public function update(Request $req)
    {
        $attr = $req->all();
        $check = M_gender::where('nama', $req->nama)->first();
        if ($check == null) {
            M_gender::find($req->gender_id)->update($attr);
            toastr()->success('Berhasil disimpan');
            return redirect('/kepegawaian/data/gender');
        } else {
            if ($req->gender_id == $check->id) {
                M_gender::find($req->gender_id)->update($attr);
                toastr()->success('Berhasil diupdate');
                return redirect('/kepegawaian/data/gender');
            } else {
                toastr()->error('Sudah ada');
                return back();
            }
        }
    }
    public function delete($id)
    {
        try {
            M_gender::find($id)->delete();
            toastr()->success('Berhasil dihapus');
            return back();
        } catch (\Exception $e) {
            toastr()->error('Tidak bisa di hapus karena ada relasi dengan data lain');
            return back();
        }
    }
}
