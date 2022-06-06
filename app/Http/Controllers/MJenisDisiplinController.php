<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\M_jenis_disiplin;
use App\Models\M_kategori_disiplin;

class MJenisDisiplinController extends Controller
{
    public function index()
    {
        $data = M_jenis_disiplin::orderBy('id', 'DESC')->paginate(13);
        return view('disiplin.jenis.index', compact('data'));
    }

    public function create()
    {
        $kategori = M_kategori_disiplin::get();
        return view('disiplin.jenis.create', compact('kategori'));
    }

    public function store(Request $req)
    {
        $attr = $req->all();


        $check = M_jenis_disiplin::where('nama', $req->nama)->first();

        if ($check == null) {
            M_jenis_disiplin::create($attr);
            toastr()->success('Berhasil disimpan');
            return redirect('/disiplin/jenis');
        } else {
            toastr()->error('Sudah Ada');
            $req->flash();
            return back();
        }
    }

    public function edit($id)
    {
        $kategori = M_kategori_disiplin::get();
        $data = M_jenis_disiplin::find($id);
        return view('disiplin.jenis.edit', compact('kategori', 'data'));
    }


    public function search()
    {
        $search = request()->search;

        $data = M_jenis_disiplin::where('nama_jenis', 'like', '%' . $search . '%')->paginate(10);

        $data->appends(['search' => $search])->links();

        request()->flash();

        return view('disiplin.jenis.index', compact('data'));
    }

    public function update(Request $req, $id)
    {
        $attr = $req->all();

        $check = M_jenis_disiplin::where('nama', $req->nama)->first();
        if ($check == null) {
            M_jenis_disiplin::find($id)->update($attr);
            toastr()->success('Berhasil di update');
            return redirect('/disiplin/jenis');
        } else {
            if ($id == $check->id) {
                M_jenis_disiplin::find($id)->update($attr);
                toastr()->success('Berhasil diupdate');
                return redirect('/disiplin/jenis');
            } else {
                toastr()->error('Sudah ada');
                return back();
            }
        }
    }
    public function delete($id)
    {
        try {
            M_jenis_disiplin::find($id)->delete();
            toastr()->success('Berhasil dihapus');
            return back();
        } catch (\Exception $e) {
            toastr()->error('Tidak bisa di hapus karena ada relasi dengan data lain');
            return back();
        }
    }
}
