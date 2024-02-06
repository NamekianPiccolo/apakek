<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Wallet;

class Bank extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function wallets()
    {
        return $this->hasMany(Wallet::class,'id_saldo');
    }
}
