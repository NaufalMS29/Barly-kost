<?php

namespace Database\Factories;

use App\Models\Penghuni;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Tagihan>
 */
class TagihanFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $status = $this->faker->randomElement(['Belum Lunas', 'Lunas']);

        return [
            'penghuni_id' => Penghuni::factory(), // otomatis buat penghuni baru
            'jumlah_tagihan' => $this->faker->numberBetween(500000, 1000000),
            'status' => $status,
            'tanggal_lunas' =>
                $status === 'Lunas'
                    ? $this->faker->dateTimeBetween('-1 month', 'now')
                    : null,
        ];
    }
}
