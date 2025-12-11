@extends('layout.dashboard.main')

@section('content')
<div class="container my-5">
    <div class="row justify-content-center align-items-center">
        <div class="card" style="width: 40rem;">
            <div class="card-header">
                Detail KTP
            </div>
            <div class="card-body">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">
                        <b>Foto KTP :</b><br><br>

                        @php
                            $ktpPhotos = json_decode($data->ktp);
                        @endphp

                        @if (!empty($ktpPhotos) && count($ktpPhotos) > 0)
                            <div class="row">
                                @foreach ($ktpPhotos as $index => $ktpPhoto)
                                    @if ($index < 10) {{-- Batasi hingga 10 foto --}}
                                    <div class="col-md-6 mb-3">
                                        <div class="photo-container" data-photo="{{ $ktpPhoto }}">
                                            <img class="img-fluid" src="{{ asset('storage/'.$ktpPhoto) }}" alt="Foto KTP {{ $index + 1 }}">
                                            <div class="btn-group mt-2">
                                                <a href="{{ asset('storage/'.$ktpPhoto) }}" class="btn btn-sm btn-primary" target="_blank">View</a>
                                                <button class="btn btn-sm btn-danger ml-2" onclick="deletePhoto('{{ $ktpPhoto }}')">Hapus</button>
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                @endforeach
                            </div>
                        @else
                            <p>Belum ada gambar yang diupload.</p>
                        @endif
                    </li>
                </ul>
            </div>
            <a class="btn btn-success mt-3 mb-3" href="{{ route('data.index') }}">Kembali</a>
        </div>
    </div>
</div>

<style>
    .photo-container {
        padding: 5px; /* Sesuaikan nilai ini untuk mengatur jarak antara gambar */
    }
</style>
<script>
   function deletePhoto(photoPath) {
    if (confirm('Apakah Anda yakin ingin menghapus foto ini?')) {
        fetch('{{ route('delete.photo') }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ photoPath: photoPath, data_id: {{ $data->id }} }) // Ganti dengan ID data yang sesuai
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Remove the deleted photo's parent element from the DOM
                const photoContainer = document.querySelector(`[data-photo="${photoPath}"]`);
                if (photoContainer) {
                    photoContainer.remove();
                }
            } else {
                alert('Gagal menghapus foto.');
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
    }
}
</script>
@endsection
