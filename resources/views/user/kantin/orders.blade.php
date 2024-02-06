
@extends('main.main')

@section('sidebar')
@include('sidebar.sidebarCanteen')
@endsection

@section('container')
  
<div class="container">
  <div class="row">
    <h2>Orders</h2>
      @if (session()->has('success'))
          
      <div class="alert alert-success" role="alert">
        {{ session('success') }}
      </div>
      @endif
    <div class="table-responsive col-lg-10">
    <a href="/kantin/createmsg" class="btn btn-primary mb-3">Create new msg</a>
      <div class="table-responsive">
      </div>
        <table class="table table-striped table-sm">
          <thead>
            <tr>
              <th scope="col">No</th>
              <th scope="col">Kode Transaksi</th>
              <th scope="col">Total</th>
              <th scope="col">Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php $i= 1 ?>

      @foreach ($pesan as $msg)
      @if($msg->infoTransaksi == 'menunggu')
      
      <tr>
          <td>{{ $i++ }}</td>
          <td>{{ $msg->kode_transaksi }}</td>
          <td>{{ $msg->total }}</td>
          <form action="{{ route('konfirmasi') }}">
            <input type="hidden" name="total" value="{{ $msg->total }}">
                  <input type="hidden" name="id_user" value="{{ $msg->id_user }}">
                  <input type="hidden" name="id" value="{{ $msg->id }}">
               <td>
                    
                    <button type="submit" class="btn btn-success">Terima</button>
                </form>
                <form action="/create/msg/{{ $msg->id }}" method="post" class="d-inline col-lg-10">
                  @method('delete')
                  
                  @csrf
                  <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure ?')">tolak</button>
               
              </form>
              </td>
              
            </tr>
            @endif
            @endforeach
            
        </tbody>
      </table>
  </div>
  </div>
</div>
{{-- @else
<p class="text-center fs-4 ">No msg found</p>
  @endif --}}
@endsection
