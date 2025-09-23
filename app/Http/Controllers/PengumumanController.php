<?php

namespace App\Http\Controllers;

use App\Models\Pengumuman;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class PengumumanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pengumuman = Pengumuman::all();
        // $data = Pengumuman::table('pengumuman');
        // ->leftJoin('Pengumumans', 'pengumuman.id', '=', 'Pengumumans.id')
        // ->select('pengumuman.*', 'Pengumumans.name as nama')
        // ->get();
        return view('pengumuman.index', compact('pengumuman'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $user = User::all();
        return view('pengumuman.create', compact('user'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'id' => 'required|int',
            'judul' => 'required|string|max:100',
            'isi' => 'required|string',
        ]);

        Pengumuman::create($validated);

        return redirect()->route('pengumuman.index')
            ->with('success', 'Pengumuman berhasil ditambahkan!');
    }

    public function edit($id_pengumuman): View
    {
         $user = User::all();
         $pengumuman = Pengumuman::where('id_pengumuman',$id_pengumuman)->first();
        return view('pengumuman.edit',compact('user','pengumuman'));

    }

    public function update(Request $request, string $id_pengumuman)
    {
         $pengumuman = Pengumuman::where('id_pengumuman', $id_pengumuman)->first();

        if (!$pengumuman) {
            return redirect('pengumuman')->with('success', 'Peminjaman Gagal Diubah..');
        }

        $request->validate([
            'id' => 'required|int',
            'judul' => 'required|string|max:100',
            'isi' => 'required|string',
            'tanggal_dibuat' => 'required|date',
        ]);

        $pengumuman->update([
            'id' => $request->id,
            'judul' => $request->judul,
            'isi' => $request->isi,
            'tanggal_dibuat' => $request->tanggal_dibuat,
        ]);

        return redirect('pengumuman')->with('success', 'Data Pengumuman Berhasil Diubah..');

    }

    public function destroy( $id_pengumuman): RedirectResponse
    {
        Pengumuman::where('id_pengumuman', $id_pengumuman)->delete();
        return redirect('pengumuman')->with('success', 'Pengumuman berhasil dihapus..');
    }
}

