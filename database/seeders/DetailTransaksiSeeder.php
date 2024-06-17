<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DetailTransaksiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('detail_transaksis')->insert([
            [
                "id_transaksi" => 1,
                "id_produk" => 1,
                "id_produk_penitip" => null,
                "id_hampers" => null,
            ],
            [
                "id_transaksi" => 2,
                "id_produk" => 2,
                "id_produk_penitip" => null,
                "id_hampers" => null,
            ],
            [
                "id_transaksi" => 3,
                "id_produk" => 3,
                "id_produk_penitip" => null,
                "id_hampers" => null,
            ],
            [
                "id_transaksi" => 4,
                "id_produk" => 4,
                "id_produk_penitip" => null,
                "id_hampers" => null,
            ],
        ]);
    }
}
