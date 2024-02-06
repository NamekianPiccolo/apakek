<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;
use App\Models\Kategori;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class KantinController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('user.kantin.kantin',[
            'aksi' => 'produk',
            'title' => 'Kantin',
            'name' => auth()->user()->name,
            'produks' => Produk::with('kategori')->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('user.kantin.create',[
            'aksi' => 'produk',
            'title' => 'Kantin',
            'name' => auth()->user()->name,
            'kategoris' => Kategori::all(),
            'produks' => Produk::with('kategori')->get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama_produk' => 'required|max:255',
            'id_kategori' => 'required',
            'harga' => 'required',
            'stok' => 'required',
            'img' => 'image|file|max:10000',
        ]);
        
        if($request->file('img')){
            $img = $request->file('img');
            $img->storeAs('image',$img->hashName());

            $validatedData['img'] = $request->file('img')->storeAs('image', Str::uuid().'jpg');
        }
        else{
            $img = 'Kosong';
        }
        Produk::create([
            'nama_produk' => $request->nama_produk,
            'id_kategori' => $request->id_kategori,
            'harga' => $request->harga,
            'stok' => $request->stok,
            'img' => $img->hashName()
        ]);
        return redirect('/kantin')->with('success','New Produk has been adden!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Produk $produk)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Produk $produk)
    {
        return view('user.kantin.edit' , [
            'title' => 'Edit Produk',
            'name' => auth()->user()->name,
            'aksi' => 'produk',
            'kategoris' => kategori::all(),
            'produk' => $produk
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Produk $produk)
    {
            $rules = [
               'nama_produk' => 'required|max:255',
               'id_kategori' => 'required',
               'img' => 'image|file|max:10000',
               'harga' => 'required',
               'stok' => 'required',    
           ];
           $validatedData = $request->validate($rules);
           if($request->file('img')) 
           {
               if($request->file('img')){
                   Storage::delete($request->oldImage);
                   $img = $request->file('img');
                   $img->storeAs('image',$img->hashName());
               }

           Produk::where('id' , $produk->id)
                 ->update([
                    'nama_produk' => $request->nama_produk,
                    'id_kategori' => $request->id_kategori,
                    'harga' => $request->harga,
                    'stok' => $request->stok,
                    'img' => $img->hashName()
                 ]);
           return redirect('/kantin')->with('success','New post has been updated!');
    }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Produk $produk)
    {
            if($produk->img){
                Storage::delete($produk->img);
            }
            
            Produk::destroy($produk->id);
            return redirect('/kantin')->with('success','fas');
        
    }
}
