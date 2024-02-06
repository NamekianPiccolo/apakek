
@extends('main.mainInvoice')

@section('sidebar')
@include('sidebar.sidebarCustomer')
@endsection

@section('container')
  

<div class="invoice">
    <div class="header">
        <h1>Invoice</h1>
    </div>
    <div class="info">
        <p><strong>From:</strong>{{ auth()->user()->name }}</p>
        <p><strong>To:</strong> {{  $kantin->name  }}</p>
        <p><strong>Date:</strong> {{ $invoice->created_at }}</p>
        <p><strong>No Transaksi :</strong> {{ $invoice->no_transaksi }}</p>
    </div>
    <div class="items">
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Produk</th>
                    <th>Unit</th>
                    <th>Dibeli</th> 
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach($keranjangs as $keranjang)
                <tr>
                    <td>{{ $keranjang->no_keranjang }}</td>
                    <td>{{ $keranjang->produk->nama_produk }}</td>
                    <td>{{ $keranjang->produk->stok }}</td>
                    <td>{{ $keranjang->dibeliTotal }}</td>
                    <td>Rp.{{ number_format($keranjang->nominal,0,'.','.') }}</td>
                    
                    @endforeach
                </tr>
            </tbody>
        </table>
    </div>
    <div class="total">
        <p><strong>Total Keseluruhan:</strong> Rp.{{ number_format($invoice->total,0,'.','.') }}</p>
    </div>
    <div class="footer">
    <a href="/cetak/{{ $invoice->no_transaksi }}" class="cetak btn btn-warning">Cetak Invoice</button>
        <a href="/customer/keranjang" class="btn btn-danger">Kembali</a>
    </div>
</div>

@endsection
