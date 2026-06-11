<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Kamar;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Penghuni>
 */
class PenghuniFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id'        => null,
            'kamar_id'       => null,
            'nama_penghuni'  => $this->faker->name(),
            'no_ktp'         => $this->faker->numerify('################'),
            'no_telepon' => '08' . $this->faker->numerify('##########'), 
            'tanggal_masuk' => $this->faker->dateTimeBetween('2024-01-01', 'now')->format('Y-m-d'),
            'tanggal_keluar' => null, // atau faker date
        ];
    }
}
