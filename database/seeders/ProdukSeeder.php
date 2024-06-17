<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProdukSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('produks')->insert([
            "nama_produk" => 'Lapis Legit',
            "harga_satu_loyang" => 850000,
            "harga_setengah_loyang" => 450000,
            "stok_produk" => 0.5,
            "max_produksi" => 10,
            "image" => "kuelapis.jpeg",
            'id_user' => '1'
        ]);
        DB::table('produks')->insert([
            "nama_produk" => 'Lapis Surabaya',
            "harga_satu_loyang" => 550000,
            "harga_setengah_loyang" => 300000,
            "stok_produk" => 0.5,
            "max_produksi" => 20,
            "image" => "lapissurabaya.jpg",
            'id_user' => '1'
        ]);
        DB::table('produks')->insert([
            "nama_produk" => 'Brownies',
            "harga_satu_loyang" => 250000,
            "harga_setengah_loyang" => 150000,
            "stok_produk" => 0.5,
            "max_produksi" => 10,
            "image" => "brownies.jpg",
            'id_user' => '1'
        ]);
        DB::table('produks')->insert([
            "nama_produk" => 'Mandarin',
            "harga_satu_loyang" => 450000,
            "harga_setengah_loyang" => 250000,
            "stok_produk" => 0.5,
            "max_produksi" => 10,
            "image" => "mandarin.jpg",
            'id_user' => '1'
        ]);
        DB::table('produks')->insert([
            "nama_produk" => 'Spikoe',
            "harga_satu_loyang" => 350000,
            "harga_setengah_loyang" => 200000,
            "stok_produk" => 0.5,
            "max_produksi" => 10,
            "image" => "spikoe.jpg",
            'id_user' => '1'
        ]);
    }
}
