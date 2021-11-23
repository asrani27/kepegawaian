<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use App\Models\SatyaLencana;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class SatyaLencanaController extends Controller
{
    public function index()
    {
        $data = SatyaLencana::orderBy('created_at','DESC')->paginate(10);        
        return view('skpd.satyalencana.index',compact('data'));
    }

    public function create()
    {
        $pegawai = Pegawai::where('skpd_id',Auth::user()->skpd->id)->get();
        return view('skpd.satyalencana.create',compact('pegawai'));
    }
    
    public function store(Request $req)
    {
        $attr = $req->all();
        SatyaLencana::create($attr);
        toastr()->success('Berhasil Di Simpan');
        return redirect('/admin/satyalencana');
    }

    public function upload($id)
    {
        $pegawai = SatyaLencana::find($id)->pegawai;
        return view('skpd.satyalencana.upload',compact('pegawai','id'));
    }
    
    public function storeUpload(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'sk_cpns'  => 'mimes:pdf|max:5120',
            'sk_pns'  => 'mimes:pdf|max:5120',
            'sk_jabatan'  => 'mimes:pdf|max:5120',
            'skp1tahun'  => 'mimes:pdf|max:5120',
        ]);

        if ($validator->fails()) {
            toastr()->error('File harus PDF dan Maks 5MB');
            return back();
        }
        
        $SL = SatyaLencana::find($id);
        
        $sk_cpns = $request->sk_cpns == null ? $SL->sk_cpns : 'SKCPNS_'.$SL->pegawai->nip.'.pdf';
        $sk_pns  = $request->sk_pns == null ? $SL->sk_pns : 'SKPNS_'.$SL->pegawai->nip.'.pdf';
        $sk_jabatan = $request->sk_jabatan == null ? $SL->sk_jabatan : 'SKJABATAN_'.$SL->pegawai->nip.'.pdf';
        $skp1thn = $request->skp1thn == null ? $SL->skp1thn : 'SKP1THN_'.$SL->pegawai->nip.'.pdf';
        
        $SL->update([
            'sk_cpns' => $sk_cpns,
            'sk_pns' => $sk_pns,
            'sk_jabatan' => $sk_jabatan,
            'skp1thn' => $skp1thn,
        ]);

        if($request->hasFile('sk_cpns'))
        {
            $request->sk_cpns->storeAs('/public/'.$SL->pegawai->nip.'/satyalencana/'.$SL->id,$sk_cpns);
        }
        if($request->hasFile('sk_pns'))
        {
            $request->sk_pns->storeAs('/public/'.$SL->pegawai->nip.'/satyalencana/'.$SL->id,$sk_pns);
        }
        if($request->hasFile('sk_jabatan'))
        {
            $request->sk_jabatan->storeAs('/public/'.$SL->pegawai->nip.'/satyalencana/'.$SL->id,$sk_jabatan);
        }
        if($request->hasFile('skp1thn'))
        {
            $request->skp1thn->storeAs('/public/'.$SL->pegawai->nip.'/satyalencana/'.$SL->id,$skp1thn);
        }

        toastr()->success('Berhasil Di Upload');
        return redirect('/admin/satyalencana');
    }

    public function validasi_kirim($id)
    {
        SatyaLencana::find($id)->update([
            'validasi_skpd' => 1,
            'status' => null
        ]);
        toastr()->success('Berhasil Di Verfikasi Dan Di Kirim Ke BKD');
        return back();
    }

    public function p_index()
    {
        $data = SatyaLencana::where('status', null)->where('validasi_skpd', 1)->orderBy('created_at','DESC')->paginate(10);
        $tolak = SatyaLencana::where('status',2)->orderBy('created_at','DESC')->paginate(10);
        return view('pensiun.satyalencana.index',compact('data','tolak'));
    }

}
