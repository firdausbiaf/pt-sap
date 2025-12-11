@extends('layout.main')

@section('content')


{{-- <h1 class="mt-3 mb-3 text-center text-light">
    <b> {{ $transaksi->course->title }} Bimbel </b>
</h1> --}}

<div class="container my-3"> 
    <div class="row justify-content-center align-items-center">
        <div class="card Mycourse"  style="width: 100%;">
            <h2 class="me-3 my-3"> Tingkat {{ $transaksi->course->category->name }} : {{ $transaksi->course->title }}</h2>
            <p class="ms-2 linked"><a href="/">Home</a> / <a href="/courseMember">My Class</a> / <a href="/myCourse/{{ $transaksi->id }}">{{ $transaksi->course->title }}</a></p>
        </div>
    </div>
    <div class="row justify-content-center align-items-center mt-1">
        <div class="card Mycourse"  style="width: 100%;">
            <div class="row justify-content-center align-items-center my-2">
                <div class="card "  style="width: 95%; border-radius:10px">
                    <div style="width:100%; display: block; margin-left: auto; margin-right: auto;  overflow:hidden" class="my-2">
                        <img src="{{ asset('images/thumbnail.webp') }}" class="card-img-top" alt="{{ $transaksi->course->title }}">
                    </div>
                    <hr>
                    <div class="justify-content-center align-items-center">
                         <h3 class="my-1 text-center"><b> Tingkat {{ $transaksi->course->category->name }} : {{ $transaksi->course->title }}</b></h3>
                    </div>
                    <hr>
                    <div>
                        <p>Halo rekan FAST, Selamat berjumpa pada pembelajaran bimbel FAST. Pada proses pembelajaran diharapkan dapat memberikan pengetahuan dan keterampilan dalam mata pelajaran yang akan di berikan. Pada setiap pertemuan rekan-rekan akan diberikan materi dan juga tugas untuk melatih kemampuan kalian semua. </p>
                    </div>
                </div>
            </div>
            @foreach ($materi as $m)
                <hr>
                <div class="row justify-content-center align-items-center mb-4 ">
                    <h3 class="ms-2">{{ $m->subject }}</h3>
                    <div class="card" style="width: 95%; border-radius:10px">
                        <div class="pertemuan justify-content-center align-items-center display-flex">
                            @if ($m->pdf == null)
                                <h4 class="my-3 ms-4 text-secondary">Belum tersedia.</h4>
                            @else
                            
                                <a href="{{ asset('storage/' . $m->pdf) }}"><h4 class="my-3 ms-4"><i class="menu-icon mdi mdi-file-pdf mdi-36px icon-red me-2"></i>{{ $m->subject }}</h4></a>
                                {{-- <form action="/tugasMember/{{ $m->id }}" method="get">
                                    @csrf
                                    <input type="hidden" name="transaksi_id" id="transaksi_id" value="{{ $transaksi->id }}">
                                    <button class="my-3 ms-4" type="submit" style="border:none; background: none; padding: 0;"><i class="menu-icon mdi mdi-file-send mdi-36px icon-blue me-2 d-inline-block"></i><h4 class="d-inline-block">Tugas</h4></button>
                                </form> --}}
                                <a href="/tugasMember/{{ $m->id }}" type="submit"><h4 class="my-3 ms-4"><i class="menu-icon mdi mdi-file-send mdi-36px icon-blue me-2"></i>Tugas</h4></a>
                            @endif
                           
                        </div>
                    </div>
                </div>                
            @endforeach

            {{-- <hr>
            <div class="row justify-content-center align-items-center mb-4 ">
                <h3 class="ms-2">Pertemuan 2</h3>
                <div class="card" style="width: 95%; border-radius:10px">
                    <div class="pertemuan justify-content-center align-items-center display-flex">
                           
                    </div>
                </div>
            </div> --}}
            
        </div>
    </div>
</div>
@endsection