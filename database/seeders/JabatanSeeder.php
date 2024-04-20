<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JabatanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('jabatans')->insert([
            "deskirpsi_jabatan" => 'Pembuat Informasi Produk',
            "nama_jabatan" => 'ADMIN'
        ]);
        DB::table('jabatans')->insert([
            "deskirpsi_jabatan" => 'Manager Operasional',
            "nama_jabatan" => 'MO'
        ]);
        DB::table('jabatans')->insert([
            "deskirpsi_jabatan" => 'Pemilik Atma Kitchen',
            "nama_jabatan" => 'OWNER'
        ]);
    }
}
