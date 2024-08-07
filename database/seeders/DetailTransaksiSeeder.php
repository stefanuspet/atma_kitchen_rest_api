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
                "jumlah_produk" => 1,
                "id_produk_penitip" => null,
                "jumlah_produk_penitip" => null,
                "id_hampers" => null,
                "jumlah_hampers" => null,
            ],
            [
                "id_transaksi" => 2,
                "id_produk" => 2,
                "jumlah_produk" => 1,
                "id_produk_penitip" => null,
                "jumlah_produk_penitip" => null,
                "id_hampers" => null,
                "jumlah_hampers" => null,
            ],
            [
                "id_transaksi" => 3,
                "id_produk" => 3,
                "jumlah_produk" => 1,
                "id_produk_penitip" => null,
                "jumlah_produk_penitip" => null,
                "id_hampers" => null,
                "jumlah_hampers" => null,
            ],
            [
                "id_transaksi" => 4,
                "id_produk" => 4,
                "jumlah_produk" => 1,
                "id_produk_penitip" => null,
                "jumlah_produk_penitip" => null,
                "id_hampers" => null,
                "jumlah_hampers" => null,
            ],
            // buatkan data dummy untuk detail transaksi max id_transaksi 14 max idproduk 5
            [
                "id_transaksi" => 5,
                "id_produk" => 5,
                "jumlah_produk" => 1,
                "id_produk_penitip" => null,
                "jumlah_produk_penitip" => null,
                "id_hampers" => null,
                "jumlah_hampers" => null,
            ],
            [
                "id_transaksi" => 6,
                "id_produk" => 1,
                "jumlah_produk" => 1,
                "id_produk_penitip" => null,
                "jumlah_produk_penitip" => null,
                "id_hampers" => null,
                "jumlah_hampers" => null,
            ],
            [
                "id_transaksi" => 7,
                "id_produk" => 2,
                "jumlah_produk" => 1,
                "id_produk_penitip" => null,
                "jumlah_produk_penitip" => null,
                "id_hampers" => null,
                "jumlah_hampers" => null,
            ],
            [
                "id_transaksi" => 8,
                "id_produk" => 3,
                "jumlah_produk" => 1,
                "id_produk_penitip" => null,
                "jumlah_produk_penitip" => null,
                "id_hampers" => null,
                "jumlah_hampers" => null,
            ],
            [
                "id_transaksi" => 9,
                "id_produk" => 4,
                "jumlah_produk" => 1,
                "id_produk_penitip" => null,
                "jumlah_produk_penitip" => null,
                "id_hampers" => null,
                "jumlah_hampers" => null,
            ],
            [
                "id_transaksi" => 10,
                "id_produk" => 5,
                "jumlah_produk" => 1,
                "id_produk_penitip" => null,
                "jumlah_produk_penitip" => null,
                "id_hampers" => null,
                "jumlah_hampers" => null,
            ],
            [
                "id_transaksi" => 11,
                "id_produk" => 1,
                "jumlah_produk" => 1,
                "id_produk_penitip" => null,
                "jumlah_produk_penitip" => null,
                "id_hampers" => null,
                "jumlah_hampers" => null,
            ],
            [
                "id_transaksi" => 12,
                "id_produk" => 2,
                "jumlah_produk" => 2,
                "id_produk_penitip" => null,
                "jumlah_produk_penitip" => null,
                "id_hampers" => null,
                "jumlah_hampers" => null,
            ],
            [
                "id_transaksi" => 13,
                "id_produk" => 3,
                "jumlah_produk" => 3,
                "id_produk_penitip" => null,
                "jumlah_produk_penitip" => null,
                "id_hampers" => null,
                "jumlah_hampers" => null,
            ],
            [
                "id_transaksi" => 14,
                "id_produk" => 4,
                "jumlah_produk" => 2,
                "id_produk_penitip" => null,
                "jumlah_produk_penitip" => null,
                "id_hampers" => null,
                "jumlah_hampers" => null,
            ],
            // buatkan lagi dikarenakan 1 transaksi bisa lebih dari 1 produk
            [
                "id_transaksi" => 5,
                "id_produk" => 1,
                "jumlah_produk" => 1,
                "id_produk_penitip" => null,
                "jumlah_produk_penitip" => null,
                "id_hampers" => null,
                "jumlah_hampers" => null,
            ],
            [
                "id_transaksi" => 6,
                "id_produk" => 2,
                "jumlah_produk" => 1,
                "id_produk_penitip" => null,
                "jumlah_produk_penitip" => null,
                "id_hampers" => null,
                "jumlah_hampers" => null,
            ],
            [
                "id_transaksi" => 7,
                "id_produk" => 3,
                "jumlah_produk" => 3,
                "id_produk_penitip" => null,
                "jumlah_produk_penitip" => null,
                "id_hampers" => null,
                "jumlah_hampers" => null,
            ],
            [
                "id_transaksi" => 8,
                "id_produk" => 4,
                "jumlah_produk" => 2,
                "id_produk_penitip" => null,
                "jumlah_produk_penitip" => null,
                "id_hampers" => null,
                "jumlah_hampers" => null,
            ],
            [
                "id_transaksi" => 9,
                "id_produk" => 5,
                "jumlah_produk" => 1,
                "id_produk_penitip" => null,
                "jumlah_produk_penitip" => null,
                "id_hampers" => null,
                "jumlah_hampers" => null,
            ],
            [
                "id_transaksi" => 10,
                "id_produk" => 1,
                "jumlah_produk" => 1,
                "id_produk_penitip" => null,
                "jumlah_produk_penitip" => null,
                "id_hampers" => null,
                "jumlah_hampers" => null,
            ],
            [
                "id_transaksi" => 11,
                "id_produk" => 2,
                "jumlah_produk" => 2,
                "id_produk_penitip" => null,
                "jumlah_produk_penitip" => null,
                "id_hampers" => null,
                "jumlah_hampers" => null,
            ],
            [
                "id_transaksi" => 12,
                "id_produk" => 3,
                "jumlah_produk" => 3,
                "id_produk_penitip" => null,
                "jumlah_produk_penitip" => null,
                "id_hampers" => null,
                "jumlah_hampers" => null,
            ],
            [
                "id_transaksi" => 13,
                "id_produk" => 4,
                "jumlah_produk" => 2,
                "id_produk_penitip" => null,
                "jumlah_produk_penitip" => null,
                "id_hampers" => null,
                "jumlah_hampers" => null,
            ],
            [
                "id_transaksi" => 14,
                "id_produk" => 5,
                "jumlah_produk" => 1,
                "id_produk_penitip" => null,
                "jumlah_produk_penitip" => null,
                "id_hampers" => null,
                "jumlah_hampers" => null,
            ],
        ]);
    }
}
