<?php

use GuzzleHttp\Middleware;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BankController;
use App\Http\Controllers\TopUpController;
use App\Http\Controllers\KantinController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KeranjangController;
use App\Http\Controllers\TransaksiController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
// login 
Route::get('/',[AuthController::class , 'index'])->middleware('guest');
Route::post('/login',[AuthController::class, 'login']); 
Route::post('/logout',[AuthController::class, 'logout'])->name('logout');

// customer
Route::middleware(['auth','akses:customer'])->group(function(){

    Route::get('/customer/dashboard',[CustomerController::class, 'index'])->name('customer.index');
    Route::get('customer/topUp/tampil', [TopUpController::class,'index'])->name('customer.topUp');
    Route::get('/customer/produk', [CustomerController::class,'produk'])->name('customer.produk');
    Route::post('/customer/topUp', [TopUpController::class,'kirimNominalKeBank'])->name('topUp');
    Route::resource('/customer/keranjang', KeranjangController::class);
    Route::post('/customer/transaksi' , [TransaksiController::class, 'transaksi'])->name('customer.transaksi');
    Route::get('/invoice/{no_transaksi}',[TransaksiController::class,'invoice']);
    Route::get('/cetak/{no_transaksi}',[TransaksiController::class,'cetak']);
    Route::get('/tampilWithDraw',[TopUpController::class,'tampilTarikTunai'])->name('tampilWithDraw');
    Route::post('/WithDraw',[TopUpController::class,'withdraw'])->name('customer.withdraw');
    
});
    
//Kantin
Route::middleware(['auth','akses:kantin'])->group(function(){
Route::get('/kantin',[KantinController::class, 'index'])->name('kantin.index');
Route::resource('/kantin/produk',KantinController::class);
Route::resource('/kantin/Kategori',KategoriController::class);
Route::get('/create/kategori',[KategoriController::class,'index'])->name('kategori');
Route::get('/orders',[TransaksiController::class,'orders'])->name('orders');
Route::get('/konfirmasi',[TransaksiController::class,'konfirmasi'])->name('konfirmasi');
Route::get('/kantin/dashboard',[DashboardController::class,'kantin'])->name('kantin.dashboard');

});


//Bank Top up
Route::middleware(['auth','akses:bank'])->group(function(){
Route::get('/bank',[BankController::class, 'index'])->name('bank.index');
Route::get('/detail/topUp/{id}',[BankController::class, 'detail'])->name('detail.topUp');
Route::post('/terima',[BankController::class, 'isiSaldo'])->name('terima');
Route::post('/ditolak',[BankController::class, 'ditolak'])->name('ditolak');
Route::get('laporan/topUp',[BankController::class, 'laporanTopUp'])->name('laporanTopUp');

// bank Withdraw
Route::get('/bank/withdraw',[BankController::class, 'bankWithdraw'])->name('bank.withdraw');
Route::get('/detail/withdraw/{id}',[BankController::class, 'detailWithdraw'])->name('detail.withdraw');
Route::post('/terima/withdraw',[BankController::class, 'withdraw'])->name('terima.withdraw');
Route::post('/ditolak/withdraw',[BankController::class, 'ditolakWithdraw'])->name('ditolak.withdraw');
Route::get('laporan/withdraw',[BankController::class, 'laporanWithdraw'])->name('laporanWithdraw');


});
