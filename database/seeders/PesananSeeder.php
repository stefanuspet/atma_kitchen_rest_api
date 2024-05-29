<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PesananSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('pesanans')->insert([
            [
                'nama_produk' => 'kue',
                'id_jarak_pengiriman' => 1
            ],
            [
                'nama_produk' => 'eskrim',
                'id_jarak_pengiriman' => 1
            ],
            [
                'nama_produk' => 'cake',
                'id_jarak_pengiriman' => 2
            ],
            [
                'nama_produk' => 'roti',
                'id_jarak_pengiriman' => 2
            ]
        ]);
    }
}
