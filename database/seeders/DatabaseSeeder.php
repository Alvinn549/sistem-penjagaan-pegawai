<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Pegawai;
use App\Models\Persyaratan;
use App\Models\PersyaratanGaji;
use App\Models\PersyaratanPangkat;
use App\Models\PersyaratanPensiun;
use Carbon\Carbon;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'nama' => 'Admin Pertama',
            'username' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('password'),
            'level' => 'admin'
        ]);

        PersyaratanGaji::factory(5)->create();
        PersyaratanPangkat::factory(5)->create();
        PersyaratanPensiun::factory(5)->create();

        Pegawai::factory(50)->create()->each(function($pegawai) {
            Persyaratan::factory(1)->create([
                'pegawai_id' => $pegawai->id,
                // 'p_gaji_berkala' => PersyaratanGaji::pluck('nama')->toArray(),
                // 'p_pangkat' => PersyaratanPangkat::pluck('nama')->toArray(),
                // 'p_pensiun' => PersyaratanPensiun::pluck('nama')->toArray(),
            ]);
        });

    }
}

        