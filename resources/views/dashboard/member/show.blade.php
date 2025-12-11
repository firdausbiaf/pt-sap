@extends('layout.dashboard.main')

@section('content')
  
<div class="container my-5">
    <div class="row justify-content-center align-items-center">
        <div class="card"  style="width: 30rem;">
            @if ($user->photo == null)
                
            @else
                <img src="{{ asset('storage/' . $user->photo) }}" class="card-img-top" alt="{{ $user->name }}">
            @endif
            
            <div class="card-header ">
              Detail  Member
            </div>
            <div class="card body">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item"><b>ID :  </b>{{ $user->id }}</li>
                    <li class="list-group-item"><b>Name : </b>{{ $user->name }}</li>
                    <li class="list-group-item"><b>Email : </b>{{ $user->email }}</li>
                    <li class="list-group-item"><b>Phone : </b>{{ $user->phone }}</li>
                    <li class="list-group-item"><b>Role : </b>{{ $user->role }}</li>
            </div>
            <a class="btn btn-success mt-3 mb-3" href="/admin/member">kembali</a>
        </div>
    </div>
</div>


@endsection
