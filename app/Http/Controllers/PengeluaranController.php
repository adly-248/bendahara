<?php

namespace App\Http\Controllers;

use App\Models\Pengeluaran;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class PengeluaranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pengeluaran = Pengeluaran::all();
        // $data = Pengumuman::table('pengumuman');
        // ->leftJoin('Pengumumans', 'pengumuman.id', '=', 'Pengumumans.id')
        // ->select('pengumuman.*', 'Pengumumans.name as nama')
        // ->get();
        return view('pengeluaran.index', compact('pengeluaran'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('pengeluaran.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'jumlah_pengeluaran' => 'required|numeric',
            'tanggal_pengeluaran' => 'required|date',
            'kategori' => 'required|in:ATK,Listrik_Air,Kegiatan_Siswa,Gaji_Guru_Staff,Perawatan_Fasilitas,Konsumsi,Transportasi,Lainnya',
            'transaksi' => 'required|in:Tunai,Transfer',
            'keterangan' => 'nullable|string|max:100',
            'image' => 'required|image|mimes:jpg,jpeg,png',
        ]);

        $imageName = "";
        if ($request->hasFile('image')) {
            $file = $request->file('image'); // ambil file
            $imageName = time() . '_' . $file->getClientOriginalName(); // buat nama unik
            // dd($imageName);
            $file->move(public_path('bukti_pembayaran'), $imageName); // simpan di public/bukti_pembayaran
        } else {
            $imageName = null; // jika tidak ada gambar diupload
        }


        Pengeluaran::create([
            'jumlah_pengeluaran' => $request->jumlah_pengeluaran,
            'tanggal_pengeluaran' => $request->tanggal_pengeluaran,
            'kategori' => $request->kategori,
            'transaksi' => $request->transaksi,
            'keterangan' => $request->keterangan,
            'bukti_pembayaran' => $imageName,
        ]);


        return redirect()->route('pengeluaran.index')
            ->with('success', 'Pengeluaran berhasil ditambahkan!');
    }

    public function edit($id_pengeluaran)
    {
        $pengeluaran = Pengeluaran::where('id_pengeluaran', $id_pengeluaran)->first();
        return view('pengeluaran.edit', compact('pengeluaran'));
    }

    public function update(Request $request, string $id_pengeluaran)
    {
        $pengeluaran = Pengeluaran::where('id_pengeluaran', $id_pengeluaran)->first();

        if (!$pengeluaran) {
            return redirect('pengeluaran')->with('error', 'Pengeluaran tidak ditemukan.');
        }

        $request->validate([
            'jumlah_pengeluaran' => 'required|numeric',
            'tanggal_pengeluaran' => 'required|date',
            'kategori' => 'required|in:ATK,Listrik_Air,Kegiatan_Siswa,Gaji_Guru_Staff,Perawatan_Fasilitas,Konsumsi,Transportasi,Lainnya',
            'transaksi' => 'required|in:Tunai,Transfer',
            'keterangan' => 'nullable|string|max:100',
            'image' => 'nullable|image|mimes:jpg,jpeg,png', // tidak wajib
        ]);

        $imageName = $pengeluaran->bukti_pembayaran; // default pakai yang lama

        // Kalau ada file baru
        if ($request->hasFile('image')) {
            // Hapus file lama jika ada
            if ($imageName && file_exists(public_path('bukti_pembayaran/' . $imageName))) {
                unlink(public_path('bukti_pembayaran/' . $imageName));
            }

            // Simpan file baru
            $file = $request->file('image');
            $imageName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('bukti_pembayaran'), $imageName);
        }

        // Update data
        $pengeluaran->update([
            'jumlah_pengeluaran' => $request->jumlah_pengeluaran,
            'tanggal_pengeluaran' => $request->tanggal_pengeluaran,
            'kategori' => $request->kategori,
            'transaksi' => $request->transaksi,
            'keterangan' => $request->keterangan,
            'bukti_pembayaran' => $imageName,
        ]);

        return redirect('pengeluaran')->with('success', 'Data Pengeluaran Berhasil Diubah.');
    }


    public function destroy($id_pengeluaran): RedirectResponse
    {
        Pengeluaran::where('id_pengeluaran', $id_pengeluaran)->delete();
        return redirect('pengeluaran')->with('success', 'Pengeluaran berhasil dihapus..');
    }
}
