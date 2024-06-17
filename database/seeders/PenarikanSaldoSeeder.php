<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PenarikanSaldoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('penarikan_saldos')->insert([
            ['jumlah_penarikan' => 100000, 'tanggal_penarikan' => Carbon::today()->subDays(10), 'trasfered' => 'PENDING'],
            ['jumlah_penarikan' => 150000, 'tanggal_penarikan' => Carbon::today()->subDays(9), 'trasfered' => 'SUCCESS'],
            ['jumlah_penarikan' => 200000, 'tanggal_penarikan' => Carbon::today()->subDays(8), 'trasfered' => 'FAILED'],
            ['jumlah_penarikan' => 250000, 'tanggal_penarikan' => Carbon::today()->subDays(7), 'trasfered' => 'PENDING'],
            ['jumlah_penarikan' => 300000, 'tanggal_penarikan' => Carbon::today()->subDays(6), 'trasfered' => 'SUCCESS'],
            ['jumlah_penarikan' => 350000, 'tanggal_penarikan' => Carbon::today()->subDays(5), 'trasfered' => 'PENDING'],
            ['jumlah_penarikan' => 400000, 'tanggal_penarikan' => Carbon::today()->subDays(4), 'trasfered' => 'FAILED'],
            ['jumlah_penarikan' => 450000, 'tanggal_penarikan' => Carbon::today()->subDays(3), 'trasfered' => 'SUCCESS'],
            ['jumlah_penarikan' => 500000, 'tanggal_penarikan' => Carbon::today()->subDays(2), 'trasfered' => 'PENDING'],
            ['jumlah_penarikan' => 550000, 'tanggal_penarikan' => Carbon::today()->subDays(1), 'trasfered' => 'FAILED'],
        ]);
    }
}
