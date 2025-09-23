<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pemasukkan extends Model
{
    protected $table = 'pemasukkan'; // Nama tabel yang benar

    protected $primaryKey = 'id_pemasukkan';

    protected $fillable = ['jumlah_pemasukkan', 'tanggal_pemasukkan', 'sumber', 'transaksi', 'kategori'];

}
