<?php

use App\Models\Upload;
use App\Models\Berkala;

function listUpload($pegawai_id, $persyaratan_id)
{
    return Upload::where('pegawai_id', $pegawai_id)->where('persyaratan_id', $persyaratan_id)->get();
}

function listSyarat($persyaratan_id)
{
    $id = json_decode($persyaratan_id);
    return Upload::whereIn('id', $id)->get();
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
