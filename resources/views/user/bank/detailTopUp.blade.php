
@extends('main.main')

@section('sidebar')
@include('sidebar.sidebarBank')
@endsection

@section('container')
  
<div class="container">
  <div class="row">
    <h2>Detail</h2>
    
    <div class="table-responsive col-lg-10">
      </div>
      <p>Nama : {{ $detail->wallet->user->name }}</p><br>
      <p>Saldo : {{ $detail->wallet->saldo }}</p><br>
      <p>Nominal Top UP :{{ $detail->nominal }}</p>
      <p>Kode Unik : {{ $detail->kodeUnik }}</p>
      <a href="{{ route('bank.index') }}" class="btn btn-warning">Kembali</a>
  </div>
  </div>
</div>

@endsection
