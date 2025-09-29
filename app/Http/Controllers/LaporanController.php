<?php

namespace App\Http\Controllers;

use App\Models\Laporan;
use App\Models\Pemasukkan;
use App\Models\Pengeluaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;



class LaporanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $month    = $request->input('month');
        $year     = $request->input('year');
        $kategori = $request->input('kategori');
        $transaksi = $request->input('transaksi');

        // default bila kosong → pakai bulan/tahun sekarang
        $month = $month ? str_pad((int)$month, 2, '0', STR_PAD_LEFT) : date('m');
        $year  = $year  ? (int)$year : (int)date('Y');

        if ($kategori) {
            $totalPemasukan = 0;

            $totalPengeluaran = DB::table('pengeluaran')
                ->whereYear('tanggal_pengeluaran', $year)
                ->whereMonth('tanggal_pengeluaran', $month)
                ->where('kategori', $kategori)
                // NOTE: jika nama kolom metode transaksi berbeda, sesuaikan 'transaksi' di bawah ini
                ->when($transaksi, fn($q) => $q->where('transaksi', $transaksi))
                ->sum('jumlah_pengeluaran');

            $saldo = -$totalPengeluaran;

            $monthlyData = collect();
            $monthlyPengeluaran = DB::table('pengeluaran')
                ->select(DB::raw('MONTH(tanggal_pengeluaran) as month'), DB::raw('SUM(jumlah_pengeluaran) as total'))
                ->whereYear('tanggal_pengeluaran', $year)
                ->when($kategori, fn($q) => $q->where('kategori', $kategori))
                ->groupBy('month')
                ->pluck('total', 'month');
        } else {
            $totalPemasukan = DB::table('pemasukkan')
                ->whereYear('tanggal_pemasukkan', $year)
                ->whereMonth('tanggal_pemasukkan', $month)
                ->when($transaksi, fn($q) => $q->where('transaksi', $transaksi))
                ->sum('jumlah_pemasukkan');

            $totalPengeluaran = DB::table('pengeluaran')
                ->whereYear('tanggal_pengeluaran', $year)
                ->whereMonth('tanggal_pengeluaran', $month)
                ->when($transaksi, fn($q) => $q->where('transaksi', $transaksi))
                ->sum('jumlah_pengeluaran');

            $saldo = $totalPemasukan - $totalPengeluaran;

            $monthlyData = DB::table('pemasukkan')
                ->select(DB::raw('MONTH(tanggal_pemasukkan) as month'), DB::raw('SUM(jumlah_pemasukkan) as total'))
                ->whereYear('tanggal_pemasukkan', $year)
                ->groupBy('month')
                ->pluck('total', 'month');

            $monthlyPengeluaran = DB::table('pengeluaran')
                ->select(DB::raw('MONTH(tanggal_pengeluaran) as month'), DB::raw('SUM(jumlah_pengeluaran) as total'))
                ->whereYear('tanggal_pengeluaran', $year)
                ->groupBy('month')
                ->pluck('total', 'month');
        }

        return view('laporan.index', compact(
            'month',
            'year',
            'kategori',
            'totalPemasukan',
            'totalPengeluaran',
            'saldo',
            'monthlyData',
            'monthlyPengeluaran'
        ));
    }

    public function print(Request $request)
    {
        $month    = $request->input('month');
        $year     = $request->input('year');
        $kategori = $request->input('kategori');
        $transaksi = $request->input('transaksi');

        // default bila kosong → pakai bulan/tahun sekarang
        $month = $month ? str_pad((int)$month, 2, '0', STR_PAD_LEFT) : date('m');
        $year  = $year  ? (int)$year : (int)date('Y');

        if ($kategori) {
            $totalPemasukan = 0;

            $totalPengeluaran = DB::table('pengeluaran')
                ->whereYear('tanggal_pengeluaran', $year)
                ->whereMonth('tanggal_pengeluaran', $month)
                ->where('kategori', $kategori)
                ->when($transaksi, fn($q) => $q->where('transaksi', $transaksi))
                ->sum('jumlah_pengeluaran');

            $saldo = -$totalPengeluaran;

            $monthlyData = collect();
            $monthlyPengeluaran = DB::table('pengeluaran')
                ->select(DB::raw('MONTH(tanggal_pengeluaran) as month'), DB::raw('SUM(jumlah_pengeluaran) as total'))
                ->whereYear('tanggal_pengeluaran', $year)
                ->when($kategori, fn($q) => $q->where('kategori', $kategori))
                ->groupBy('month')
                ->pluck('total', 'month');
        } else {
            $totalPemasukan = DB::table('pemasukkan')
                ->whereYear('tanggal_pemasukkan', $year)
                ->whereMonth('tanggal_pemasukkan', $month)
                ->when($transaksi, fn($q) => $q->where('transaksi', $transaksi))
                ->sum('jumlah_pemasukkan');

            $totalPengeluaran = DB::table('pengeluaran')
                ->whereYear('tanggal_pengeluaran', $year)
                ->whereMonth('tanggal_pengeluaran', $month)
                ->when($transaksi, fn($q) => $q->where('transaksi', $transaksi))
                ->sum('jumlah_pengeluaran');

            $saldo = $totalPemasukan - $totalPengeluaran;

            $monthlyData = DB::table('pemasukkan')
                ->select(DB::raw('MONTH(tanggal_pemasukkan) as month'), DB::raw('SUM(jumlah_pemasukkan) as total'))
                ->whereYear('tanggal_pemasukkan', $year)
                ->groupBy('month')
                ->pluck('total', 'month');

            $monthlyPengeluaran = DB::table('pengeluaran')
                ->select(DB::raw('MONTH(tanggal_pengeluaran) as month'), DB::raw('SUM(jumlah_pengeluaran) as total'))
                ->whereYear('tanggal_pengeluaran', $year)
                ->groupBy('month')
                ->pluck('total', 'month');
        }

        // buat label periode & nama file
        $periode = $month . '-' . $year;
        $fileName = 'Laporan_SMKN13_' . $periode
            . ($kategori ? '_Kategori_' . preg_replace('/\s+/', '', $kategori) : '')
            . ($transaksi ? '_Transaksi_' . $transaksi : '')
            . '.pdf';

        $pdf = Pdf::loadView('laporan.print', [
            'month' => $month,
            'year' => $year,
            'kategori' => $kategori,
            'transaksi' => $transaksi,
            'totalPemasukan' => $totalPemasukan ?? 0,
            'totalPengeluaran' => $totalPengeluaran ?? 0,
            'saldo' => $saldo ?? 0,
            'monthlyData' => $monthlyData ?? collect(),
            'monthlyPengeluaran' => $monthlyPengeluaran ?? collect(),
            'generatedAt' => now(),
        ])->setPaper('a4', 'portrait');

        // return $pdf->download($fileName); // langsung download; kalau mau preview gunakan ->stream($fileName)
        return $pdf->stream($fileName); // preview di tab baru

    }



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Laporan $laporan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Laporan $laporan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Laporan $laporan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Laporan $laporan)
    {
        //
    }

    public function pemasukkan(Request $request)
    {
        $month = $request->input('month');
        $year  = $request->input('year');

        $query = Pemasukkan::query();

        if ($month) {
            $query->whereMonth('tanggal_pemasukkan', $month);
        }
        if ($year) {
            $query->whereYear('tanggal_pemasukkan', $year);
        }

        $data = $query->get();
        $total = $query->sum('jumlah_pemasukkan');

        return view('laporan.pemasukkan', compact('data', 'total', 'month', 'year'));
    }


    public function pengeluaran(Request $request)
    {
        $month = $request->input('month');
        $year  = $request->input('year');

        $query = Pengeluaran::query();

        if ($month) {
            $query->whereMonth('tanggal_pengeluaran', $month);
        }
        if ($year) {
            $query->whereYear('tanggal_pengeluaran', $year);
        }

        $data = $query->get();
        $total = $query->sum('jumlah_pengeluaran');

        return view('laporan.pengeluaran', compact('data', 'total', 'month', 'year'));
    }
    public function printPemasukkan(Request $request)
    {
        $query = \App\Models\Pemasukkan::query();

        if ($request->month) {
            $query->whereMonth('tanggal_pemasukkan', $request->month);
        }

        if ($request->year) {
            $query->whereYear('tanggal_pemasukkan', $request->year);
        }

        $data = $query->get();
        $total = $data->sum('jumlah_pemasukkan');

        $pdf = Pdf::loadView('laporan.print_pemasukkan', compact('data', 'total'));
        return $pdf->stream('laporan_pemasukkan.pdf');
    }

     public function printPengeluaran(Request $request)
    {
        $query = Pengeluaran::query();

        if ($request->month) {
            $query->whereMonth('tanggal_pengeluaran', $request->month);
        }
        if ($request->year) {
            $query->whereYear('tanggal_pengeluaran', $request->year);
        }

        $data = $query->get();
        $total = $data->sum('jumlah_pengeluaran');

        $pdf = Pdf::loadView('laporan.print_pengeluaran', compact('data', 'total'))
                  ->setPaper('a4', 'portrait');

        return $pdf->stream('laporan_pengeluaran.pdf');
    }
}
