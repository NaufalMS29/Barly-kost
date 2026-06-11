<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Kamar>
 */
class KamarFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $tipe = fake()->randomElement(['AC', 'Non-AC']);
        $harga = $tipe == 'AC' ? 850000 : 650000;
        return [
            'nama_kamar'    => 'Kamar ' . fake()->unique()->numberBetween(1, 50),
            'tipe'          => $tipe,
            'foto_kamar'    => 'default-kamar.jpg',
            'lantai'        => fake()->numberBetween(1, 3),
            'harga_bulanan' => $harga,
            'listrik'       => fake()->randomElement(['Token', 'Include']),
            'status'        => fake()->randomElement(['Kosong', 'Terisi', 'Perbaikan']),
        ];
    }
}
