<?php

namespace App\Http\Controllers;

use App\Models\Pemasukkan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class PemasukkanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pemasukkan = Pemasukkan::all();
        // $data = Pengumuman::table('pengumuman');
        // ->leftJoin('Pengumumans', 'pengumuman.id', '=', 'Pengumumans.id')
        // ->select('pengumuman.*', 'Pengumumans.name as nama')
        // ->get();
        return view('pemasukkan.index', compact('pemasukkan'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('pemasukkan.create');
    }

    public function store(Request $request): RedirectResponse
    {
        // Bersihkan format rupiah jadi angka mentah
        $request->merge([
            'jumlah_pemasukkan' => preg_replace('/[^0-9]/', '', $request->jumlah_pemasukkan)
        ]);

        $validated = $request->validate([
            'jumlah_pemasukkan' => 'required|numeric',
            'tanggal_pemasukkan' => 'required|date',
            'sumber' => 'nullable|string|max:100',
            'transaksi' => 'required|in:Tunai,Transfer',
            'kategori' => 'required|in:dana_bos_kinerja,dana_bos_prestasi,sumbangan_orang_tua,komite_sekolah',
            // 'keterangan' => 'nullable|string|max:100',
        ]);

        Pemasukkan::create($validated);

        return redirect()->route('pemasukkan.index')
            ->with('success', 'Pemasukkan berhasil ditambahkan!');
    }

    public function edit($id_pemasukkan)
    {
        $pemasukkan = Pemasukkan::where('id_pemasukkan', $id_pemasukkan)->firstOrFail();

        // Format jumlah pemasukkan supaya tampil di input edit sebagai Rupiah
        $pemasukkan->jumlah_pemasukkan = number_format($pemasukkan->jumlah_pemasukkan, 0, ',', '.');

        return view('pemasukkan.edit', compact('pemasukkan'));
    }

    public function update(Request $request, string $id_pemasukkan)
    {
        $pemasukkan = Pemasukkan::where('id_pemasukkan', $id_pemasukkan)->first();

        if (!$pemasukkan) {
            return redirect('pemasukkan')->with('success', 'Pemasukkan Gagal Diubah..');
        }

        // Bersihkan input jumlah_pemasukkan dari format rupiah
        $request->merge([
            'jumlah_pemasukkan' => preg_replace('/[^0-9]/', '', $request->jumlah_pemasukkan)
        ]);

        // Validasi
        $request->validate([
            'jumlah_pemasukkan' => 'required|numeric',
            'tanggal_pemasukkan' => 'required|date',
            'sumber' => 'nullable|string|max:100',
            'transaksi' => 'required|in:Tunai,Transfer',
            'kategori' => 'required|in:dana_bos_kinerja,dana_bos_prestasi,sumbangan_orang_tua,komite_sekolah',
            // 'keterangan' => 'nullable|string|max:100',
        ]);

        // Update data
        $pemasukkan->update([
            'jumlah_pemasukkan' => $request->jumlah_pemasukkan,
            'tanggal_pemasukkan' => $request->tanggal_pemasukkan,
            'sumber' => $request->sumber,
            'transaksi' => $request->transaksi,
            'kategori' => $request->kategori,
            // 'keterangan' => $request->keterangan,
        ]);

        return redirect('pemasukkan')->with('success', 'Data Pemasukkan Berhasil Diubah..');
    }


    public function destroy($id_pemasukkan): RedirectResponse
    {
        Pemasukkan::where('id_pemasukkan', $id_pemasukkan)->delete();
        return redirect('pemasukkan')->with('success', 'Pemasukkan berhasil dihapus..');
    }
}
