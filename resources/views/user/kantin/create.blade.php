@extends('main.main')
@section('container')
@include('sidebar.sidebarCanteen')
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 ">
    <h1 class="h2">Create new Post</h1>
  </div>
  <div class="col-lg-8">
    {{-- mengarah ke dashboardpostcontroller yang method nya store --}}
  <form method="post" action="/kantin/produk" class="mb-5" enctype="multipart/form-data">
    @csrf 
    <div class="mb-3">
      <label for="nama_produk" class="form-label">Nama produk</label>
      <input type="text" class="form-control @error('nama_produk') is-invalid @enderror" id="nama_produk" name ="nama_produk" autofocus  value="{{ old('nama_produk') }}">
      @error('nama_produk')
      <div class="invalid-feedback">
        {{ $message }}
      </div>    
      @enderror
    </div>
    <div class="mb-3">
      <label for="harga" class="form-label">harga</label>
      <input type="number" class="form-control @error('harga') is-invalid @enderror" id="harga" name ="harga"   value="{{ old('harga') }}">
      @error('harga')
      <div class="invalid-feedback">
        {{ $message }}
      </div>    
      @enderror
    </div>
    <div class="mb-3">
        <label for="stok" class="form-label">stok</label>
        <input type="number" class="form-control @error('stok') is-invalid @enderror" id="stok" name ="stok"   value="{{ old('stok') }}">
        @error('stok')
        <div class="invalid-feedback">
          {{ $message }}
        </div>    
        @enderror
      </div>
    <div class="mb-3">
      <label for="kategori" class="form-label">kategori</label>
      <select class="form-select" name="id_kategori" >
        @foreach ($kategoris as $kategori)
        @if (old('kategori_id' == $kategori->id))
            
        <option value="{{ $kategori->id }}" selected>{{ $kategori->nama_kategori }}</option>
        @else 
        <option value="{{ $kategori->id }}">{{ $kategori->nama_kategori }}</option>
        @endif
        @endforeach
      </select>
    </div>


    <div class="mb-3">
      <label for="img" class="form-label ">Foto Produk</label>
      <img class="img-preview img-fluid mb-3 col-sm-5">
      <input class="form-control @error('img') is-invalid @enderror" type="file" id="img" name="img" onchange="previewImage()">
      @error('img')
      <div class="invalid-feedback">
        {{ $message }}
      </div>    
      @enderror
    </div>
 

    <button type="submit" class="btn btn-primary mb-5 mt-3">Create Post</button>
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