<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProdukHampersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('hampers_produk')->insert([
            "produk_id" => 1,
            "hampers_id" => 1,
        ]);

        DB::table('hampers_produk')->insert([
            "produk_id" => 3,
            "hampers_id" => 1,
        ]);

        DB::table('hampers_produk')->insert([
            "produk_id" => 3,
            "hampers_id" => 2,
        ]);


        DB::table('hampers_produk')->insert([
            "produk_id" => 1,
            "hampers_id" => 2,
        ]);

        DB::table('hampers_produk')->insert([
            "produk_id" => 2,
            "hampers_id" => 2,
        ]);

        DB::table('hampers_produk')->insert([
            "produk_id" => 3,
            "hampers_id" => 3,
        ]);

        DB::table('hampers_produk')->insert([
            "produk_id" => 2,
            "hampers_id" => 3,
        ]);
    }
}
