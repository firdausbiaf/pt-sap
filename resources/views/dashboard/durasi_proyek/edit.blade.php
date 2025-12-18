@extends('layout.dashboard.main')

@section('content')
<div class="col-lg-8 mx-5 mt-4">
    <h2>Edit Video</h2>
    <form action="{{ route('video.update', $video->id) }}" method="post" enctype="multipart/form-data">
        @method('put')
        @csrf
        <div class="mb-3">
            <label for="lokasi" class="form-label">Lokasi</label>
            <select class="form-select @error('lokasi') is-invalid @enderror" name="lokasi" id="lokasi" required>
                <option value="">Pilih Lokasi</option>
                @foreach ($lokasiOptions as $lokasi)
                    <option value="{{ $lokasi }}" {{ old('lokasi', $video->data->lokasi) == $lokasi ? 'selected' : '' }}>
                        {{ $lokasi }}
                    </option>
                @endforeach
            </select>
            @error('lokasi')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="kavling" class="form-label">Kavling</label>
            <select class="form-select @error('kavling') is-invalid @enderror" name="kavling" id="kavling" required>
                <option value="">Pilih Kavling</option>
                @foreach ($kavlingOptions as $kavling)
                    <option value="{{ $kavling }}" {{ old('kavling', $video->data->kavling) == $kavling ? 'selected' : '' }}>
                        {{ $kavling }}
                    </option>
                @endforeach
            </select>
            @error('kavling')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="video" class="form-label @error('video') is-invalid @enderror">Video</label>
            <div>
                <input class="form-control" type="file" id="video" name="video" onchange="previewVideo()">
            </div>
            @error('video')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror

            <!-- Preview Video -->
            <video class="video-preview mt-2" style="max-width: 300px;" controls>
                <source src="{{ asset('storage/' . $video->video) }}" type="video/mp4">
            </video>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>

<script>
    const kavlingOptions = {!! json_encode($kavlingOptions) !!};

    document.getElementById('lokasi').addEventListener('change', function() {
        const selectedLokasi = this.value;
        const kavlingSelect = document.getElementById('kavling');

        kavlingSelect.innerHTML = '<option value="">Pilih Kavling</option>';

        if (selectedLokasi in kavlingOptions) {
            kavlingOptions[selectedLokasi].forEach(function(kavling) {
                const option = document.createElement('option');
                option.value = kavling;
                option.text = kavling;
                kavlingSelect.appendChild(option);
            });
        }

        kavlingSelect.value = "{{ old('kavling', $video->data->kavling) }}";
    });

    function previewVideo() {
        const preview = document.querySelector('.video-preview');
        const fileInput = document.querySelector('#video');
        const file = fileInput.files[0];

        if (file) {
            const url = URL.createObjectURL(file);
            preview.src = url;
        }
    }

    document.getElementById('lokasi').dispatchEvent(new Event('change'));
</script>
@endsection
