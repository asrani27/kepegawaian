<?php

use App\Models\Upload;
use App\Models\Berkala;
use App\Models\Layanan;
use App\Models\M_jenis_kenaikan_pangkat;
use App\Models\Persyaratan;

function listUpload($pegawai_id, $persyaratan_id)
{
    return Upload::where('pegawai_id', $pegawai_id)->where('persyaratan_id', $persyaratan_id)->get();
}
function sortValue($golongan)
{
    $parts = explode('/', $golongan);
    $angka = $parts[0] ?? '';
    $huruf = strtolower($parts[1] ?? 'a'); // default a

    $roman = [
        'I' => 1,
        'II' => 2,
        'III' => 3,
        'IV' => 4,
        'V' => 5,
    ];

    $hurufOrder = [
        'a' => 1,
        'b' => 2,
        'c' => 3,
        'd' => 4,
        'e' => 5,
    ];

    return ($roman[$angka] ?? 0) * 10 + ($hurufOrder[$huruf] ?? 0);
}
function listSyarat($persyaratan_id)
{
    $id = json_decode($persyaratan_id);
    return Upload::whereIn('id', $id)->get();
}
function jenis_kepangkatan()
{
    return M_jenis_kenaikan_pangkat::get();
}
function layanan($param)
{
    return Layanan::where('jenis', $param)->get();
}
function dokumen($layanan_id, $jenis)
{
    return Persyaratan::where('layanan_id', $layanan_id)->where('jenis', $jenis)->get();
}
function checkFile($pengajuan_id, $pegawai_id, $persyaratan_id)
{
    return Upload::where('pengajuan_id', $pengajuan_id)->where('pegawai_id', $pegawai_id)->where('persyaratan_id', $persyaratan_id)->first();
}
function persyaratan($param)
{
    return Persyaratan::where('jenis', $param)->get();
}

function berkalaBaru()
{
    return count(Berkala::where('validasi_skpd', 1)->where('sk_ttd', null)->get());
}

function roleUser($param)
{
    if ($param->hasRole('superadmin')) {
        $location = '/superadmin/home';
    } elseif ($param->hasRole('admin')) {
        $location = '/admin/home';
    } elseif ($param->hasRole('kepangkatan')) {
        $location = '/kepangkatan/home';
    } elseif ($param->hasRole('pensiun')) {
        $location = '/pensiun/home';
    } elseif ($param->hasRole('karpeg')) {
        $location = '/karpeg/home';
    } elseif ($param->hasRole('disiplin')) {
        $location = '/disiplin/home';
    } elseif ($param->hasRole('kepegawaian')) {
        $location = '/kepegawaian/home';
    } elseif ($param->hasRole('slks')) {
        $location = '/slks/home';
    } else {
        $location = '/pegawai/home';
    }
    return $location;
}

function menuUser($param)
{
    if ($param->hasRole('superadmin')) {
        $location = 'menu_superadmin';
    } elseif ($param->hasRole('admin')) {
        $location = 'menu_admin';
    } elseif ($param->hasRole('kepangkatan')) {
        $location = 'menu_kepangkatan';
    } elseif ($param->hasRole('pensiun')) {
        $location = 'menu_pensiun';
    } elseif ($param->hasRole('karpeg')) {
        $location = 'menu_karpeg';
    } elseif ($param->hasRole('disiplin')) {
        $location = 'menu_disiplin';
    } elseif ($param->hasRole('kepegawaian')) {
        $location = 'menu_kepegawaian';
    } elseif ($param->hasRole('slks')) {
        $location = 'menu_slks';
    } else {
        $location = 'menu_pegawai';
    }
    return $location;
}

function konversi_nip($nip, $batas = " ")
{
    $nip = trim($nip, " ");
    $panjang = strlen($nip);

    if ($panjang == 18) {
        $sub[] = substr($nip, 0, 8); // tanggal lahir
        $sub[] = substr($nip, 8, 6); // tanggal pengangkatan
        $sub[] = substr($nip, 14, 1); // jenis kelamin
        $sub[] = substr($nip, 3, 3); // nomor urut

        return $sub[0] . $batas . $sub[1] . $batas . $sub[2] . $batas . $sub[3];
    } elseif ($panjang == 15) {
        $sub[] = substr($nip, 0, 8); // tanggal lahir
        $sub[] = substr($nip, 8, 6); // tanggal pengangkatan
        $sub[] = substr($nip, 14, 1); // jenis kelamin

        return $sub[0] . $batas . $sub[1] . $batas . $sub[2];
    } elseif ($panjang == 9) {
        $sub = str_split($nip, 3);

        return $sub[0] . $batas . $sub[1] . $batas . $sub[2];
    } else {
        return $nip;
    }
}
