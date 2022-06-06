<?php

namespace App\Http\Controllers;

use App\Models\M_unitkerja;
use Illuminate\Http\Request;

class MUnitkerjaController extends Controller
{

    public function index()
    {
        $data = M_unitkerja::orderBy('id', 'DESC')->paginate(13);
        return view('kepegawaian.unitkerja.index', compact('data'));
    }

    public function create()
    {
        toastr()->info('sedang di kerjakan');
        return back();
        // $keljab = M_keljab::get();
        // $pangkat = M_pangkat::get();
        // return view('kepegawaian.unitkerja.create', compact('keljab', 'pangkat'));
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

        $check = M_unitkerja::where('nama_unitkerja', $req->nama_unitkerja)->first();

        if ($check == null) {
            M_unitkerja::create($attr);
            toastr()->success('Berhasil disimpan');
            return redirect('/kepegawaian/kelola/unitkerja');
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
        $data = M_unitkerja::find($id);
        return view('kepegawaian.unitkerja.edit', compact('keljab', 'pangkat', 'data'));
    }


    public function search()
    {
        $search = request()->search;

        $data = M_unitkerja::where('nama_unitkerja', 'like', '%' . $search . '%')->paginate(10);

        $data->appends(['search' => $search])->links();

        request()->flash();

        return view('kepegawaian.unitkerja.index', compact('data'));
    }

    public function update(Request $req, $id)
    {
        $attr = $req->all();
        $attr['nama_keljab'] = M_keljab::find($req->keljab_id)->nama;

        $check = M_unitkerja::where('nama_unitkerja', $req->nama_unitkerja)->first();
        if ($check == null) {
            M_unitkerja::find($id)->update($attr);
            toastr()->success('Berhasil di update');
            return redirect('/kepegawaian/kelola/unitkerja');
        } else {
            if ($id == $check->id) {
                M_unitkerja::find($id)->update($attr);
                toastr()->success('Berhasil diupdate');
                return redirect('/kepegawaian/kelola/unitkerja');
            } else {
                toastr()->error('Sudah ada');
                return back();
            }
        }
    }
    public function delete($id)
    {
        try {
            M_unitkerja::find($id)->delete();
            toastr()->success('Berhasil dihapus');
            return back();
        } catch (\Exception $e) {
            toastr()->error('Tidak bisa di hapus karena ada relasi dengan data lain');
            return back();
        }
    }
}
