<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function index()
    {
        return view('login');
    }
    public function login(Request $request)
    {

    $validated = $request->validate([
        'email' => 'required|email',
        'password' => 'required'
    ]);
    if(Auth::attempt($validated))
    {
        if(Auth::user()->role == 'customer')
        {
            $request->session()->regenerate();
            return redirect()->route('customer.index');
        }
        else if(Auth::user()->role == 'kantin')
        {
            return redirect()->route('kantin.index');
        }
        else if(Auth::user()->role == 'bank')
        {
            return redirect()->route('bank.index');
        }
    }
    else {
        return redirect('/')->withErrors('error','gagal login');
    }

}

    public function logout(Request $request) 
    {
        Auth::logout();
        $request->session()->flush();
        $request->session()->invalidate(); // menghapus semua session yang ada 
        $request->session()->regenerateToken(); // membuat ulang csrf nya menjadi awal lagi 
        return redirect('/'); // 
    }

      
}
