<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\NonASN;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class NonASNController extends Controller
{
    public function index()
    {
        $data = NonASN::paginate(10);
        return view('superadmin.nonasn.index', compact('data'));
    }
    public function create()
    {
        return view('superadmin.nonasn.create');
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nik' =>  'unique:pegawai_non_asn',
        ]);

        if ($validator->fails()) {
            $request->flash();
            toastr()->error('NIP sudah ada');
            return back();
        }

        $attr = $request->all();

        NonASN::create($attr);

        toastr()->success('Sukses Di Simpan');
        return redirect('/superadmin/nonasn');
    }
}
