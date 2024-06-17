<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class JarakPengirimanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('jarak_pengirimans')->insert([
            [
                'jarak' => 3.00,
                'harga' => 10000,
                'waktu' => 10,
            ],
            [
                'jarak' => 7.00,
                'harga' => 15000,
                'waktu' => 20,
            ]
        ]);
    }
}
