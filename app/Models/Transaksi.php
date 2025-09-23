<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Transaksi extends Model
{
    use HasFactory;

    protected $table = 'transaksi';
    protected $primaryKey = 'transaksi_id';
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = [
        'transaksi_id',
        'kendaraan_id',
        'keterangan_transaksi',
        'tanggal_transaksi',
        'total_harga',
    ];

}
