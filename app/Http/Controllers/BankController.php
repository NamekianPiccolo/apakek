<?php

namespace App\Http\Controllers;

use App\Models\Wallet;
use Illuminate\Http\Request;
use App\Models\TopUp;
use App\Models\Withdraw;

class BankController extends Controller
{
    public function index()
    {

        $pesan = TopUp::with(['wallet.user'])->get();
        return view('user.bank.bank',[
            'aksi' => 'bank',
            'title' => 'Bank',
            'name' => auth()->user()->name,
            'pesan' => $pesan
        ]);
    } 
    public function detail($id){
        return view('user.bank.detailTopUp',[
            'aksi' => 'bank',
            'title' => 'Bank',
            'name' => auth()->user()->name,
            'detail' => TopUp::with(['wallet.user'])->where('id' , $id)->first()
        ]);
    }
    public function isiSaldo(Request $request)
{
    // Lakukan proses konfirmasi, misalnya:
    $topUp = TopUp::find($request->idTopUp);
    $wallet = Wallet::find($request->id);
    $topUp->status = 'konfirmasi';
    $wallet->saldo += $request->nominal;
    $wallet->save();
    $topUp->save();

    // Proses lainnya (mungkin memberikan pemberitahuan atau yang lainnya)

    return redirect()->route('bank.index')->with('success', 'Konfirmasi Permintaan saldo  berhasil.');
}
public function ditolak(Request $request){
    $topUp = TopUp::find($request->idTopUp);
    $topUp->status = 'ditolak';
    $topUp->save();
    return redirect()->route('bank.index')->with('success', ' Permaintaan saldo berhasil Ditolak.');
}
public function laporanTopUp(Request $request){
        return view('user.bank.riwayat.laporanTopUp',[
            'aksi' => 'laporanTopUp',
            'title' => 'Bank',
            'name' => auth()->user()->name,
            'pesan' => TopUp::all()
        ]);
}




public function bankWithdraw()
{

    $pesan = Withdraw::all();
    return view('user.bank.withdraw.withdraw',[
        'aksi' => 'withdraw',
        'title' => 'Bank',
        'name' => auth()->user()->name,
        'pesan' => $pesan
    ]);
} 
public function detailWithdraw($id){
    return view('user.bank.detailTopUp',[
        'aksi' => 'withdraw',
        'title' => 'Bank',
        'name' => auth()->user()->name,
        'detail' => Withdraw::with(['wallet.user'])->where('id' , $id)->first()
    ]);
}
public function withdraw(Request $request)
{
    // Lakukan proses konfirmasi, misalnya:
    $withdraw = Withdraw::find($request->idWithdraw);
    $wallet = Wallet::find($request->id);
    $withdraw->status = 'konfirmasi';
    $wallet->saldo -= $request->nominal;
    $wallet->save();
    $withdraw->save();

    // Proses lainnya (mungkin memberikan pemberitahuan atau yang lainnya)

    return redirect()->route('bank.withdraw')->with('success', 'Konfirmasi permintaan Withdraw Berhasil.');
}
public function ditolakWithdraw(Request $request){
    $withdraw = Withdraw::find($request->idWithdraw);
    $withdraw->status = 'ditolak';
    $withdraw->save();
    return redirect()->route('bank.withdraw')->with('success', 'Konfirmasi permintaan Withdraw berhasil Ditolak.');
}

public function laporanWithdraw(Request $request){
    return view('user.bank.riwayat.laporanWithdraw',[
        'aksi' => 'laporanTopUp',
        'title' => 'Bank',
        'name' => auth()->user()->name,
        'pesan' => TopUp::all()
    ]);
}


}
