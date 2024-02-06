
@extends('main.main')

@section('sidebar')
@include('sidebar.sidebarCustomer')
@endsection

@section('container')
  
<div class="container">
  <div class="row">
    <h1> Dashboard</h1>
    <div class="card" style="width: 20rem;">
      <div class="card-body">
        <h4 class="mb-3">Saldo : {{ $wallet->saldo }}</h4>
        <a href="{{ route('customer.topUp') }}" class="btn btn-warning">Top Up</a>
        <a href="{{ route('tampilWithDraw') }}" class="btn btn-success">WithDraw</a>
      </div>
    </div>
@endsection
