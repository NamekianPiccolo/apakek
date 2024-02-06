<?php

namespace App\Http\Controllers;

use App\Models\Wallet;
use Illuminate\Http\Request;
use App\Models\TopUp;
use App\Models\Withdraw;
use Illuminate\Support\Str;
class TopUpController extends Controller
{
    public function index()
    {
        return view('user.customer.topUp',[
            'aksi' => 'topUp',
            'title' => 'Customer',
            'name' => auth()->user()->name,
            'wallet' => Wallet::where('id',auth()->user()->id)->first()

        ]);
    }
    public function kirimNominalKeBank(Request $request)
    {
            // Validasi dan proses lainnya
            $a = TopUp::latest()->first();
            if(!$a){
                $i = 0;
            }
            else{
                $i= $a->id;
            }
            $request->validate([
                'rekening' => 'required',
                'nominal' => 'required'
            ]);
            $rekening = Wallet::where('rekening',$request->rekening)->first();
            $saldo = new TopUp();
            $saldo->no_topup = "ID000000".$i+1;
            $saldo->nominal = $request->nominal;
            $saldo->id_saldo = $rekening->id;
            $saldo->status = 'menunggu';
            $saldo->save();

            // Proses lainnya (mungkin mengirim pemberitahuan atau yang lainnya)

            return redirect()->route('customer.topUp')->with('success', 'Permintaan Saldo berhasil dikirim, menunggu konfirmasi...');
    }
    public function tampilTarikTunai()
    {
        return view('user.customer.tarikTunai',[
            'aksi' => 'withdraw',
            'title' => 'Customer',
            'name' => auth()->user()->name,
            'wallet' => Wallet::where('id_user',auth()->user()->id)->first(),

        ]);
    }  
    public function withDraw(Request $request)
    {
        $j = WithDraw::latest()->first();
            if(!$j){
                $k = 0;
            }
            else{
                $k= $j->id;
            }
        $rekening = Wallet::where('rekening',$request->rekening)->first();
        $withdraw = new Withdraw();
        $withdraw->no_withdraw = "ID000000".$k+1;
        $withdraw->nominal = $request->nominal;
        $withdraw->id_saldo = $rekening->id;
        $withdraw->status = 'menunggu';
        $withdraw->save();

        // Proses lainnya (mungkin mengirim pemberitahuan atau yang lainnya)

        return redirect()->route('tampilWithDraw')->with('success', ' Permintaan Withdraw berhasil dikirim, menunggu konfirmasi...');
}   

   public function laporanTopUpCustomer()
   {
    return view('user.customer.riwayat.laporanTopUp',[
        'aksi' => 'laporanTopUp',
        'title' => 'Customer',
        'name' => auth()->user()->name,
        'pesan' => TopUp::where('id_saldo',auth()->user()->id)->get(),

    ]);
   }
   public function laporanWithdrawCustomer()
   {
    return view('user.customer.riwayat.laporanTarikTunai',[
        'aksi' => 'laporanWithdraw',
        'title' => 'Customer',
        'name' => auth()->user()->name,
        'pesan' => Withdraw::where('id_saldo',auth()->user()->id)->get(),

    ]);
   }
  
    }



