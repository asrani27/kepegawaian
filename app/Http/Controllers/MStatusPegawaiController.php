<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\M_status_pegawai;

class MStatusPegawaiController extends Controller
{
    public function index()
    {
        $data = M_status_pegawai::orderBy('id', 'DESC')->paginate(20);
        return view('kepegawaian.status.index', compact('data'));
    }

    public function store(Request $req)
    {
        $attr = $req->all();
        $check = M_status_pegawai::where('nama', $req->nama)->first();
        if ($check == null) {
            M_status_pegawai::create($attr);
            toastr()->success('Berhasil disimpan');
            return redirect('/kepegawaian/data/status');
        } else {
            toastr()->error('Sudah Ada');
            return back();
        }
    }
    public function update(Request $req)
    {
        $attr = $req->all();
        $check = M_status_pegawai::where('nama', $req->nama)->first();
        if ($check == null) {
            M_status_pegawai::find($req->status_id)->update($attr);
            toastr()->success('Berhasil disimpan');
            return redirect('/kepegawaian/data/status');
        } else {
            if ($req->status_id == $check->id) {
                M_status_pegawai::find($req->status_id)->update($attr);
                toastr()->success('Berhasil diupdate');
                return redirect('/kepegawaian/data/status');
            } else {
                toastr()->error('Sudah ada');
                return back();
            }
        }
    }
    public function delete($id)
    {
        try {
            M_status_pegawai::find($id)->delete();
            toastr()->success('Berhasil dihapus');
            return back();
        } catch (\Exception $e) {
            toastr()->error('Tidak bisa di hapus karena ada relasi dengan data lain');
            return back();
        }
    }
}
