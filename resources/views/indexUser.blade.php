@extends('layout.main')

@section('content')
    
<div class="row">
    <div class="col ">
        <div class="profile">
            <h1 class="fw-bold">FAST</h1>
            <h3>
                Fantastic Smart Institute
            </h3>
            @auth
                @if(auth()->user()->id == $transaksi->user_id)
                    <h4>
                        Anda telah terdaftar pada bimbel : {{ $transaksi->course->title }}<br><br>
                        Klik menu "My Class" untuk melihat kelas bimbel Anda.
                    </h4>
                @else
                    <h4>
                        Anda belum terdaftar bimbel. Klik menu "Bimbel" untuk memilih kelas bimbel yang tersedia.
                    </h4>
                @endif
            @endauth
        </div>
    </div>
</div>
@endsection