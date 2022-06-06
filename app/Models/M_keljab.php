<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class M_keljab extends Model
{
    use HasFactory;
    protected $table = 'm_keljab';
    protected $guarded = ['id'];

    public $timestamps = false;
}
