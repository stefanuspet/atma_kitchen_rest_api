<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            "nama_user" => 'Yuna',
            "email_user" => 'yuna@gmail.com',
            "notelp_user" => '12345678',
            "password_user" => Hash::make('yuna'),
            'id_jabatan' => '1'
        ]);
        DB::table('users')->insert([
            "nama_user" => 'Satya',
            "email_user" => 'satya@gmail.com',
            "notelp_user" => '12345678',
            "password_user" => Hash::make('satya'),
            'id_jabatan' => '2'
        ]);
        DB::table('users')->insert([
            "nama_user" => 'Margareth',
            "email_user" => 'margareth@gmail.com',
            "notelp_user" => '12345678',
            "password_user" => Hash::make('margareth'),
            'id_jabatan' => '3'
        ]);
    }
}
