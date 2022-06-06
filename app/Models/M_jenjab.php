<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class M_jenjab extends Model
{
    use HasFactory;
    protected $table = 'm_jenjab';
    protected $guarded = ['id'];

    public $timestamps = false;

    public function minpangkat()
    {
        return $this->belongsTo(M_pangkat::class, 'min_pangkat_id');
    }

    public function maxpangkat()
    {
        return $this->belongsTo(M_pangkat::class, 'max_pangkat_id');
    }
}
