@extends('layout.main')

@section('content')


<h1 class="mt-3 mb-3 text-center text-light">
    <b> {{ $transaksi->course->title }} Bimbel </b>
</h1>

<div class="container mt-3 mb-3">
    @if ($transaksi->progres == $materi->count())
        <div class="row justify-content-center align-items-center">
            <div class="card"  style="width: 39rem;">
                <div class="card-header">
                    <b>Bimbel Complete</b>
                </div>
                <div class="card body">
                    <img src="{{ asset('images/success.png') }}" class="card-img-top" alt="{{ $transaksi->course->title }}">
                </div>

                <div class="card-footer text-muted">
                    <a class="btn btn-danger my-2" href="/courseMember"><i class="bi bi-arrow-bar-left me-2"></i>Back</a>
                </div>
                
            </div>
        </div>
    @else
    @if ($materi[$transaksi->progres]->pdf == null)
    <div class="row justify-content-center align-items-center">
        <div class="card"  style="width: 60rem;">
            {{-- <img src="{{ asset('storage/' . $course->photo) }}" class="card-img-top" alt="{{ $course->nama }}"> --}}
            
            <div class="card-header">
                <b>{{ $materi[$transaksi->progres]->subject }}</b>
            </div>
            <div class="card body">
                <ul class="list-group list-group-flush">
                    {{-- <li class="list-group-item"><b>Link :  </b>{{ $materi[$transaksi->progres]->link }}</li> --}}
                    <iframe src="{{ str_replace("watch?v=", "embed/", $materi[$transaksi->progres]->link) }}" align="top" height="620" width="100%" frameborder="0" scrolling="auto"></iframe>
                </ul>
            </div>

            <div class="card-footer text-muted">
                <a class="btn btn-danger my-2" href="/courseMember"><i class="bi bi-arrow-bar-left me-2"></i>Back</a>
                <a class="btn btn-success my-2 float-end" href="/next/{{ $transaksi->id }}">Next<i class="bi bi-arrow-bar-right ms-2"></i></a>
            </div>
            
        </div>
    </div>
    @else
        <div class="row justify-content-center align-items-center">
            <div class="card"  style="width: 30rem;">
                {{-- <img src="{{ asset('storage/' . $course->photo) }}" class="card-img-top" alt="{{ $course->nama }}"> --}}
                
                <div class="card-header">
                    <b>{{ $materi[$transaksi->progres]->subject }}</b>
                </div>
                <div class="card body">
                    <img src="{{ asset('images/pdf.png') }}" class="card-img-top" alt="{{ $transaksi->course->title }}">
                    <ul class="list-group list-group-flush">
                        <a href="{{ asset('storage/' . $materi[$transaksi->progres]->pdf) }}" class="badge bg-success" >Download PDF</a>
                        {{-- <li class="list-group-item"><b>PDF : </b>{{ $materi[$transaksi->progres]->pdf }}</li> --}}
                        {{-- <li class="list-group-item"><b>Link :  </b>{{ $materi[$transaksi->progres]->link }}</li> --}}
                    </ul>
                    <ul class="list-group list-group-flush">
                        <form action="/member/tugas" class="d-inline mx-3">
                            @csrf
                          <input type="hidden" name="materi_id" id="materi_id" value="{{ $materi[$transaksi->progres]->id }}">
                          <button type="submit" class="badge bg-success border-0" >Upload tugas</button>
                        </form>
                    </ul>
                </div>
    
                <div class="card-footer text-muted">
                    <a class="btn btn-danger my-2" href="/courseMember"><i class="bi bi-arrow-bar-left me-2"></i>Back</a>
                    <a class="btn btn-success my-2 float-end" href="/next/{{ $transaksi->id }}">Next<i class="bi bi-arrow-bar-right ms-2"></i></a>
                </div>
                
            </div>
        </div>
    @endif 
    @endif
        
</div>




@endsection