
@extends('main.main')

@section('sidebar')
@include('sidebar.sidebarcustomer')
@endsection

@section('container')
  
  <div class="row">
    <h1>Keranjang</h1>
    <hr>
    @if (session()->has('success'))
        
    <div class="alert alert-success" role="alert">
      {{ session('success') }}
    </div>
    @endif

    <div class="table-responsive col-lg-10">
      <div class="table-responsive">
      </div>
        <table class="table table-striped table-sm">
          <thead>
            <tr>
              <th scope="col">No</th>
              <th scope="col">Nama Produk</th>
              <th scope="col">Gambar</th>
              <th scope="col">Harga</th>
              <th scope="col">dibeli</th>
              <th scope="col">Total </th>
              <th scope="col">Info</th>
              <th scope="col">stok</th>
              <th scope="col">Aksi</th>
            </tr>
          </thead>
          <tbody>
            @php 
            $i= 1;
            $totalSeluruh = 0;
          
        @endphp

@foreach ($keranjangs as $key => $keranjang)
@if ($keranjang->info == 'belumDibeli' )
    
<tr>
  <td>{{ $i++ }}</td>
  <td>{{ $keranjang->produk->nama_produk }}</td>
    <td><img src="{{ asset('storage/image/'.$keranjang->produk->img) }}" alt="{{ $keranjang->img }}" width="100"></td>
    <td>Rp.{{number_format($keranjang->produk->harga, 0, '.', '.')  }}</td>
    <td>
   {{ $keranjang->dibeliTotal}}</td>
    <td>
        Rp.{{ number_format( $keranjang->nominal , 0, '.', '.')  }}
      @php
    $totalSeluruh += $keranjang->nominal;
    @endphp
    </td>
    <td>
      {{ $keranjang->info }}
    </td>
    <td>{{ $keranjang->produk->stok }}</td>
  <td>
    @if ($keranjang->info == 'belumDibeli')
        
    <form action="/customer/keranjang/{{ $keranjang->id }}" method="post" class="d-inline col-lg-10">
      @method('delete')
      @csrf
      <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ?')">Delete</button>
    </form>
    @endif
  </td>
</tr>
<input type="hidden" class="total" value="{{ $totalSeluruh }}">

@endif
@endforeach
<tr>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td> Total Rp.{{number_format($totalSeluruh, 0, '.', '.') }}</td>
    <form action="{{ route('customer.transaksi') }}" method="post">
      @csrf
      <input type="hidden" name="id_wallet"  value="{{ auth()->user()->id}}">
      @foreach( $keranjangs as $keranjang)
      <input type="hidden" name="id_keranjang[]"  value="{{ $keranjang->id }}">
      @endforeach

      @if($id_transaksi)
      <input type="number" name="id_transaksi"  value="{{ $id_transaksi->id_transaksi }}">
      @endif
      <input type="hidden" name="total"  value="{{ $totalSeluruh }}">
      <td> <button type="submit" class="btn btn-success"> Beli</button></td>
  </form>
  <td></td>
    

  </tr>




</tbody>
</table>
</div>
</div>


 {{-- @else
  // <p class="text-center fs-4 ">No keranjang found</p>
   --}}
  
{{-- //   @endif --}} 
@endsection
