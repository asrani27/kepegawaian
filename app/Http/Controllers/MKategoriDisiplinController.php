<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\M_kategori_disiplin;

class MKategoriDisiplinController extends Controller
{
    public function index()
    {
        $data = M_kategori_disiplin::orderBy('id', 'DESC')->paginate(20);
        return view('disiplin.kategori.index', compact('data'));
    }

    public function store(Request $req)
    {
        $attr = $req->all();
        $check = M_kategori_disiplin::where('nama', $req->nama)->first();
        if ($check == null) {
            M_kategori_disiplin::create($attr);
            toastr()->success('Berhasil disimpan');
            return redirect('/disiplin/kategori');
        } else {
            toastr()->error('Sudah Ada');
            return back();
        }
    }
    public function update(Request $req)
    {
        $attr = $req->all();
        $check = M_kategori_disiplin::where('nama', $req->nama)->first();
        if ($check == null) {
            M_kategori_disiplin::find($req->kategori_id)->update($attr);
            toastr()->success('Berhasil disimpan');
            return redirect('/disiplin/kategori');
        } else {
            if ($req->kategori_id == $check->id) {
                M_kategori_disiplin::find($req->kategori_id)->update($attr);
                toastr()->success('Berhasil diupdate');
                return redirect('/disiplin/kategori');
            } else {
                toastr()->error('Sudah ada');
                return back();
            }
        }
    }
    public function delete($id)
    {
        try {
            M_kategori_disiplin::find($id)->delete();
            toastr()->success('Berhasil dihapus');
            return back();
        } catch (\Exception $e) {
            toastr()->error('Tidak bisa di hapus karena ada relasi dengan data lain');
            return back();
        }
    }
}
