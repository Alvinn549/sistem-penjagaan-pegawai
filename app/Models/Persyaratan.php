<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Persyaratan extends Model
{
    use HasFactory;

    protected $fillable = [
        'pegawai_id',
        'p_gaji_berkala',
        'p_pangkat',
        'p_pensiun'
    ];

    protected $casts = [
        'p_gaji_berkala' => 'array',
        'p_pangkat' => 'array',
        'p_pensiun' => 'array',
    ];

    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class);
    }
}
