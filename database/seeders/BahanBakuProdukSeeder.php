<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BahanBakuProdukSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('bahan_baku_produks')->insert([
            [
                'id_produk' => 1,
                'id_bahan_baku' => 1,
                'jumlah_digunakan' => 500,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id_produk' => 1,
                'id_bahan_baku' => 2,
                'jumlah_digunakan' => 50,
                'created_at' => now(), 
                'updated_at' => now()
            ],
            [
                'id_produk' => 1,
                'id_bahan_baku' => 3,
                'jumlah_digunakan' => 50,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id_produk' => 2,
                'id_bahan_baku' => 1, 
                'jumlah_digunakan' => 500,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id_produk' => 2,
                'id_bahan_baku' => 2,
                'jumlah_digunakan' => 50,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id_produk' => 2,
                'id_bahan_baku' => 3,
                'jumlah_digunakan' => 40,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id_produk' => 2,
                'id_bahan_baku' => 4,
                'jumlah_digunakan' => 300,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id_produk' => 3,
                'id_bahan_baku' => 2,
                'jumlah_digunakan' => 150,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id_produk' => 3,
                'id_bahan_baku' => 4,
                'jumlah_digunakan' => 200,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id_produk' => 3,
                'id_bahan_baku' => 6,
                'jumlah_digunakan' => 50,
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
    }
}
