<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class M_eselon extends Model
{
    use HasFactory;
    protected $table = 'm_eselon';
    protected $guarded = ['id'];

    public $timestamps = false;
}
