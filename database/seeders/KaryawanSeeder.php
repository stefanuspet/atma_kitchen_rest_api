<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KaryawanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('karyawans')->insert([
            [
                'nama_karyawan' => 'Sirene',
                'email_karyawan' => 'sirene1@example.com',
                'notelp_karyawan' => '081234567891'
            ],
            [
                'nama_karyawan' => 'Andrew',
                'email_karyawan' => 'andrew11@example.com',
                'notelp_karyawan' => '081234567892'
            ],
            [
                'nama_karyawan' => 'Sharon',
                'email_karyawan' => 'sharon2@example.com',
                'notelp_karyawan' => '081234567893'
            ],
            [
                'nama_karyawan' => 'Noah',
                'email_karyawan' => 'noah21@example.com',
                'notelp_karyawan' => '081234567894'
            ],
            [
                'nama_karyawan' => 'Nolan',
                'email_karyawan' => 'nolan22@example.com',
                'notelp_karyawan' => '081234567895'
            ],
            [
                'nama_karyawan' => 'Asgard',
                'email_karyawan' => 'asgard3@example.com',
                'notelp_karyawan' => '081234567896'
            ],
            [
                'nama_karyawan' => 'Lauren',
                'email_karyawan' => 'lauren31@example.com',
                'notelp_karyawan' => '081234567897'
            ],
            [
                'nama_karyawan' => 'Lilya',
                'email_karyawan' => 'lilya32@example.com',
                'notelp_karyawan' => '081234567898'
            ],
            [
                'nama_karyawan' => 'Kelly',
                'email_karyawan' => 'kelly33@example.com',
                'notelp_karyawan' => '081234567899'
            ],
            [
                'nama_karyawan' => 'Lucy',
                'email_karyawan' => 'lucy4@example.com',
                'notelp_karyawan' => '081234567810'
            ]
        ]);
    }
}
