
@extends('main.main')

@section('sidebar')
@include('sidebar.sidebarCustomer')
@endsection

@section('container')
  
<div class="container border-0">
 
  <div class="row">
    <h1>Produk</h1>
    <hr>
    @if (session()->has('success'))
        
    <div class="alert alert-success" role="alert">
      {{ session('success') }}
    </div>
    @endif
      @foreach ($produks as $key => $produk)
      <div class="col-md-4 mt-4 mb-5" >
          <div class="card" style="height: 350px;" >
           
            {{-- @if($produk->image)
            {{-- <div style="max-height: 350px; overflow:hidden">
        
                <img src="{{ asset('storage/'. $produks->image) }}"class="card-img-top" width="2000">
            </div> --}}
            {{-- @else --}} 
            <img src="{{ asset('storage/image/'.$produk->img)}}" class="card-img-top" alt="...">
            {{-- @endif --}}
              <div class="card-body">
                <h5 class="card-title">{{ $produk->nama_produk }}</h5>
                 {{-- ketika link diklik akan mengirim kan url diatas yang berupa slug nya  --}}
                <p>
                  {{-- ketika link diklik akan mengirim kan url diatas yang berupa slug nya  --}}
                          {{-- diffForHumans() intinya jika ada waktu tertentu bisa dijadikan satuan jam dari jam dibuat sampai sekarang --}}
               </p>
                <p class="card-text"> Harga: Rp.{{ number_format($produk->harga,0,'.','.' ) }} <br>
                  Stok: {{ $produk->stok }} </p>
                  <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addToCart-{{ $produk->id }}">
                    Buy
                  </button>
              </div>
              
              <p><a href="/produks?category="  style="position: absolute; bottom: 0; right: 1;" ></a></p>
              </div>
            </div>
            @endforeach 
            @foreach ($produks as $produk)
                
            <div class="modal fade" id="addToCart-{{ $produk->id }}" tabindex="-1" aria-labelledby="addToCartLabel" aria-hidden="true">
                <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h1 class="modal-title fs-5" id="addToCartLabel">Masukkan Keranjang</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div> 
                  <div class="modal-body">
                    <form action="/customer/keranjang " method="post">
                      @csrf                       
                      <label for="dibeliTotal" class="form-label">Beli</label>
                      <input type="number" name="dibeliTotal" id="dibeliTotal" class="form-control">
                        <input type="hidden" name="id_produk" id="id_produk" class="form-control" value="{{ $produk->id }}">
                            <div class="card-body border">
                        <input type="hidden" name="id_user" id="id_user" class="form-control" value="{{ auth()->user()->id }}">
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">beli</button>
                      </form>
                  </div>
                </div>
              </div>
            </div>
              </div>
            </div>
        </div>  
        @endforeach
          <!-- Button trigger modal -->


<!-- Modal -->
{{-- @else
<p class="text-center fs-4 ">No produk found</p>
  @endif --}}
@endsection
