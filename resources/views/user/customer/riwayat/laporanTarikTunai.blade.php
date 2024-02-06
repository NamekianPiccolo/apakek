
@extends('main.main')

@section('sidebar')
@include('sidebar.sidebarCustomer')
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
              <th scope="col" class="text-center" >Date</th>
              
              
            </tr>
          </thead>
          <tbody>
            <?php $i= 1 ?>

            @foreach ($pesan as $msg)
            @if ($msg->status == 'ditolak' || $msg->status == 'konfirmasi')
            <tr>
              <td>{{ $i++ }}</td>
              <td class="text-center">{{ $msg->no_withdraw }}</td>
              <td class="text-center">{{ $msg->wallet->user->name }}</td>
              <td class="text-center">{{ $msg->wallet->rekening }}</td>
              <td class="text-center">Rp.{{ number_format($msg->nominal,0,'.','.')  }}</td>      
              <td class="text-center">{{ $msg->status }}</td>
              
              
             
                <td class="text-center">{{ $msg->created_at }}</td>
              
            
                
              
              
              
              
              
            </tr>
            @endif
            @endforeach
            
        </tbody>
      </table>
  </div>
  </div>
</div>

@endsection
