@extends('main.main')
@section('container')
@include('sidebar.sidebarCanteen')
 
    <h1 class="h2">Edit Produk</h1>
  <div class="col-lg-8">
  <form method="post" action="/kantin/produk/{{ $produk->id }}" class="mb-5" enctype="multipart/form-data">
    @csrf 
    @method('put')
    <div class="mb-3">
      <label for="nama_produk" class="form-label">Nama Produk</label>
      <input type="text" class="form-control @error('nama_produk') is-invalid @enderror" id="nama_produk" name ="nama_produk" autofocus  value="{{ old('nama_produk',$produk->nama_produk) }}">
      @error('nama_produk')
      <div class="invalid-feedback">
        {{ $message }}
      </div>    
      @enderror
    </div>
    <div class="mb-3">
      <label for="harga" class="form-label">Harga</label>
      <input type="number" class="form-control @error('harga') is-invalid @enderror" id="harga" name ="harga"  required  value="{{ old('harga',$produk->harga) }}">
      @error('harga')
      <div class="invalid-feedback">
        {{ $message }}
      </div>    
      @enderror
    </div>
    <div class="mb-3">
        <label for="stok" class="form-label">Stok</label>
        <input type="number" class="form-control @error('stok') is-invalid @enderror" id="stok" name ="stok"  required  value="{{ old('stok',$produk->stok) }}">
        @error('stok')
        <div class="invalid-feedback">
          {{ $message }}
        </div>    
        @enderror
      </div>
    <div class="mb-3">
      <label for="kategori" class="form-label">Kategori</label>
      <select class="form-select" name="id_kategori" >
        @foreach ($kategoris as $kategori)
        @if (old('id_kategori', $produk->id_kategori) == $kategori->id)
            
        <option value="{{ $kategori->id }}" selected>{{ $kategori->nama_kategori }}</option>
        @else 
        <option value="{{ $kategori->id }}">{{ $kategori->nama_kategori }}</option>
        @endif
        @endforeach
      </select>
    </div>


    <div class="mb-3">
      <label for="img" class="form-label ">Foto Produk</label>
      @if ($produk->img)
      <input type="hidden" name="oldImage" value="{{ $produk->img }}">
       <img src="{{ asset('storage/'. $produk->img) }}" class="img-preview img-fluid mb-3 col-sm-5 d-block" >
      @else
      <img class="img-preview img-fluid mb-3 col-sm-5">
      @endif
      <input class="form-control @error('img') is-invalid @enderror" type="file" id="img" name="img" onchange="previewImage()">
      @error('img')
      <div class="invalid-feedback">
        {{ $message }}
      </div>    
      @enderror
    </div>
    <div class="d-flex justify-content-start">
        <button type="submit" class="btn btn-primary mb-5 mt-3 m-2">Simpan Produk</button>
        <a href="/canteen" class="btn btn-primary mb-5 mt-3">Kembali</a>
    </div>
  </form>
  



   
  
  </div>
  <script>
    
    function previewImage(){
    const image = document.querySelector('#img')
    const imgPreview = document.querySelector('.img-preview')

    imgPreview.style.display = 'block';

    const oFReader = new FileReader();
    oFReader.readAsDataURL(image.files[0]);
    oFReader.onload = function(oFREvent) {
      imgPreview.src = oFREvent.target.result;
    }
}
  </script>
  @endsection