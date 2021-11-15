<?php

use App\Models\Upload;

function listUpload($pegawai_id, $persyaratan_id)
{
    return Upload::where('pegawai_id', $pegawai_id)->where('persyaratan_id', $persyaratan_id)->get();
}

function listSyarat($persyaratan_id)
{
    $id = json_decode($persyaratan_id);
    return Upload::whereIn('id', $id)->get();
}

function konversi_nip($nip, $batas = " ") {
    $nip = trim($nip," ");
    $panjang = strlen($nip);
     
    if($panjang == 18) {
        $sub[] = substr($nip, 0, 8); // tanggal lahir
        $sub[] = substr($nip, 8, 6); // tanggal pengangkatan
        $sub[] = substr($nip, 14, 1); // jenis kelamin
        $sub[] = substr($nip, 3, 3); // nomor urut
         
        return $sub[0].$batas.$sub[1].$batas.$sub[2].$batas.$sub[3];
    } elseif($panjang == 15) {
        $sub[] = substr($nip, 0, 8); // tanggal lahir
        $sub[] = substr($nip, 8, 6); // tanggal pengangkatan
        $sub[] = substr($nip, 14, 1); // jenis kelamin
         
        return $sub[0].$batas.$sub[1].$batas.$sub[2];
    } elseif($panjang == 9) {
        $sub = str_split($nip,3);
         
        return $sub[0].$batas.$sub[1].$batas.$sub[2];
    } else {
        return $nip;
    }
}