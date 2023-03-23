<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TmtPangkatSelesai extends Model 
{
    use HasFactory;

    protected $fillable = [
        'pegawai_id',
        'tmt_pangkat_lama',
        'tmt_pangkat_baru',
        'tanggal_diproses',
        'persyaratan',
    ];

    // protected $casts = ['persyaratan' => 'array'];

    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class);
    }
}
