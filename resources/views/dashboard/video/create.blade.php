@extends('layout.dashboard.main')

@section('content')
<div class="col-lg-8 mx-5 mt-4">
    <h2>Tambah Video Baru</h2>
    <form action="{{ route('video.store') }}" method="post" enctype="multipart/form-data">
        @csrf

        <!-- Lokasi -->
        <div class="mb-3">
            <label for="lokasi" class="form-label">Lokasi</label>
            <select class="form-select @error('lokasi') is-invalid @enderror" 
                    name="lokasi" id="lokasi" required>
                <option value="">Pilih Lokasi</option>
                @foreach ($lokasiOptions as $lokasi)
                    <option value="{{ $lokasi }}">{{ $lokasi }}</option>
                @endforeach
            </select>
            @error('lokasi')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Kavling -->
        <div class="mb-3">
            <label for="kavling" class="form-label">Kavling</label>
            <select class="form-select @error('kavling') is-invalid @enderror" 
                    name="kavling" id="kavling" required>
                <option value="">Pilih Kavling</option>
            </select>
            @error('kavling')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Video Upload -->
        <div class="mb-3">
            <label for="video" class="form-label @error('video') is-invalid @enderror">Video</label>
            <input class="form-control" type="file" id="video" name="video[]" multiple accept="video/mp4, video/webm">

            @error('video')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror

            <!-- preview thumbnail -->
            <video class="mt-3" id="videoPreview" width="250" controls style="display:none;">
                <source src="">
                Browser Anda tidak mendukung video.
            </video>
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>

<script>
    const kavlingOptions = {!! json_encode($kavlingOptions) !!};

    // update dropdown kavling ketika lokasi berubah
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
    });

    // preview video
    document.getElementById('video').addEventListener('change', function() {
        const preview = document.getElementById('videoPreview');
        const file = this.files[0];

        if (file) {
            preview.style.display = 'block';
            preview.src = URL.createObjectURL(file);
        }
    });
</script>
@endsection
