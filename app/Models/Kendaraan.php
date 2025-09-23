<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kendaraan extends Model
{
    protected $table = 'kendaraan';

    protected $fillable = ['kendaraan_id', 'customer_id', 'jenis_kendaraan', 'nomor_polisi', 'merek', 'tahun', 'image'];

}
