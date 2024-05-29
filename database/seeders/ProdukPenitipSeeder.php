<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProdukPenitipSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('produk_penitips')->insert([
            "nama_produk_penitip" => "Keripik Kentang 250 gr ",
            "harga_produk_penitip" => 75000,
            "stok_produk_penitip" => 100,
            "gambar_produk_penitip" => "keripik_kentang.png",
            "id_penitip" => 1,
            "id_user" => 1,
        ]);
        DB::table('produk_penitips')->insert([
            "nama_produk_penitip" => "Kopi Luwak Bubuk 250 gr",
            "harga_produk_penitip" => 250000,
            "stok_produk_penitip" => 100,
            "gambar_produk_penitip" => "kopiluak.png",
            "id_penitip" => 2,
            "id_user" => 1,
        ]);
        DB::table('produk_penitips')->insert([
            "nama_produk_penitip" => "Matcha Organik Bubuk 100 gr",
            "harga_produk_penitip" => 300000,
            "stok_produk_penitip" => 100,
            "gambar_produk_penitip" => "matchabubuk.png",
            "id_penitip" => 2,
            "id_user" => 1,
        ]);
        DB::table('produk_penitips')->insert([
            "nama_produk_penitip" => "Chocolate Bar 100 gr",
            "harga_produk_penitip" => 120000,
            "stok_produk_penitip" => 100,
            "gambar_produk_penitip" => "cocolatebar.png",
            "id_penitip" => 2,
            "id_user" => 1,
        ]);
    }
}
