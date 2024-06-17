<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HampersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('hampers')->insert([
            "nama_hampers" => "Paket A",
            "harga_hampers" => 650000,
            "deskripsi_hampers" => "Lapis Legit ½ Loyang + Brownies ½ Loyang + exclusive box and card",
            "tanggal_pembuatan_hampers" => "2024-04-01",
            "stok_hampers" => 10,
            "id_user" => 1,
        ]);

        DB::table('hampers')->insert([
            "nama_hampers" => "Paket B",
            "harga_hampers" => 500000,
            "deskripsi_hampers" => "Lapis Surabaya ½ Loyang + Roti Sosis + exclusive box and card",
            "tanggal_pembuatan_hampers" => "2024-04-01",
            "stok_hampers" => 10,
            "id_user" => 1,
        ]);

        DB::table('hampers')->insert([
            "nama_hampers" => "Paket C",
            "harga_hampers" => 350000,
            "deskripsi_hampers" => "Spikoe ½ Loyang + Matcha Creamy Latte + exclusive box and card",
            "tanggal_pembuatan_hampers" => "2024-04-01",
            "stok_hampers" => 10,
            "id_user" => 1,
        ]);
    }
}
