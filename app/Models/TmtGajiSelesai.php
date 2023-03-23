<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TmtGajiSelesai extends Model
{
   use HasFactory;

   protected $fillable = [
     'pegawai_id',
     'tmt_gaji_lama',
     'tmt_gaji_baru',
     'tanggal_diproses',
     'persyaratan',
  ];

  // protected $casts = ['persyaratan' => 'array'];

  public function pegawai()
  {
     return $this->belongsTo(Pegawai::class);
  }
}
