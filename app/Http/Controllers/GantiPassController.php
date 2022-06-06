<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class GantiPassController extends Controller
{
    public function admin()
    {
        return view('skpd.gantipass.index');
    }

    public function resetadmin(Request $req)
    {
        if ($req->password1 == $req->password2) {
            $u = Auth::user();
            $u->password = bcrypt($req->password1);
            $u->save();

            Auth::logout();
            toastr()->success('Berhasil Di Ubah, Login Dengan Password Baru');
            return redirect('/');
        } else {
            toastr()->error('Password Tidak Sama');
            return back();
        }
    }
    public function kepangkatan()
    {
        return view('kepangkatan.gantipass.index');
    }

    public function resetKepangkatan(Request $req)
    {
        if ($req->password1 == $req->password2) {
            $u = Auth::user();
            $u->password = bcrypt($req->password1);
            $u->save();

            Auth::logout();
            toastr()->success('Berhasil Di Ubah, Login Dengan Password Baru');
            return redirect('/');
        } else {
            toastr()->error('Password Tidak Sama');
            return back();
        }
    }
    public function pensiun()
    {
        return view('pensiun.gantipass.index');
    }

    public function resetPensiun(Request $req)
    {
        if ($req->password1 == $req->password2) {
            $u = Auth::user();
            $u->password = bcrypt($req->password1);
            $u->save();

            Auth::logout();
            toastr()->success('Berhasil Di Ubah, Login Dengan Password Baru');
            return redirect('/');
        } else {
            toastr()->error('Password Tidak Sama');
            return back();
        }
    }

    public function karpeg()
    {
        return view('karpeg.gantipass.index');
    }

    public function resetKarpeg(Request $req)
    {
        if ($req->password1 == $req->password2) {
            $u = Auth::user();
            $u->password = bcrypt($req->password1);
            $u->save();

            Auth::logout();
            toastr()->success('Berhasil Di Ubah, Login Dengan Password Baru');
            return redirect('/');
        } else {
            toastr()->error('Password Tidak Sama');
            return back();
        }
    }


    public function kepegawaian()
    {
        return view('kepegawaian.gantipass.index');
    }

    public function resetKepegawaian(Request $req)
    {
        if (!Hash::check($req->password_lama, Auth::user()->password)) {
            toastr()->error('Password Lama Tidak Sama');
            return back();
        }
        if ($req->password1 != $req->password2) {
            toastr()->error('Password Baru Tidak Sesuai');
            return back();
        } else {

            $validator = Validator::make($req->all(), [
                'password' => 'required|min:8|regex:/[0-9]/|regex:/[a-z]/',
            ]);

            if ($validator->fails()) {
                toastr()->error('Password min 8 karakter serta kombinasi angka dan huruf');
                return back();
            }

            Auth::user()->update([
                'password' => bcrypt($req->password)
            ]);

            Auth::logout();
            toastr()->success('Berhasil Di Update, Login Dengan Password Baru');
            return redirect('/');
        }
    }

    public function disiplin()
    {
        return view('disiplin.gantipass.index');
    }

    public function resetDisiplin(Request $req)
    {
        if (!Hash::check($req->password_lama, Auth::user()->password)) {
            toastr()->error('Password Lama Tidak Sama');
            return back();
        }
        if ($req->password1 != $req->password2) {
            toastr()->error('Password Baru Tidak Sesuai');
            return back();
        } else {

            $validator = Validator::make($req->all(), [
                'password' => 'required|min:8|regex:/[0-9]/|regex:/[a-z]/',
            ]);

            if ($validator->fails()) {
                toastr()->error('Password min 8 karakter serta kombinasi angka dan huruf');
                return back();
            }

            Auth::user()->update([
                'password' => bcrypt($req->password)
            ]);

            Auth::logout();
            toastr()->success('Berhasil Di Update, Login Dengan Password Baru');
            return redirect('/');
        }
    }
}
