<?php

namespace App\Http\Controllers;

use App\Models\Kategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class KategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
            // $kategory = DB::table('kategorysparepart')->get();
            // return view ('kategory/index', compact('kategory'));

             $kategory = Kategory::all(); // Ambil semua data kategori
             return view('kategory.index', compact('kategory'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
         return view ('kategory/create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       $request->validate([
            'nama_kategori' => 'required|string|max:255',
            'dibuat_oleh' => 'required|string|in:admin,user', // Ganti dengan daftar enum kamu
        ]);



        Kategory::create([
            'nama_kategori' => $request->nama_kategori,
            'dibuat_oleh' => $request->dibuat_oleh,
        ]);

   return redirect('kategory')->with('success', 'Kategori berhasil ditambahkan!');


    }

    /**
     * Display the specified resource.
     */
    public function show(Kategory $id)
    {
      // return view('kategori.edit', compact('kategori'));
    }

    /**
     * Show the form for editing the specified resource.
     */
        public function edit($id_kategori)
        {
            $kategory = Kategory::where('id_kategori', $id_kategori)->first();
            return view('kategory/edit', compact('kategory'));
        }



    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string  $id_kategori)
    {

  //dd($request->nama_kategori);

    $kategory = Kategory::where('id_kategori', $id_kategori)->first();


    if (!$kategory) {
         return redirect('kategory')->with('success', 'Kategori gagal diperbaiki!');
    }

    // Update data kategori
    $kategory->update([
        'nama_kategori' => $request->nama_kategori,
        'dibuat_oleh' => $request->dibuat_oleh,
    ]);

     return redirect('kategory')->with('success', 'Kategori berhasil diperbaiki!');
}



    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id_kategori)
    {
        $kategory = kategory::where('id_kategori', $id_kategori)->first();
        $kategory->delete();
        return redirect('kategory')->with('success', 'Kategori berhasil dihapus!');
    }
}
