<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;
    protected $guarder = [];
    public function  keranjang()
    {
        $this->hasMany(Keranjang::class, 'id_transaksi');
    }
    public function user()
    {
        $this->belongsTo(User::class, 'id_user');
    }
}
