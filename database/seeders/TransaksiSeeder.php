<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TransaksiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('transaksis')->insert([
            [
                "tanggal_transaksi" => '2020-12-21 00:00:00',
                "tanggal_ambil" => '2020-12-21 00:00:00',
                "metode_pembayaran" => 'Transfer',
                "status_pembayaran" => 'lunas',
                "status_pengiriman" => 'sudah dikirim',
                "jenis_pengiriman" => 'Kurir',
                "potongan_poin" => 50,
                "poin_pesanan" => 250,
                "harga_pengurangan_poin" => 25000,
                "harga_total" => 120000,
                "id_customer" => 1,
            ],
            [
                "tanggal_transaksi" => '2020-12-22 00:00:00',
                "tanggal_ambil" => '2020-12-23 00:00:00',
                "metode_pembayaran" => 'Bank Transfer',
                "status_pembayaran" => 'belum lunas',
                "status_pengiriman" => 'belum dikirim',
                "jenis_pengiriman" => 'Ojol',
                "potongan_poin" => 30,
                "poin_pesanan" => 150,
                "harga_pengurangan_poin" => 15000,
                "harga_total" => 80000,
                "id_customer" => 2,
            ],
            [
                "tanggal_transaksi" => '2020-12-23 00:00:00',
                "tanggal_ambil" => '2020-12-24 00:00:00',
                "metode_pembayaran" => 'Cash',
                "status_pembayaran" => 'lunas',
                "status_pengiriman" => 'belum dikirim',
                "jenis_pengiriman" => 'Pickup',
                "potongan_poin" => 100,
                "poin_pesanan" => 300,
                "harga_pengurangan_poin" => 30000,
                "harga_total" => 150000,
                "id_customer" => 3,
            ],
            [
                "tanggal_transaksi" => '2020-12-24 00:00:00',
                "tanggal_ambil" => '2020-12-25 00:00:00',
                "metode_pembayaran" => 'Credit Card',
                "status_pembayaran" => 'belum lunas',
                "status_pengiriman" => 'sudah dikirim',
                "jenis_pengiriman" => 'Ojol',
                "potongan_poin" => 20,
                "poin_pesanan" => 100,
                "harga_pengurangan_poin" => 10000,
                "harga_total" => 70000,
                "id_customer" => 1,
            ],
            [
                "tanggal_transaksi" => '2020-12-25 00:00:00',
                "tanggal_ambil" => '2020-12-26 00:00:00',
                "metode_pembayaran" => 'Bank Transfer',
                "status_pembayaran" => 'lunas',
                "status_pengiriman" => 'belum dikirim',
                "jenis_pengiriman" => 'Kurir',
                "potongan_poin" => 70,
                "poin_pesanan" => 350,
                "harga_pengurangan_poin" => 35000,
                "harga_total" => 200000,
                "id_customer" => 2,
            ]
        ]);
    }
}
