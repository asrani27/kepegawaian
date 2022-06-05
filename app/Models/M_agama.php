<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class M_agama extends Model
{
    use HasFactory;
    protected $table = 'm_agama';
    protected $guarded = ['id'];

    public $timestamps = false;
}
