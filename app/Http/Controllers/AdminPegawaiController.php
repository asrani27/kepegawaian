<?php

namespace App\Http\Controllers;

use App\Jobs\SyncBkd;
use GuzzleHttp\Client;
use App\Models\Pegawai;
use Illuminate\Http\Request;
use App\Jobs\SyncAdminPegawai;
use Illuminate\Support\Facades\Auth;

class AdminPegawaiController extends Controller
{
    public function index()
    {
        $data = Pegawai::where('skpd_id',Auth::user()->skpd->id)->paginate(10);
        return view('skpd.pegawai.index',compact('data'));
    }

    public function search()
    {
        $search = request()->get('search');
        $data   = Pegawai::where('skpd_id',Auth::user()->skpd->id)->where('nama', 'LIKE','%'.$search.'%')->orWhere('nip', 'LIKE','%'.$search.'%')->paginate(10);
        $data->appends(['search' => $search])->links();
        request()->flash();
        return view('skpd.pegawai.index',compact('data'));
    }

    public function sync()
    {
        $kode_skpd = Auth::user()->username;
        try{
            $client     = new Client(['base_uri' => 'https://tpp.banjarmasinkota.go.id/api/pegawai/skpd/']);
            $response   = $client->request('GET',$kode_skpd,['verify' => false ]);
            $resp       = json_decode($response->getBody())->data;
            foreach($resp as $data){
                SyncAdminPegawai::dispatch($data);  
            }
            toastr()->success('Pegawai Berhasil Sinkronisasi');
            return back();
        }
        catch(\Exception $e)
        {
            //dd($e);
        }
    }

    public function syncUnitKerja()
    {
        $data = Pegawai::where('skpd_id',Auth::user()->skpd->id)->pluck('nip');
        foreach($data as $item)
        {
            SyncBkd::dispatch($item);
        }
        toastr()->success('Unit Kerja Berhasil Sinkronisasi');
        return back();
    }
}
