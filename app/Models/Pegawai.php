<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// use Laravel\Scout\Searchable;

class Pegawai extends Model
{
    use HasFactory ;
    // use Searchable;

    protected $fillable = [
        'nama',
        'tanggal_lahir',
        'nip',
        'eselon',
        'golongan',
        'jabatan',
        'tmt_capeg',
        'pendidikan_capeg',
        'pendidikan_terakhir',
        'tmt_p_terakhir',
        'tmt_gaji_berkala',
        'tmt_pensiun',
        'status'
    ];

    public function tmt_gaji_selesai()
    {
        return $this->hasMany(TmtGajiSelesai::class);
    }

    public function tmt_pangkat_selesai()
    {
        return $this->hasMany(TmtPangkatSelesai::class);
    }

    public function tmt_pensiun_selesai()
    {
        return $this->hasOne(TmtPensiunSelesai::class);
    }

    public function persyaratan()
    {
        return $this->hasOne(Persyaratan::class);
    }

    public static function boot()
    {
        parent::boot();
        self::deleting(function ($pegawai) {
            $pegawai->tmt_gaji_selesai()->each(function ($tmt_gaji_selesai) {
                $tmt_gaji_selesai->delete();
            });

            $pegawai->tmt_pangkat_selesai()->each(function ($tmt_pangkat_selesai) {
                $tmt_pangkat_selesai->delete();
            });

            $pegawai->tmt_pensiun_selesai()->each(function ($tmt_pensiun_selesai) {
                $tmt_pensiun_selesai->delete();
            });

            $pegawai->persyaratan()->each(function ($persyaratan) {
                $persyaratan->delete();
            });
        });
    }

    // public function toSearchableArray()
    // {
    //     return [
    //         'nama' => $this->name,
    //         'tanggal_lahir' => $this->tanggal_lahir,
    //         'nip' => $this->nip,
    //         'golongan' => $this->golongan,
    //         'tmt_capeg' => $this->tmt_capeg,
    //         'pendidikan_capeg' => $this->pendidikan_capeg,
    //         'pendidikan_terakhir' => $this->pendidikan_terakhir,
    //         'tmt_p_terakhir' => $this->tmt_p_terakhir,
    //         'tmt_gaji_berkala' => $this->tmt_gaji_berkala,
    //         'tmt_pensiun'=> $this->tmt_pensiun
    //     ];
    // }
}
