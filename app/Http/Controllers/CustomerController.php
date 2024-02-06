<?php

namespace App\Http\Controllers;
use App\Models\Produk;
use App\Models\Wallet;
use App\Models\Kategori;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index()
    {
        return view('user.customer.customer',[
            'title' => 'Customer',
            'aksi' => 'dashboard',
            'name' => auth()->user()->name,
            'wallet' => Wallet::where('id', auth()->user()->id)->first()
        ]);
    }
    public function produk()
    {
        return view('user.customer.produk',[
                'title' => 'Customer',
                'aksi' => 'produk',
                'name' => auth()->user()->name,
                'produks' => Produk::all()
        ]);
    }
}
