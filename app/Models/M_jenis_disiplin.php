<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class M_jenis_disiplin extends Model
{
    use HasFactory;
    protected $table = 'm_jenis_disiplin';
    protected $guarded = ['id'];

    public $timestamps = false;

    public function kategori()
    {
        return $this->belongsTo(M_kategori_disiplin::class, 'm_kategori_disiplin_id');
    }
}
