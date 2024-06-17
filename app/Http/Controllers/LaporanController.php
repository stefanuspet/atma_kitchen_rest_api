<?php

namespace App\Http\Controllers;

use App\Models\Gaji;
use App\Models\Karyawan;
use App\Models\Penitip;
use App\Models\Presensi;
use App\Models\Transaksi;
use Barryvdh\DomPDF\Facade\Pdf;

class LaporanController extends Controller
{
    public function presensiGaji()
    {
        $karyawans = Karyawan::all();

        // Process data to calculate the report
        $reportData = $karyawans->map(function ($karyawan) {
            $presensis = Presensi::where('id_karyawan', $karyawan->id)->get();
            $hadir = $presensis->where('Status', 'Hadir')->count();
            $bolos = $presensis->where('Status', 'Bolos')->count();
            $gaji = Gaji::where('id_karyawan', $karyawan->id)->first();
            $honorHarian = 10000 * $hadir;
            $bonus = $gaji->bonus ?? 0;
            $total = $honorHarian + $bonus;

            return [
                'nama' => $karyawan->nama_karyawan,
                'jumlah_hadir' => $hadir,
                'jumlah_bolos' => $bolos,
                'honor_harian' => $honorHarian,
                'bonus_rajin' => $bonus,
                'total' => $total
            ];
        });

        $pdf = PDF::loadView('reports.employee', compact('reportData'));
        return $pdf->download('employee_report.pdf');
    }

    public function pemasukanPengeluaran($month, $year)
    {
        $fromDate = "{$year}-{$month}-01";
        $toDate = date("Y-m-t", strtotime($fromDate));

        $transactions = Transaksi::whereBetween('tanggal_transaksi', [$fromDate, $toDate])->get();
        $salaries = Gaji::whereHas('karyawan', function ($query) use ($fromDate, $toDate) {
            $query->whereBetween('created_at', [$fromDate, $toDate]);
        })->get();

        $data = [
            'transactions' => $transactions,
            'salaries' => $salaries,
            'month' => $month,
            'year' => $year
        ];

        $pdf = PDF::loadView('reports.monthly', $data);
        return $pdf->download("monthly-report-{$month}-{$year}.pdf");
    }

    public function rekapTransaksiPenitip($month, $year)
    {
        $fromDate = "{$year}-{$month}-01";
        $toDate = date("Y-m-t", strtotime($fromDate));

        $transactions = Penitip::with(['produk_penitip' => function ($query) use ($fromDate, $toDate) {
            $query->whereBetween('created_at', [$fromDate, $toDate]);
        }])->get();

        $pdf = PDF::loadView('reports.penitip', compact('transactions', 'month', 'year'));
        return $pdf->download('laporan-transaksi-penitip.pdf');
    }
}
