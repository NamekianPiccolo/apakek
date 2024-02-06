<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Keranjang extends Model
{
    use HasFactory;
    protected $guarder = [];
    public function produk()
    {
        return $this->belongsTo(Produk::class,'id_produk');
    }
    public function user()
    {
        return $this->belongsTo(User::class,'id_user');
    }
    public function transaksi()
    {
        return $this->belongsTo(Transaksi::class,'id_transaksi');
    }
}
