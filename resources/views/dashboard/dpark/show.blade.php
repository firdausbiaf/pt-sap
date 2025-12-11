@extends('layout.dashboard.main')

@section('content')
<div class="container my-5">
    <div class="row justify-content-center align-items-center">
        <div class="card" style="width: 30rem;">
            <div class="card-header">
                Detail Foto
            </div>
            <div class="card-body">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item"><b>ID : </b>{{ $dpark->id }}</li>
                    <li class="list-group-item"><b>Cluster : </b>{{ $dpark->cluster }}</li>
                    <li class="list-group-item"><b>Kavling : </b>{{ $dpark->kavling }}</li>
                    <li class="list-group-item"><b>Status : </b>{{ $dpark->status == 0 ? 'Sold' : 'Open' }}</li>
                    <li class="list-group-item"><b>Keterangan : </b>{{ $dpark->keterangan }}</li>
                </ul>
            </div>
            <a class="btn btn-success mt-3 mb-3" href="{{ route('stok-dpark.index') }}">Kembali</a>
        </div>
    </div>
</div>
@endsection
