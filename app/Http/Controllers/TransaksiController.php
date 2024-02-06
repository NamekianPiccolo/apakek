<?php

namespace App\Http\Controllers;

use App\Models\Keranjang;
use Illuminate\Http\Request;
use App\Models\Transaksi;
use App\Models\Wallet;
use App\Models\User;
use App\Models\Produk;
class TransaksiController extends Controller
{
    public function transaksi(Request $request)
    {
        $wallet = Wallet::where('id', $request->id_wallet)->first();
        if(!$request->id_keranjang ) {
            return redirect('/customer/keranjang')->with('success','tidak ada produk dibeli');
        }
        else if($request->total > $wallet->saldo) {
            return redirect('/customer/keranjang')->with('success','Saldo tidak cukup');
        }
        $keranjangs = Keranjang::where('id_transaksi', $request->id_transaksi)->get();
        // $transaksi = Transaksi::where('id', $request->id_transaksi)->first();
        foreach ($keranjangs as  $keranjang) {
           $perItem = Keranjang::where('id',$keranjang->id)->first();
           $perItem->info = 'menunggu';
           $perItem->save();
        }
        
            $cekKeranjang = Keranjang::where('id',$request->id_keranjang)->first();
            $transaksi = Transaksi::where('id',$cekKeranjang->id_transaksi)->first();
            $transaksi->total = $request->total;
            $transaksi->infoTransaksi = 'menunggu';
            $transaksi->save();
        
        return redirect("/invoice/$transaksi->no_transaksi")->with('success','Pembayaran Berhasil Menunggu pembayaran' );
    //     return redirect("/invoice/$transaksi->no_transaksi")->with('success','berhasil Membayar menunggu Konfirmasi');
    }
    public function orders()
    {
        return view('user.kantin.orders' ,[
            'title' => 'Kantin',
            'aksi' => 'orders',
            'name' => auth()->user()->name,
            'pesan' => Transaksi::all()
        ]);  
    }
    public function konfirmasi( Request $request)
    {
        $keranjangs = Keranjang::where('id_user', $request->id_user)->get();
        foreach ($keranjangs as $keranjang) {
            $keranjang->info = 'transaksiBerhasil';
            $produk = Produk::where('id' , $keranjang->id_produk)->first();
            $produk->stok -= $keranjang->dibeliTotal;
            $produk->save();
            $keranjang->save();
        }
        $wallet = Wallet::where('id',$request->id_user)->first();
        $wallet->saldo -= $request->total;
        $wallet->save();
        return redirect()->route('orders')->with('success','Pembayaran berhasil dikonfirmasi');


    }
    public function invoice($no_transaksi)
    {
        $transaksi = Transaksi::where('no_transaksi',$no_transaksi)->first();
        if(!$no_transaksi){
            return view('user.customer.keranjang');
        }
        else {

            return view('user.customer.invoice',[
                'keranjangs' => Keranjang::where('id_user', auth()->user()->id)->where('id_transaksi',$transaksi->id)->get(),
                'aksi' => 'keranjang',
                'title' => 'Customer',
                'kantin' => User::where('role','kantin')->first(),
                'invoice' => Transaksi::where('no_transaksi',$no_transaksi)->first(),
                'name' => auth()->user()->name            
            ]);
        }
    }
    public function cetak($no_transaksi)
    {
        $transaksi = Transaksi::where('no_transaksi',$no_transaksi)->first();
        if(!$no_transaksi){
            return view('user.customer.keranjang');
        }
        else {

            return view('user.customer.cetak',[
                'keranjangs' => Keranjang::where('id_user', auth()->user()->id)->where('id_transaksi',$transaksi->id)->get(),
                'aksi' => 'keranjang',
                'title' => 'Customer',
                'kantin' => User::where('role','kantin')->first(),
                'invoice' => Transaksi::where('no_transaksi',$no_transaksi)->first(),
                'name' => auth()->user()->name            
            ]);
        }
    }
    public function laporanTransaksiCustomer()
    {
     return view('user.customer.riwayat.laporanTransaksi',[
         'aksi' => 'laporanWithdraw',
         'title' => 'Customer',
         'name' => auth()->user()->name,
         'pesan' => Transaksi::where('id_user',auth()->user()->id)->get(),
 
     ]);
    }
}
