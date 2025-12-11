@extends('layout.dashboard.main')

@section('content')
<div class="col-lg-8 mx-5 mt-4">
    <h2>Tambah Foto Baru</h2>
    <form action="{{ route('foto.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="lokasi" class="form-label">Lokasi</label>
            <select class="form-select @error('lokasi') is-invalid @enderror" name="lokasi" id="lokasi" required>
                <option value="">Pilih Lokasi</option>
                @foreach ($lokasiOptions as $lokasi)
                    <option value="{{ $lokasi }}">{{ $lokasi }}</option>
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
            </select>
            @error('kavling')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        {{-- <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select class="form-select @error('status') is-invalid @enderror" name="status" id="status" required>
                <option value="0">Proses</option>
                <option value="1">Selesai</option>
            </select>
            @error('status')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div> --}}
        <div class="mb-3">
            <label for="photo" class="form-label @error('photo') is-invalid @enderror">Foto</label>
            <div>
                <input class="form-control" type="file" id="photo" name="photo[]" onchange="previewImage()" multiple>
            </div>
            @error('photo')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror

            <!-- Tambahkan elemen img-preview di sini -->
            <img class="img-preview mt-2" style="max-width: 200px; max-height: 200px;" src="" alt="Preview">
        </div>
        <div class="mb-3">
            <label for="komplain" class="form-label">Komplain</label>
            <textarea class="form-control @error('komplain') is-invalid @enderror" id="komplain" name="komplain" style="height: 100px;"></textarea>
            <!-- <input type="text" class="form-control @error('komplain') is-invalid @enderror" id="komplain" name="komplain"> -->
            @error('komplain')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>

<script>
    const kavlingOptions = {!! json_encode($kavlingOptions) !!};

    document.getElementById('lokasi').addEventListener('change', function() {
        const selectedLokasi = this.value;
        const kavlingSelect = document.getElementById('kavling');

        // Kosongkan pilihan kavling terlebih dahulu
        kavlingSelect.innerHTML = '<option value="">Pilih Kavling</option>';

        // Tambahkan pilihan kavling sesuai dengan lokasi yang dipilih
        if (selectedLokasi in kavlingOptions) {
            kavlingOptions[selectedLokasi].forEach(function(kavling) {
                const option = document.createElement('option');
                option.value = kavling;
                option.text = kavling;
                kavlingSelect.appendChild(option);
            });
        }
    });

    function previewImage() {
        const preview = document.querySelector('.img-preview');
        const fileInput = document.querySelector('#photo');

        const file = fileInput.files[0];
        const reader = new FileReader();

        reader.addEventListener("load", function () {
            preview.src = reader.result;
        }, false);

        if (file) {
            reader.readAsDataURL(file);
        }
    }
</script>
@endsection
