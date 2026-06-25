<?php

namespace Database\Seeders;

use App\Models\Kamar;
use App\Models\Penghuni;
use App\Models\Tagihan;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(UserSeeder::class);
        $users = User::factory(1)->create();
        $kamarUntukUser = Kamar::factory(1)->create(['status' => 'Kosong']);
        foreach ($users as $index => $user) {
            $kamar = $kamarUntukUser[$index];
            $penghuni = Penghuni::factory()->create([
                'user_id' => $user->id,
                'kamar_id' => $kamar->id,
            ]);
            $kamar->update(['status' => 'Terisi']);
            Tagihan::factory()->create([
                'penghuni_id' => $penghuni->id,
                'jumlah_tagihan' => $kamar->harga_bulanan,
                'status' => 'Belum Lunas',
            ]);
        }

        Kamar::factory(9)->create(['status' => 'Kosong']);
    }
}
