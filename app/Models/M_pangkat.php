<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class M_pangkat extends Model
{
    use HasFactory;
    protected $table = 'm_pangkat';
    protected $guarded = ['id'];

    public $timestamps = false;
}
