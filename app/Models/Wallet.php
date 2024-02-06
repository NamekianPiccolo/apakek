<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\TopUp;

class Wallet extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function user()
    {
       return  $this->belongsTo(User::class,'id_user');   
    }
    public function TopUp()
    {
       return  $this->hasOne(TopUp::class,'id_saldo');
    }
}
