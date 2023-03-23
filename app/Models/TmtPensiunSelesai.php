<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TmtPensiunSelesai extends Model
{
    use HasFactory;

    protected $fillable = [
        'pegawai_id',
        'tmt_pensiun_lama',
        'tanggal_diproses',
        'persyaratan',
    ];

    // protected $casts = ['persyaratan' => 'array'];

    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class);
    }
}
