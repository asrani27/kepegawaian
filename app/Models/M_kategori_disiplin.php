<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class M_kategori_disiplin extends Model
{
    use HasFactory;
    protected $table = 'm_kategori_disiplin';
    protected $guarded = ['id'];

    public $timestamps = false;
}
