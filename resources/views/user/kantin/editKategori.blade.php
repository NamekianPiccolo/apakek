@extends('main.main')
@section('container')
@include('sidebar.sidebarCanteen')
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 ">
    <h1 class="h2">Create new Kategori</h1>
  </div>
  <div class="col-lg-8">
  
    {{-- mengarah ke dashboardpostcontroller yang method nya store --}}
  <form method="post" action="/create/kategori/{{ $kategori->id }}" class="mb-5" >
    @csrf 
    @method('put')
    <div class="mb-3">
      <label for="nama_kategori" class="form-label">Nama kategori</label>
      <input type="text" class="form-control @error('nama_kategori') is-invalid @enderror" id="nama_kategori" name ="nama_kategori" autofocus  value="{{ old('nama_kategori',$kategori->nama_kategori) }}">
      @error('nama_kategori')
      <div class="invalid-feedback">
        {{ $message }}
      </div>    
      @enderror
    </div>
   
 
    <div class="d-flex justify-content-start">
        <button type="submit" class="btn btn-primary mb-5 mt-3 m-2">Create Categori</button>
        <a href="/create/kategori" class="btn btn-primary mb-5 mt-3">Kembali</a>
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