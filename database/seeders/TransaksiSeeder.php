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
            "tanggal_transaksi" => '10-10-2020',
            "harga_total" => '100000',
            "metode_pembayaran" => 'Cash',
            "status_pembayaran" => 'Lunas',
            "status_pengiriman" => 'Sudah Dikirim',
            "jenis_pengiriman" => 'Kurir',
            "tip" => '0',
            "id_customer" => '1',
        ]);
        DB::table('transaksis')->insert([
            "tanggal_transaksi" => '21-03-2005',
            "harga_total" => '250000',
            "metode_pembayaran" => 'Cash',
            "status_pembayaran" => 'Lunas',
            "status_pengiriman" => 'Sudah Diambil',
            "jenis_pengiriman" => 'Self Pickup',
            "tip" => '5000',
            "id_customer" => '2',
        ]);
        DB::table('transaksis')->insert([
            "tanggal_transaksi" => '11-06-2003',
            "harga_total" => '125000',
            "metode_pembayaran" => 'Cash',
            "status_pembayaran" => 'Lunas',
            "status_pengiriman" => 'Sudah Diambil',
            "jenis_pengiriman" => 'Self Pickup',
            "tip" => '0',
            "id_customer" => '3',
        ]);
    }
}
