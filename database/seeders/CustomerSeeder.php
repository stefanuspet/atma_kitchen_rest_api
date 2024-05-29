<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table("customers")->insert([
            "nama_customer" => "Petra",
            "email_customer" => "stefanuspetra.p@gmail.com",
            "notelp_customer" => "12345678",
            "password_customer" => Hash::make("12345678"),
        ]);
    }
}
