<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pengeluaran extends Model
{
    protected $table = 'pengeluaran'; // Nama tabel yang benar

    protected $primaryKey = 'id_pengeluaran';

    protected $fillable = ['jumlah_pengeluaran','tanggal_pengeluaran','kategori','transaksi','keterangan','bukti_pembayaran'];
}

