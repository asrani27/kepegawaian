<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class M_status_pegawai extends Model
{
    use HasFactory;
    protected $table = 'm_status_pegawai';
    protected $guarded = ['id'];

    public $timestamps = false;
}
