<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use App\Models\M_pegawai;
use Illuminate\Http\Request;

class MPegawaiController extends Controller
{
    public function index()
    {
        $data = M_pegawai::paginate(10);
        return view('kepegawaian.pegawai.index', compact('data'));
    }

    public function search()
    {
        $search = request()->search;
        $data = M_pegawai::where('nip', 'like', '%' . $search . '%')->orWhere('nama', 'like', '%' . $search . '%')->paginate(10);
        $data->appends(['search' => $search])->links();
        request()->flash();
        return view('kepegawaian.pegawai.index', compact('data'));
    }
}
