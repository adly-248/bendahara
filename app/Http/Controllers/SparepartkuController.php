<?php

namespace App\Http\Controllers;

use App\Models\Kategory;
use App\Models\Sparepartku;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SparepartkuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
      // $sparepart=Sparepartku::all();
        $sparepart = DB::table('sparepart')->get();

       return view('sparepartku.index',compact('sparepart'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kategory=Kategory::all();
        return view('sparepartku.create',compact('kategory'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

         $request-> validate([
            'sparepart_id'=>'required|numeric|unique:sparepart,sparepart_id',
            'nama_sparepart'=>'required|string|max:255',
            'harga'=>'required|string|max:255',
            'stok'=>'required|string|max:255',
            'image'=>'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Validasi gambar
         ]);

    // Proses upload gambar
    if ($request->hasFile('image')) {
        $image = $request->file('image');
        $imageName = time() . '_' . $image->getClientOriginalName(); // Nama unik
        $image->move(public_path('sparepart'), $imageName); // Simpan di folder public/sparepart
    } else {
        $imageName = null; // Jika tidak ada gambar yang diupload
    }

    Sparepartku::create([
    'sparepart_id'=>$request->sparepart_id,
    'nama_sparepart'=>$request->nama_sparepart,
    'harga'=>$request->harga,
    'stok'=>$request->stok,
    'kategori_id'=>$request->kategori_id,
    'image'=>$imageName,
    ]);


    return redirect('sparepartku')->with('success','sparepart Berhasil Ditambah..');

    }

    /**
     * Display the specified resource.
     */
    public function show($sparepart)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($sparepart_id)
    {

        $kategory=Kategory::all();

        $sparepart=Sparepartku::where('sparepart_id',$sparepart_id)->first();

        return view('sparepartku/edit',compact('sparepart','kategory'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $sparepart_id)
    {

        $sparepart=Sparepartku::where('sparepart_id',$sparepart_id)->first();

        if(!$sparepart) {
            return redirect('sparepart')->with('success','sparepart Gagal Diubah..');
        }


        $request-> validate([
            'nama_sparepart'=>'required|string|max:255',
            'harga'=>'required|string|max:255',
            'stok'=>'required|string|max:255',
         ]);

         // Cek apakah ada file baru diupload
    if ($request->hasFile('image')) {
        $image = $request->file('image');
        $imageName = $image->getClientOriginalName(); // Gunakan nama asli
        $image->move(public_path('sparepart'), $imageName); // Simpan di folder public/sparepart
    } else {
        // Jika tidak ada gambar baru, gunakan gambar lama
        $imageName = $sparepart->image;
    }


        //update data
        $sparepart-> update ([
         'nama_sparepart'=>$request->nama_sparepart,
        'harga'=>$request->harga,
        'stok'=>$request->stok,
        'kategori_id'=>$request->kategori_id,
        'image'=>$imageName,

        ]);

       return redirect('sparepartku')->with('success','Data sparepart Berhasil Diubah..');
    }

    /**
     * Remove the specified resource from storage.
     */

    public function destroy($sparepart_id)
    {

        $sparepart=Sparepartku::where('sparepart_id',$sparepart_id)->first();

        // Cek apakah sparepart memiliki gambar
        if ($sparepart->image) {
            $imagePath = public_path('sparepart/' . $sparepart->image);

            // Hapus gambar jika file ada
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }

        // Hapus data sparepart dari database
        // $sparepart->delete();


        $sparepart = sparepartku::where('sparepart_id', $sparepart_id)->first();
        $sparepart->delete();

        return redirect('sparepartku')->with('success','Data sparepart Berhasil dihapus..');
    }
}
