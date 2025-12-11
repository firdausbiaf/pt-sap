@extends('layout.dashboard.main')

@section('content')
<div class="container my-5">
    <div class="row justify-content-center align-items-center">
        <div class="card" style="width: 30rem;">
            <div class="card-header">
                Detail Stok
            </div>
            <div class="card-body">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item"><b>ID : </b>{{ $batu->id }}</li>
                    <li class="list-group-item"><b>Cluster : </b>{{ $batu->cluster }}</li>
                    <li class="list-group-item"><b>Kavling : </b>{{ $batu->kavling }}</li>
                    <li class="list-group-item"><b>Status : </b>{{ $batu->status == 0 ? 'Sold' : 'Open' }}</li>
                    <li class="list-group-item"><b>Keterangan : </b>{{ $batu->keterangan }}</li>
                </ul>
            </div>
            <a class="btn btn-success mt-3 mb-3" href="{{ route('stok-batu.index') }}">Kembali</a>
        </div>
    </div>
</div>
@endsection
