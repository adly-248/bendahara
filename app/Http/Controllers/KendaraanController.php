<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Kendaraan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KendaraanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kendaraan = DB::table('kendaraan')->get();
        return view('kendaraan.index', compact('kendaraan'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $customer = Customer::all();
        return view('kendaraan.create', compact('customer'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'kendaraan_id' => 'required|numeric|unique:kendaraan,kendaraan_id',
            'customer_id' => 'required|exists:customers,customer_id',
            'jenis_kendaraan' => 'required|string|max:255',
            'nomor_polisi' => 'required|string|max:255|unique:kendaraan,nomor_polisi',
            'merek' => 'required|string|max:255',
            'tahun' => 'required|digits:4|integer|min:1900|max:'.(date('Y')+1),
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Proses upload gambar
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('kendara'), $imageName);
        } else {
            $imageName = null;
        }

        Kendaraan::create([
            'kendaraan_id' => $request->kendaraan_id,
            'customer_id' => $request->customer_id,
            'jenis_kendaraan' => $request->jenis_kendaraan,
            'nomor_polisi' => $request->nomor_polisi,
            'merek' => $request->merek,
            'tahun' => $request->tahun,
            'image' => $imageName,
        ]);

        return redirect('kendaraan')->with('success', 'Data kendaraan berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show($kendaraan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($kendaraan_id)
    {
        $customer = Customer::all();
        $kendaraan = Kendaraan::where('kendaraan_id', $kendaraan_id)->firstOrFail();
        return view('kendaraan.edit', compact('kendaraan', 'customer'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $kendaraan_id)
    {
        $kendaraan = Kendaraan::where('kendaraan_id', $kendaraan_id)->firstOrFail();

        $request->validate([
            'customer_id' => 'required|exists:customers,customer_id',
            'jenis_kendaraan' => 'required|string|max:255',
            'nomor_polisi' => 'required|string|max:255|unique:kendaraan,nomor_polisi,'.$kendaraan_id.',kendaraan_id',
            'merek' => 'required|string|max:255',
            'tahun' => 'required|digits:4|integer|min:1900|max:'.(date('Y')+1),
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Cek apakah ada file baru diupload
        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($kendaraan->image && file_exists(public_path('kendara/' . $kendaraan->image))) {
                unlink(public_path('kendara/' . $kendaraan->image));
            }

            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('kendara'), $imageName);
        } else {
            $imageName = $kendaraan->image;
        }

        $kendaraan->update([
            'customer_id' => $request->customer_id,
            'jenis_kendaraan' => $request->jenis_kendaraan,
            'nomor_polisi' => $request->nomor_polisi,
            'merek' => $request->merek,
            'tahun' => $request->tahun,
            'image' => $imageName,
        ]);

        return redirect('kendaraan')->with('success', 'Data kendaraan berhasil diubah.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($kendaraan_id)
    {
        $kendaraan = Kendaraan::where('kendaraan_id', $kendaraan_id)->firstOrFail();

        // Hapus gambar jika ada
        if ($kendaraan->image && file_exists(public_path('kendara/' . $kendaraan->image))) {
            unlink(public_path('kendara/' . $kendaraan->image));
        }

        $kendaraan->delete();
        return redirect('kendaraan')->with('success', 'Data kendaraan berhasil dihapus.');
    }
}
