<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengumuman extends Model
{
    use HasFactory;

    protected $table = 'pengumuman'; // Nama tabel yang benar

    protected $primaryKey = 'id_pengumuman';

    protected $fillable = ['id_pengumuman','judul', 'isi', 'tanggal_dibuat', 'id'];

    public function users()
    {
        return $this->belongsTo(User::class, 'id');
    }
}
