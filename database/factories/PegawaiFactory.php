<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Carbon\Carbon;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Pegawai>
 */
class PegawaiFactory extends Factory
{
    /** 
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $last = Carbon::today()->endOfDay()->startOfMonth();

        return [
            'nama' => $this->faker->name(),
            'tanggal_lahir' => $this->faker->date(),
            'nip' => $this->faker->nik(),
            'eselon' => $this->faker->randomElement([
                'II A',
                'II B',
                'III A',
                'III B',
                'Non Eselon',
            ]),
            'golongan' => $this->faker->randomElement([
                'Pembina TK I',
                'Pembina',
                'Penata TK I',
                'Penata',
                'Penata Muda TK 1',
                'Penata Muda',
                'Pengatur TK 1',
            ]),
            'jabatan' => 'Pegawai',
            'tmt_capeg' => $this->faker->date(),
            'pendidikan_capeg' => $this->faker->randomElement(['SD','SMP','SMA','S1','S2']),
            'pendidikan_terakhir' => $this->faker->randomElement(['SD','SMP','SMA','S1','S2']),
            'tmt_capeg' => $this->faker->dateTimeBetween(),
            'tmt_gaji_berkala' => Carbon::parse($this->faker->dateTimeBetween(Carbon::today()->subYears(2), $last))->startOfMonth(),
            'tmt_p_terakhir' => Carbon::parse($this->faker->dateTimeBetween(Carbon::today()->subYears(4), $last))->startOfMonth(),
            'tmt_pensiun' => Carbon::parse($this->faker->dateTimeBetween(Carbon::today()->startOfMonth()->subYears(2), $last->addYears(20)))->startOfMonth()
        ];
    }
}
