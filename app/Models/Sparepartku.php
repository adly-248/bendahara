<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Sparepartku extends Model
{
    //use HasFactory;
    protected $table = 'sparepart'; // Nama tabel yang benar

    protected $fillable = ['sparepart_id', 'nama_sparepart','harga', 'stok','kategori_id','image',];

}
