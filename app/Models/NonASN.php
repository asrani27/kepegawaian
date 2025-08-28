<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NonASN extends Model
{
    use HasFactory;
    protected $table = 'pegawai_non_asn';
    protected $guarded = ['id'];
}
