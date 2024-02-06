<?php

namespace App\Http\Controllers;
use App\Models\Produk;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function kantin()
    {
        return view('user.kantin.dashboard',[
            'title' => 'Kantin',
            'aksi' => 'dashboard',
            'name' => auth()->user()->name,
            'produks' => Produk::all()
        ]);
    }
}
