<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class M_insjab extends Model
{
    use HasFactory;
    protected $table = 'm_insjab';
    protected $guarded = ['id'];

    public $timestamps = false;
}
