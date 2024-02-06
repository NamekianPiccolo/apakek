<?php

namespace App\Http\Controllers;

use App\Models\Keranjang;
use App\Models\Transaksi;
use App\Models\Produk;
use Illuminate\Http\Request;
use App\Http\Requests\UpdateKeranjangRequest;
use Illuminate\Support\Facades\Storage;

class KeranjangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('user.customer.keranjang',[
            'title' => 'Customer',
            'aksi' => 'cart',
            'name' => auth()->user()->name,
            'keranjangs' => Keranjang::where('id_user',auth()->user()->id)->with('produk')->get(),
            'id_transaksi' => Keranjang::where('id_user',auth()->user()->id)->where('info','belumDibeli')->first()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $keranjang_sama = Keranjang::where('id_user',$request->id_user)->where('id_produk',$request->id_produk)->where('info','belumDibeli')->first();
        $cekKeranjang = Keranjang::where('info','belumDibeli')->first();
        if($keranjang_sama && $keranjang_sama->info == 'belumDibeli'){
            $keranjang_sama->dibeliTotal += $request->dibeliTotal ;
            $cekProduk = Produk::where('id',$keranjang_sama->id_produk)->first();
            if($keranjang_sama->dibeliTotal > $cekProduk->stok ){
    
                return redirect()->route('customer.produk')->with('success','yang dibeli dari produk sudah maksimal');
            }
            $keranjang_sama->nominal = $keranjang_sama->produk->harga*$keranjang_sama->dibeliTotal;
            $keranjang_sama->save();
            return redirect()->route('customer.produk')->with('success','berhasil ditambahkan keranjang');
        }
        else if(!$cekKeranjang ){
            $cekTransaksi = Transaksi::latest()->first();
            if(!$cekTransaksi){
                $i = 0;
            }else{
            $i = $cekTransaksi->id;
            }
        $transaksi = new Transaksi();
        $transaksi->id_wallet = auth()->user()->id;
        $transaksi->id_user = auth()->user()->id;
        $transaksi->infoTransaksi = 'menunggu';
        $transaksi->total =0;
        $transaksi->no_transaksi = 'ID00000'.$i+1;
        $transaksi->save();
        $keranjangCek = Keranjang::latest()->first();
       
        if(!$keranjangCek){
            $e = 0;
        }else{
        $e = $keranjangCek->id;
        }
        $keranjang = new Keranjang();
        $keranjang->no_keranjang = 'ID00000'.$e+1;
        $keranjang->id_user = $request->id_user;
        $keranjang->id_produk = $request->id_produk;
        $keranjang->dibeliTotal = $request->dibeliTotal;
        $cekProduk = Produk::where('id',$keranjang->id_produk)->first();
        if($keranjang->dibeliTotal > $cekProduk->stok ){

            return redirect()->route('customer.produk')->with('success','yang dibeli dari produk sudah maksimal');
        }
        $keranjang->id_transaksi =$transaksi->id;
        $keranjang->nominal = $request->dibeliTotal * $keranjang->produk->harga;
        $keranjang->save();
    }
    else if($cekKeranjang->info == 'belumDibeli' && $cekKeranjang->id_produk != $request->id_produk){
        $keranjangCek = Keranjang::latest()->first();
        if(!$keranjangCek){
            $h = 0;
        }else{
        $h = $keranjangCek->id;
        }
    $keranjang = new Keranjang();
    $keranjang->id_user = $request->id_user;
    $keranjang->no_keranjang = 'ID00000'.$h+1;
    $keranjang->id_produk = $request->id_produk;
    $keranjang->dibeliTotal = $request->dibeliTotal;
    $keranjang->id_transaksi = $cekKeranjang->id_transaksi;
    $keranjang->nominal = $request->dibeliTotal * $keranjang->produk->harga;
    $keranjang->save();
    }

        return redirect()->route('customer.produk')->with('success','Produk Berhasil Ditambahkan Keranjang');
       
    }

    /**
     * Display the specified resource.
     */
    public function show(Keranjang $keranjang)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Keranjang $keranjang)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateKeranjangRequest $request, Keranjang $keranjang)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Keranjang $keranjang)
    {
        if($keranjang->img){
            Storage::delete($keranjang->img);
        }
        
        Keranjang::destroy($keranjang->id);
        return redirect('/customer/keranjang')->with('success',' Produk has been deleted!');
    }
}
