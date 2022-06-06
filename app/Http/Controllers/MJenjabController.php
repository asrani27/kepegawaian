<?php

namespace App\Http\Controllers;

use App\Models\M_jenjab;
use App\Models\M_keljab;
use App\Models\M_pangkat;
use Illuminate\Http\Request;

class MJenjabController extends Controller
{
    public function index()
    {
        $data = M_jenjab::orderBy('id', 'DESC')->paginate(13);
        return view('kepegawaian.jenjab.index', compact('data'));
    }

    public function create()
    {
        $keljab = M_keljab::get();
        $pangkat = M_pangkat::get();
        return view('kepegawaian.jenjab.create', compact('keljab', 'pangkat'));
    }

    public function store(Request $req)
    {
        $attr = $req->all();

        if ($req->min_pangkat_id > $req->max_pangkat_id) {
            toastr()->error('MIN Pangkat tidak boleh lebih tinggi dari MAX Pangkat');
            $req->flash();
            return back();
        }
        $attr['nama_keljab'] = M_keljab::find($req->keljab_id)->nama;

        $check = M_jenjab::where('nama_jenjab', $req->nama_jenjab)->first();

        if ($check == null) {
            M_jenjab::create($attr);
            toastr()->success('Berhasil disimpan');
            return redirect('/kepegawaian/kelola/jenjab');
        } else {
            toastr()->error('Sudah Ada');
            $req->flash();
            return back();
        }
    }

    public function edit($id)
    {
        $keljab = M_keljab::get();
        $pangkat = M_pangkat::get();
        $data = M_jenjab::find($id);
        return view('kepegawaian.jenjab.edit', compact('keljab', 'pangkat', 'data'));
    }


    public function search()
    {
        $search = request()->search;

        $data = M_jenjab::where('nama_jenjab', 'like', '%' . $search . '%')->paginate(10);

        $data->appends(['search' => $search])->links();

        request()->flash();

        return view('kepegawaian.jenjab.index', compact('data'));
    }

    public function update(Request $req, $id)
    {
        $attr = $req->all();
        $attr['nama_keljab'] = M_keljab::find($req->keljab_id)->nama;

        $check = M_jenjab::where('nama_jenjab', $req->nama_jenjab)->first();
        if ($check == null) {
            M_jenjab::find($id)->update($attr);
            toastr()->success('Berhasil di update');
            return redirect('/kepegawaian/kelola/jenjab');
        } else {
            if ($id == $check->id) {
                M_jenjab::find($id)->update($attr);
                toastr()->success('Berhasil diupdate');
                return redirect('/kepegawaian/kelola/jenjab');
            } else {
                toastr()->error('Sudah ada');
                return back();
            }
        }
    }
    public function delete($id)
    {
        try {
            M_jenjab::find($id)->delete();
            toastr()->success('Berhasil dihapus');
            return back();
        } catch (\Exception $e) {
            toastr()->error('Tidak bisa di hapus karena ada relasi dengan data lain');
            return back();
        }
    }
}
