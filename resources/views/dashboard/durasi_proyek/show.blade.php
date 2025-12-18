@extends('layout.dashboard.main')

@section('content')
<div class="container my-5">
    <div class="row justify-content-center align-items-center">
        <div class="card" style="width: 30rem;">
            <div class="card-header">
                Detail Video
            </div>
            <div class="card-body">
                <ul class="list-group list-group-flush">

                    <li class="list-group-item"><b>ID :</b> {{ $video->id }}</li>

                    <li class="list-group-item"><b>Lokasi :</b> {{ $video->data->lokasi }}</li>

                    <li class="list-group-item"><b>Kavling :</b> {{ $video->data->kavling }}</li>

                    <li class="list-group-item">
                        <b>Video Progress :</b><br><br>
                        <video width="370" controls>
                            <source src="{{ asset('storage/'.$video->video) }}" type="video/mp4">
                            Browser Anda tidak mendukung video.
                        </video>
                    </li>

                </ul>
            </div>

            <a class="btn btn-success mt-3 mb-3" href="{{ route('video.index') }}">Kembali</a>
        </div>
    </div>
</div>
@endsection
