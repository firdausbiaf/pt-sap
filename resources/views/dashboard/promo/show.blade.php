@extends('layout.dashboard.main')

@section('content')
<div class="container my-5">
    <div class="row justify-content-center align-items-center">
        <div class="card" style="width: 30rem;">
            <div class="card-header">
                Detail Promo
            </div>
            <div class="card-body">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item"><b>ID : </b>{{ $promo->id }}</li>
                    <li class="list-group-item"><b>Keterangan : </b>{{ $promo->keterangan }}</li>
                    <li class="list-group-item">
                        <b>Gambar Promo :</b><br><br>
                        @if ($promo->gambar)
                            <img src="{{ asset('storage/'.$promo->gambar) }}" width="370px" alt="Gambar Promo">
                        @else
                            <p>Tidak ada gambar</p>
                        @endif
                    </li>
                </ul>
            </div>
            <a class="btn btn-success mt-3 mb-3" href="{{ route('promo.index') }}">Kembali</a>
        </div>
    </div>
</div>
@endsection
