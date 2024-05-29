<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PenitipSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('penitips')->insert([
            "nama_penitip" => "Budi",
            "email_penitip" => "budi@gmail.com",
            "notelp_penitip" => "081234567890",
        ]);

        DB::table('penitips')->insert([
            "nama_penitip" => "Andi",
            "email_penitip" => "Andi@gmail.com",
            "notelp_penitip" => "081234567891",
        ]);

        DB::table('penitips')->insert([
            "nama_penitip" => "Caca",
            "email_penitip" => "caca@gmail.com",
            "notelp_penitip" => "081234567892",
        ]);
    }
}
