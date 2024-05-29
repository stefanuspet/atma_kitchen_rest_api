<?php

namespace Database\Seeders;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\KonfirmasiPembayaran;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $this->call([
            JabatanSeeder::class,
            UserSeeder::class,
            KaryawanSeeder::class,
            JarakPengirimanSeeder::class,
            PesananSeeder::class,
            ProdukSeeder::class,
            CustomerSeeder::class,
            PoinSeeder::class,
        ]);
    }
}
