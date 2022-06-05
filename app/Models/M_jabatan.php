<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class M_jabatan extends Model
{
    use HasFactory;
    protected $table = 'm_jabatan';
    protected $guarded = ['id'];

    public $timestamps = false;
}
