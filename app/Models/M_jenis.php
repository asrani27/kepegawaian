<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class M_jenis extends Model
{
    use HasFactory;
    protected $table = 'm_jenis';
    protected $guarded = ['id'];

    public $timestamps = false;
}
