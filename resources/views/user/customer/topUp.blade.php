@extends('main.main')
@section('container')
@include('sidebar.sidebarCustomer')
 
  
  <div class="col-lg-8">
    
    <h1 class="h2" style=" margin-top: 30px">Top Up</h1>
    <hr>
    <h3 class="h5" style="margin-top: 80px">Saldo Anda : Rp.{{number_format($wallet->saldo, 0, '.', '.')}}</h5>
      @if (session()->has('success'))
      <div class="alert alert-success" role="alert">
        {{ session('success') }}
      </div>
      @endif
  
    {{-- mengarah ke dashboardpostcontroller yang method nya store --}}
  <form method="post" action="{{ route('topUp') }}" class="mb-5" >
    @csrf 
    <div class="mb-3">
      <label for="Rekening" class="form-label">Rekening </label>
      <input type="number" class="form-control @error('rekening') is-invalid @enderror" id="nominal" name ="rekening" autofocus  value="{{ old('rekeni') }}">
      <label for="saldo" class="form-label">Isi Saldo </label>
      <input type="number" class="form-control @error('nominal') is-invalid @enderror" id="nominal" name ="nominal" autofocus  value="{{ old('nominal') }}">
      @error('nominal')
      <div class="invalid-feedback">
        {{ $message }}
      </div>    
      @enderror
    </div>
   
 
    <div class="d-flex justify-content-start">
        <button type="submit" class="btn btn-primary mb-5 mt-3 m-2">Isi Saldo</button>
        <a href="/create/kategori" class="btn btn-primary mb-5 mt-3">Kembali</a>
    </div>
    
  </form>
  
</div>

  @endsection