<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // Tahun & bulan sekarang (untuk kartu ringkasan + pie chart)
        $month = date('m');
        $year  = date('Y');

        // 1) Total untuk bulan berjalan (kartu & pie chart)
        $totalPemasukan = DB::table('pemasukkan')
            ->whereYear('tanggal_pemasukkan', $year)
            ->whereMonth('tanggal_pemasukkan', $month)
            ->sum('jumlah_pemasukkan');

        $totalPengeluaran = DB::table('pengeluaran')
            ->whereYear('tanggal_pengeluaran', $year)
            ->whereMonth('tanggal_pengeluaran', $month)
            ->sum('jumlah_pengeluaran');

        $saldo = $totalPemasukan - $totalPengeluaran;

        // 2) Rekap per bulan SETAHUN (untuk line chart)
        $monthlyIncomeRaw = DB::table('pemasukkan')
            ->selectRaw('MONTH(tanggal_pemasukkan) as month, SUM(jumlah_pemasukkan) as total')
            ->whereYear('tanggal_pemasukkan', $year)
            ->groupBy('month')
            ->pluck('total', 'month'); // [month => total]

        $monthlyExpenseRaw = DB::table('pengeluaran')
            ->selectRaw('MONTH(tanggal_pengeluaran) as month, SUM(jumlah_pengeluaran) as total')
            ->whereYear('tanggal_pengeluaran', $year)
            ->groupBy('month')
            ->pluck('total', 'month'); // [month => total]

        // Normalisasi jadi array 1..12 (isi 0 jika bulan tidak ada data)
        $monthlyIncome = array_fill(1, 12, 0);
        foreach ($monthlyIncomeRaw as $m => $total) {
            $monthlyIncome[(int)$m] = (int)$total;
        }

        $monthlyExpense = array_fill(1, 12, 0);
        foreach ($monthlyExpenseRaw as $m => $total) {
            $monthlyExpense[(int)$m] = (int)$total;
        }

        // Saldo per bulan (bukan kumulatif): pemasukkan bulan itu - pengeluaran bulan itu
        $monthlySaldo = array_fill(1, 12, 0);
        for ($m = 1; $m <= 12; $m++) {
            $monthlySaldo[$m] = $monthlyIncome[$m] - $monthlyExpense[$m];
        }

        return view('dashboard', compact(
            'totalPemasukan',
            'totalPengeluaran',
            'saldo',
            'month',
            'year',
            'monthlyIncome',
            'monthlyExpense',
            'monthlySaldo'
        ));
    }
}
