<?php

namespace App\Http\Controllers;

use App\Models\Periode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PeriodeController extends Controller
{
    public function index()
    {
        $layanan = Auth::user()->roles->first()->name;
        $data = Periode::where('jenis', $layanan)->paginate(10);
        return view('periode.index', compact('data'));
    }

    public function store(Request $req)
    {

        $param = $req->all();
        $param['jenis'] = Auth::user()->roles->first()->name;

        if (Periode::where('jenis', Auth::user()->roles->first()->name)->first() == null) {
            Periode::create($param);
            toastr()->success('Berhasil Di Simpan');
        } else {
            toastr()->error('periode sudah ada, harap edit yang ada');
        }
        return redirect('/periode');
    }
    public function update(Request $req)
    {
        $param = $req->all();
        $param['jenis'] = Auth::user()->roles->first()->name;
        Periode::find($req->periode_id)->update($param);
        toastr()->success('Berhasil Di update');
        return redirect('/periode');
    }
    public function delete($id)
    {

        if (Periode::find($id)->jenis === Auth::user()->roles->first()->name) {
            Periode::find($id)->delete();
            toastr()->success('Berhasil Di Hapus');
            return redirect('/periode');
        } else {
            toastr()->error('tidak bisa di hapus');
            return redirect('/periode');
        }
    }
}
