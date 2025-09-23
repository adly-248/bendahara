<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Sparepartku;
use App\Models\Kendaraan;

use App\Models\Transaksi;
use App\Models\DetailTransaksi;

use Illuminate\Http\JsonResponse;

use Illuminate\Support\Facades\DB;

class TransaksiController extends Controller
{

    public function index()
    {
    }


    public function create()
    {
       // dd('tess');
      // $sparepart = DB::table('sparepart')->get();
        $sparepart=Sparepartku::all();
        $kendaraan=kendaraan::all();
        return view ('transaksi.create', compact('sparepart','kendaraan'));
      //  return view('transaksi.create');
    }


    public function getSparepart($id): JsonResponse
        {
          // dd($id);

        // Cari sparepart berdasarkan ID
            $sparepart = Sparepartku::where('sparepart_id', $id)->first();

            // Jika sparepart ditemukan, kirim data dalam format JSON
            if ($sparepart) {
                return response()->json([
                    'nama_sparepart' => $sparepart->nama_sparepart,
                    'harga' => $sparepart->harga
                ]);
            }

            // Jika tidak ditemukan, kembalikan response dengan error 404
            return response()->json(['error' => 'Sparepart tidak ditemukan'], 404);
        }


    public function store(Request $request)
    {
        DB::beginTransaction();

        try {
            // Simpan transaksi utama
            $transaksi = new Transaksi();
            $transaksi->transaksi_id = $request->idTransaksi;
            $transaksi->kendaraan_id = $request->kendaraan_id;
            $transaksi->keterangan_transaksi = $request->keterangan;
            $transaksi->tanggal_transaksi = $request->tanggal;
            $transaksi->total_harga = $request->total_harga;
            $transaksi->save();

            // Simpan detail transaksi
            foreach ($request->detail_transaksi as $detail) {
                DetailTransaksi::create([
                    'transaksi_id' => $request->idTransaksi,
                    'sparepart_id' => $detail['sparepart_id'],
                    'quantity' => $detail['quantity'],
                    'harga' => $detail['harga'],
                    'subtotal' => $detail['subtotal'],
                ]);
            }

            DB::commit();

            return response()->json(['message' => 'Transaksi berhasil disimpan'], 200);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['message' => 'Gagal menyimpan transaksi'], 500);
        }

    }

    public function show($kategory)
    {
        //
    }


    public function destroy($kategori_id)
    {

    }
}
