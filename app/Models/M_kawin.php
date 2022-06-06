<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class M_kawin extends Model
{
    use HasFactory;
    protected $table = 'm_kawin';
    protected $guarded = ['id'];

    public $timestamps = false;
}
