@extends('layout.dashboard.main')
@section('content')
   
  
  
  <div class="table-responsive col-lg-8 mx-5 mt-4">
    {{-- <a href="/dashboard/product/create" class="btn btn-primary mb-3">Tambah Petugas</a> --}}
    <table class="table table-striped table-sm">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Data Petugas</h1>
      </div>
        @if (session()->has('success'))
      <div class="alert alert-success col-lg-12" role="alert">
        {{ session('success') }}
      </div>
      @endif
      <thead>
        <tr>
          <th scope="col">No.</th>
          <th scope="col">Name</th>
          <th scope="col">Email</th>
          <th scope="col">Phone</th>
          <th scope="col">Action</th>
        </tr>
      </thead>
      <tbody>
        @php
          $count = 1; 
        @endphp
        @foreach ($user as $u)
          @if($u->role == 'petugas')
          <tr>
            <td>{{ $count }}</td> <!-- Display the incrementing number -->
                @php
                    $count++; // Increment the counter
                @endphp
            <td>{{ $u->name }}</td>
            <td>{{ $u->email }}</td>
            <td>{{ $u->phone }}</td>
            <td>
              <a href="/admin/petugas/{{ $u->id }}" class="badge bg-info" style="text-decoration: none;">Show</a>
              <a href="/admin/petugas/{{ $u->id }}/edit" class="badge bg-warning" style="text-decoration: none;">Edit</a>
              <form action="/admin/petugas/{{ $u->id }}" method="post" class="d-inline">
                @method('delete')
                @csrf
                <button class="badge bg-danger border-0" onclick="return confirm('Apakah anda yakin?')" >Delete</button>
              </form>
            </td>
          </tr>
          @endif
        @endforeach    
      </tbody>
    </table>
    <div class="d-flex justify-content-center">
      {{ $user->links() }}
    </div>
  </div>

@endsection