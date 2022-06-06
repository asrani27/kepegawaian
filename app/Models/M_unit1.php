<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class M_unit1 extends Model
{
    use HasFactory;
    protected $table = 'm_unit1';
    protected $guarded = ['id'];

    public $timestamps = false;
}
