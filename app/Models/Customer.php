<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Customer extends Model
{
    //use HasFactory;
    protected $table = 'customers'; // Nama tabel yang benar
    protected $fillable = ['customer_id', 'username','password', 'nama_customer','no_telp', 'email',];
}
