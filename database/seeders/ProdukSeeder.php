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
            "nama_produk" => 'Lapis Legit 1 loyang',
            "harga" => 850000,
            "stok_produk" => 0.5,
            "max_produksi" => 10,
            "image" => "kuelapis.jpeg",
            'id_user' => '1'
        ]);
        DB::table('produks')->insert([
            "nama_produk" => 'Lapis Legit ½ loyang',
            "harga" => 450000,
            "stok_produk" => 0.5,
            "max_produksi" => 10,
            "image" => "kuelapis.jpeg",
            'id_user' => '1'
        ]);
        DB::table('produks')->insert([
            "nama_produk" => 'Lapis Surabaya 1 loyang',
            "harga" => 550000,
            "stok_produk" => 0.5,
            "max_produksi" => 20,
            "image" => "lapissurabaya.jpg",
            'id_user' => '1'
        ]);
        DB::table('produks')->insert([
            "nama_produk" => 'Lapis Surabaya ½ loyang',
            "harga" => 300000,
            "stok_produk" => 0.5,
            "max_produksi" => 20,
            "image" => "lapissurabaya.jpg",
            'id_user' => '1'
        ]);
        DB::table('produks')->insert([
            "nama_produk" => 'Brownies 1 loyang',
            "harga" => 250000,
            "stok_produk" => 0.5,
            "max_produksi" => 10,
            "image" => "brownies.jpg",
            'id_user' => '1'
        ]);
        DB::table('produks')->insert([
            "nama_produk" => 'Brownies ½ loyang',
            "harga" => 150000,
            "stok_produk" => 0.5,
            "max_produksi" => 10,
            "image" => "brownies.jpg",
            'id_user' => '1'
        ]);
        DB::table('produks')->insert([
            "nama_produk" => 'Mandarin 1 loyang',
            "harga" => 450000,
            "stok_produk" => 0.5,
            "max_produksi" => 10,
            "image" => "mandarin.jpg",
            'id_user' => '1'
        ]);
        DB::table('produks')->insert([
            "nama_produk" => 'Mandarin ½ loyang',
            "harga" => 250000,
            "stok_produk" => 0.5,
            "max_produksi" => 10,
            "image" => "mandarin.jpg",
            'id_user' => '1'
        ]);
        DB::table('produks')->insert([
            "nama_produk" => 'Spikoe 1 loyang',
            "harga" => 350000,
            "stok_produk" => 0.5,
            "max_produksi" => 10,
            "image" => "spikoe.jpg",
            'id_user' => '1'
        ]);
        DB::table('produks')->insert([
            "nama_produk" => 'Spikoe ½ loyang',
            "harga" => 200000,
            "stok_produk" => 0.5,
            "max_produksi" => 10,
            "image" => "spikoe.jpg",
            'id_user' => '1'
        ]);
    }
}
