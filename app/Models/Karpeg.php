<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Karpeg extends Model
{
    use HasFactory;
    protected $table = 'karpeg';
    protected $guarded = ['id'];
    
    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class, 'pegawai_id');
    }
}
