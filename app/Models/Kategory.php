<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategory extends Model
{
    use HasFactory;

    protected $table = 'kategori'; // Nama tabel yang benar

    protected $primaryKey = 'id_kategori';

    protected $fillable = [
        'jumlah_pengeluaran',
        'tanggal_pengeluaran',
        'kategori',
        'keterangan'
    ];
}
