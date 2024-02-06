
@extends('main.main')

@section('sidebar')
@include('sidebar.sidebarBank')
@endsection

@section('container')
  
<div class="container">
  <div class="row">
    <h2>Pesan Isi Saldo</h2>
      @if (session()->has('success'))
          
      <div class="alert alert-success" role="alert">
        {{ session('success') }}
      </div>
      @endif
    <div class="table-responsive col-lg-10">
      </div>
        <table class="table table-striped table-sm">
          <thead>
            <tr>
              <th scope="col"class="text-center">No</th>
              <th scope="col"class="text-center">No Withdraw</th>
              <th scope="col"class="text-center">Nama</th>
              <th scope="col"class="text-center">Rekening</th>
              <th scope="col"class="text-center">Nominal</th>
              <th scope="col"class="text-center">Pesan</th>
              <th scope="col" class="text-center" >Aksi</th>
              
              
            </tr>
          </thead>
          <tbody>
            <?php $i= 1 ?>

            @foreach ($pesan as $msg)
            @if ($msg->status == 'menunggu')
            <tr>
              <td>{{ $i++ }}</td>
              <td class="text-center">{{ $msg->no_withdraw }}</td>
              <td class="text-center">{{ $msg->wallet->user->name }}</td>
              <td class="text-center">{{ $msg->wallet->rekening }}</td>
              <td class="text-center">Rp.{{ number_format($msg->nominal,0,'.','.')  }}</td>      
              <td class="text-center">{{ $msg->status }}</td>
              
              
              
                <form action="{{ route('terima.withdraw') }}" method="post">
                   <td class="container d-flex justify-content-center align-items-center gap-1">
                    <a href="/detail/topUp/{{ $msg->wallet->id }}" class="btn btn-warning  align-items-center"><span data-feather="edit"></span>detail</a>
                   
                  @csrf
                  <input type="hidden" name="idWithdraw" value="{{ $msg->id }}">
                  <input type="hidden" name="id" value="{{ $msg->wallet->id }}">
                  <input type="hidden" name="nominal" value="{{ $msg->nominal }}">
                  <button type="submit" class="btn btn-success ">Terima</button>
                </form>
                <form action="{{ route('ditolak.withdraw') }}" method="post">
                  @csrf
                  <input type="hidden" name="idWithdraw" value="{{ $msg->id }}">
                  <button type="submit" class="btn btn-danger">Ditolak</button>
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

@endsection
