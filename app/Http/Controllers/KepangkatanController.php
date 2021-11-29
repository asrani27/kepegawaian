<?php

namespace App\Http\Controllers;

use ZipArchive;
use File;
use App\Models\Pegawai;
use App\Models\Kepangkatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Madnest\Madzipper\Facades\Madzipper;
use Illuminate\Support\Facades\Validator;

class KepangkatanController extends Controller
{
    public function user()
    {
        return Auth::user();
    }

    public function index()
    {
        $data = Kepangkatan::where('skpd_id', $this->user()->skpd->id)->orderBy('created_at','DESC')->paginate(10);
        
        return view('skpd.kepangkatan.index',compact('data'));
    }
    
    public function k_index()
    {   
        $data = Kepangkatan::where('status', 1)->orderBy('created_at','DESC')->paginate(10);
        $ditolak = Kepangkatan::where('status',2)->orderBy('created_at','DESC')->paginate(10);
        return view('kepangkatan.pangkat.index',compact('data','ditolak'));
    }
    
    public function k_dokumen($id)
    {
        $pangkat =  Kepangkatan::find($id);
        $pegawai = $pangkat->pegawai;
        return view('kepangkatan.pangkat.detail',compact('pangkat','pegawai'));
    }
    
    public function create()
    {
        $pegawai = Pegawai::where('skpd_id',$this->user()->skpd->id)->get();
        return view('skpd.kepangkatan.create',compact('pegawai'));
    }
    
    public function store(Request $req)
    {
        $attr = $req->all();
        $attr['skpd_id'] = $this->user()->skpd->id;
        
        Kepangkatan::create($attr);
        toastr()->success('Berhasil Di Simpan');
        return redirect('/admin/kepangkatan');
    }

    public function detail($id)
    {
        $pangkat = Kepangkatan::find($id);
        $pegawai = $pangkat->pegawai;
        return view('skpd.kepangkatan.detail',compact('pegawai','id','pangkat'));
    }

    public function uploadSyarat(Request $req, $id)
    {
        $validator = Validator::make($req->all(), [
            'file'  => 'mimes:pdf|max:2058',
        ]);

        if ($validator->fails()) {
            toastr()->error('File harus PDF dan Maks 2MB');
            return back();
        }
        
        $pangkat = Kepangkatan::find($id);

        $filename = $req->penamaan.'_'.$pangkat->pegawai->nip.'.pdf';
        
        if($req->hasFile('file'))
        {
            $req->file->storeAs('/public/'.$pangkat->pegawai->nip.'/pangkat/'.$req->jenis.'/'.$pangkat->id,$filename);
        }

        $pangkat->update([
            $req->field => $filename,
        ]);
        toastr()->success('Berhasil Di Simpan');
        return back();
    }

    public function validasi_kirim($id)
    {
        Kepangkatan::find($id)->update(['status' =>1]);
        toastr()->success('Berhasil Di Kirim ke BKD');
        return  redirect('/admin/kepangkatan');
    }

    public function k_tolak(Request $req)
    {
        Kepangkatan::find($req->pangkat_id)->update([
            'status' => 2, 
            'keterangan' => $req->keterangan_tolak,
        ]);

        toastr()->success('Berhasil Dikembalikan ke SKPD terkait');
        return back();
    }
    
    // public function downloadZip($id)
    // {
    //     $pangkat = Kepangkatan::find($id);
    //     $pegawai = $pangkat->pegawai;
    //     $files = glob('storage/'. $pegawai->nip.'/pangkat/*');
    //     Madzipper::make('storage/'. $pegawai->nip.'/download.zip')->add($files)->close();

    //     $name = $pegawai->nip;
    //     return Storage::download('/public/'. $pegawai->nip.'/download.zip', $name);

    //     toastr()->success('Berhasil Di Download');
    //     return back();
    // }

    public function downloadZip($id)
    {
        $zip = new ZipArchive;
            $pangkat = Kepangkatan::find($id);
            $pegawai = $pangkat->pegawai;
        $fileName = 'myNewFile.zip';
        if ($zip->open(public_path($fileName), ZipArchive::CREATE) === TRUE)
        {
            $files = File::files(public_path('storage/'. $pegawai->nip.'/pangkat'));
            // foreach ($files as $key => $value) {
            //     $relativeNameInZipFile = basename($value);
            //     $zip->addFile($value, $relativeNameInZipFile);
            // }
            // $zip->close();
        }
        return response()->download(public_path($fileName));
    }
}
