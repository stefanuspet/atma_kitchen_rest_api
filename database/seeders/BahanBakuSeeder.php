<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BahanBakuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table("bahan_bakus")->insert([
            [
                'nama_bahan_baku' => "butter",
                'jumlah_tersedia' => 2000,
                'satuan_bahan' => "gram",
                'harga_satuan' => 123,
                "id_user" => 1,
            ],
            [
                'nama_bahan_baku' => "creamer",
                'jumlah_tersedia' => 3000,
                'satuan_bahan' => "gram",
                'harga_satuan' => 123,
                "id_user" => 1,
            ],
            [
                'nama_bahan_baku' => "telur",
                'jumlah_tersedia' => 300,
                'satuan_bahan' => "butir",
                'harga_satuan' => 123,
                "id_user" => 1,
            ],
            [
                'nama_bahan_baku' => "gula pasir",
                'jumlah_tersedia' => 300,
                'satuan_bahan' => "gram",
                'harga_satuan' => 123,
                "id_user" => 1,
            ],
            [
                'nama_bahan_baku' => "susu bubuk",
                'jumlah_tersedia' => 300,
                'satuan_bahan' => "gram",
                'harga_satuan' => 123,
                "id_user" => 1,
            ],
            [
                'nama_bahan_baku' => "tepung terigu",
                'jumlah_tersedia' => 300,
                'satuan_bahan' => "gram",
                'harga_satuan' => 123,
                "id_user" => 1,
            ],
            [
                'nama_bahan_baku' => "garam",
                'jumlah_tersedia' => 300,
                'satuan_bahan' => "gram",
                'harga_satuan' => 123,
                "id_user" => 1,
            ],
            [
                'nama_bahan_baku' => "coklat bubuk",
                'jumlah_tersedia' => 300,
                'satuan_bahan' => "gram",
                'harga_satuan' => 123,
                "id_user" => 1,
            ],
            [
                'nama_bahan_baku' => "selai strawberry",
                'jumlah_tersedia' => 300,
                'satuan_bahan' => "gram",
                'harga_satuan' => 123,
                "id_user" => 1,
            ],
            [
                'nama_bahan_baku' => "coklat batang",
                'jumlah_tersedia' => 250,
                'satuan_bahan' => "gram",
                'harga_satuan' => 123,
                "id_user" => 1,
            ],
            [
                'nama_bahan_baku' => "minyak goreng ",
                'jumlah_tersedia' => 250,
                'satuan_bahan' => "ml",
                'harga_satuan' => 123,
                "id_user" => 1,
            ],
            [
                'nama_bahan_baku' => "tepung Maizena",
                'jumlah_tersedia' => 250,
                'satuan_bahan' => "gram",
                'harga_satuan' => 123,
                "id_user" => 1,
            ],
            [
                'nama_bahan_baku' => "Baking Powder",
                'jumlah_tersedia' => 250,
                'satuan_bahan' => "gram",
                'harga_satuan' => 123,
                "id_user" => 1,
            ],
            [
                'nama_bahan_baku' => "Kacang Kenari",
                'jumlah_tersedia' => 250,
                'satuan_bahan' => "gram",
                'harga_satuan' => 123,
                "id_user" => 1,
            ],
            [
                'nama_bahan_baku' => "ragi",
                'jumlah_tersedia' => 250,
                'satuan_bahan' => "gram",
                'harga_satuan' => 123,
                "id_user" => 1,
            ],
            [
                'nama_bahan_baku' => "kuning telur",
                'jumlah_tersedia' => 20,
                'satuan_bahan' => "buah",
                'harga_satuan' => 123,
                "id_user" => 1,
            ],
            [
                'nama_bahan_baku' => "susu cair",
                'jumlah_tersedia' => 300,
                'satuan_bahan' => "ml",
                'harga_satuan' => 123,
                "id_user" => 1,
            ],
            [
                'nama_bahan_baku' => "sosis blackpapper",
                'jumlah_tersedia' => 100,
                'satuan_bahan' => "buah",
                'harga_satuan' => 123,
                "id_user" => 1,
            ],
            [
                'nama_bahan_baku' => "whipped cream",
                'jumlah_tersedia' => 400,
                'satuan_bahan' => "ml",
                'harga_satuan' => 123,
                "id_user" => 1,
            ],
            [
                'nama_bahan_baku' => "susu full cream",
                'jumlah_tersedia' => 400,
                'satuan_bahan' => "ml",
                'harga_satuan' => 123,
                "id_user" => 1,
            ],
            [
                'nama_bahan_baku' => "keju mozzarella",
                'jumlah_tersedia' => 400,
                'satuan_bahan' => "gram",
                'harga_satuan' => 123,
                "id_user" => 1,
            ],
            [
                'nama_bahan_baku' => "matcha bubuk",
                'jumlah_tersedia' => 400,
                'satuan_bahan' => "gram",
                'harga_satuan' => 123,
                "id_user" => 1,
            ],
        ]);
    }
}
