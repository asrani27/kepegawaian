<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class M_goldarah extends Model
{
    use HasFactory;
    protected $table = 'm_goldarah';
    protected $guarded = ['id'];

    public $timestamps = false;
}
