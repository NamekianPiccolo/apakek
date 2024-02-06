
@extends('main.main')

@section('sidebar')
@include('sidebar.sidebarCanteen')
@endsection

@section('container')
  
<div class="container">
  <div class="row">
    <h2>Produk</h2>
      @if (session()->has('success'))
          
      <div class="alert alert-success" role="alert">
        {{ session('success') }}
      </div>
      @endif
    <div class="table-responsive col-lg-10">
    <a href="/kantin/produk/create" class="btn btn-primary mb-3">Create new produk</a>
      <div class="table-responsive">
      </div>
        <table class="table table-striped table-sm">
          <thead>
            <tr>
              <th scope="col">No</th>
              <th scope="col">Nama Produk</th>
              <th scope="col">Stok</th>
              <th scope="col">Harga</th>
              <th scope="col">Kategori</th>
              <th scope="col">Gambar</th>
            </tr>
          </thead>
          <tbody>
            <?php $i= 1 ?>

      @foreach ($produks as $produk)
            <tr>
              <td>{{ $i++ }}</td>
              <td>{{ $produk->nama_produk }}</td>
              <td>{{ $produk->stok }}</td>
              <td>Rp.{{ number_format($produk->harga, 0, '.', '.') }}</td>
              <td>{{ $produk->kategori->nama_kategori }}</td>
              <td><img src="{{ asset('storage/image/'.$produk->img) }}" alt="{{ 
              $produk->img }} " width="100"></td>
               <td>
                
                <a href="/kantin/produk/{{ $produk->id }}/edit" class="badge bg-warning nav-link"><span data-feather="edit"></span>Edit</a>
                <form action="/kantin/produk/{{ $produk->id }}" method="post" class="d-inline col-lg-10">
                  @method('delete')
                  @csrf
                  <button type="submit" class="badge bg-danger nav-link border-0" onclick="return confirm('Are you sure ?')">Delete<span data-feather="delete"></span></a></button>
               
              </form>
              </td>
              
            </tr>
            @endforeach
            
        </tbody>
      </table>
  </div>
  </div>
</div>
{{-- @else
<p class="text-center fs-4 ">No produk found</p>
  @endif --}}
@endsection
