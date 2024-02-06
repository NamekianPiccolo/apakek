
@extends('main.main')

@section('sidebar')
@include('sidebar.sidebarCanteen')
@endsection

@section('container')
  
<div class="container">
  <div class="row">
    <h2>Kategori</h2>
      @if (session()->has('success'))
          
      <div class="alert alert-success" role="alert">
        {{ session('success') }}
      </div>
      @endif
    <div class="table-responsive col-lg-10">
    <a href="/create/kategori/create" class="btn btn-primary mb-3">Create new Kategori</a>
      <div class="table-responsive">
      </div>
        <table class="table table-striped table-sm">
          <thead>
            <tr>
              <th scope="col">No</th>
              <th scope="col">Nama Kategori</th>
            </tr>
          </thead>
          <tbody>
            <?php $i= 1 ?>

      @foreach ($kategoris as $kategori)
            <tr>
              <td>{{ $i++ }}</td>
              <td>{{ $kategori->nama_kategori }}</td>
                
                <td>
                    <a href="/create/kategori/{{ $kategori->id }}/edit" class="badge bg-warning nav-link"><span data-feather="edit"></span>Edit</a>
                    <form action="/create/kategori/{{ $kategori->id }}" method="post" class="d-inline col-lg-10">
                        @method('delete')
                        
                        @csrf
                        <button type="submit" class="badge bg-danger nav-link border-0" onclick="return confirm('Are you sure ?')">Delete<span data-feather="delete"></span></a></button>
                    </td>
               
              </form>
              </td>
              
            </tr>
            @endforeach
            
        </tbody>
      </table>
  </div>
  </div>
</div>

@endsection
