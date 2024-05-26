<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JarakPengirimanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('jarakPengiriman')->insert([
            [
                'jarak' => '5.0',
                'harga' => '10000',
                'waktu' => '10'
            ],
            [
                'jarak' => '7.5',
                'harga' => '15000',
                'waktu' => '20'
            ],
            [
                'jarak' => '12.0',
                'harga' => '20000',
                'waktu' => '30'
            ],
            [
                'jarak' => '16.0',
                'harga' => '25000',
                'waktu' => '40'
            ],
        ]);
    }
}
