<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class M_latjab extends Model
{
    use HasFactory;
    protected $table = 'm_latjab';
    protected $guarded = ['id'];

    public $timestamps = false;
}
