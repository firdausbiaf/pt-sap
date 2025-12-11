@extends('layout.dashboard.main')

@section('content')
<div class="container my-5">
    <div class="row justify-content-center align-items-center">
        <div class="card" style="width: 30rem;">
            <div class="card-header">
                Detail Data
            </div>
            <div class="card-body">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item"><b>ID : </b>{{ $data->id }}</li>
                    <li class="list-group-item"><b>Nama User : </b>{{ $data->user->name }}</li>
                    <li class="list-group-item"><b>Telepon : </b>{{ $data->user->phone }}</li>
                    <li class="list-group-item"><b>Kavling : </b>{{ $data->kavling }}</li>
                    <li class="list-group-item"><b>Cluster : </b>{{ $data->kluster }}</li>
                    <li class="list-group-item"><b>Lokasi : </b>{{ $data->lokasi }}</li>
                    <li class="list-group-item"><b>Tipe : </b>{{ $data->tipe }}</li>
                    <li class="list-group-item"><b>SPK : </b>{{ $data->spk }}</li>
                    <li class="list-group-item"><b>Harga Deal : </b>{{ $data->harga_deal }}</li>
                    <li class="list-group-item"><b>Progres : </b>{{ $data->progres }} %</li>
                </ul>
            </div>
            <a class="btn btn-success mt-3 mb-3" href="{{ route('data.index') }}">Kembali</a>
        </div>
    </div>
</div>
@endsection
