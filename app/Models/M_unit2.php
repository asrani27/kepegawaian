<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class M_unit2 extends Model
{
    use HasFactory;
    protected $table = 'm_unit2';
    protected $guarded = ['id'];

    public $timestamps = false;
}
