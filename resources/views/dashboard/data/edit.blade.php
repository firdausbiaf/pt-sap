@extends('layout.dashboard.main')

@section('content')
<div class="col-lg-8 mx-5 mt-4">
    <h2>Edit Data</h2>
    <form action="{{ route('data.update', $data->id) }}" method="post" enctype="multipart/form-data">
        @method('put')
        @csrf
        <div class="mb-3">
            <label for="user_id" class="form-label">Nama Member</label>
            <select class="form-select @error('user_id') is-invalid @enderror" id="user_id" name="user_id">
                <option value="">Pilih Nama Member</option>
                @foreach ($users as $user)
                    @if ($user->role != 'admin' && $user->role != 'petugas')
                        <option value="{{ $user->id }}" {{ old('user_id', $data->user_id) == $user->id ? 'selected' : '' }}>
                            {{ $user->name }}
                        </option>
                    @endif
                @endforeach
            </select>
            @error('user_id')
            <div class="invalid-feedback">
              {{ $message }}
            </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="lokasi" class="form-label">Lokasi</label>
            <select class="form-select @error('lokasi') is-invalid @enderror" id="lokasi" name="lokasi" required>
                <option value="">Pilih Lokasi</option>
                @foreach ($lokasiOptions as $option)
                <option value="{{ $option }}" {{ old('lokasi', $data->lokasi) == $option ? 'selected' : '' }}>{{ $option }}</option>
                @endforeach
            </select>
            @error('lokasi')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="kluster" class="form-label">Cluster</label>
            <select class="form-select" id="kluster" name="kluster" required>
                <!-- Options will be dynamically populated by JavaScript -->
            </select>
        </div>
        <div class="mb-3">
            <label for="kavling" class="form-label">Kavling</label>
            <input type="text" class="form-control @error('kavling') is-invalid @enderror" id="kavling" name="kavling" value="{{ old('kavling', $data->kavling) }}" required>
            @error('kavling')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        
        <div class="mb-3">
            <label for="tipe" class="form-label">Tipe</label>
            <input type="number" class="form-control @error('tipe') is-invalid @enderror" id="tipe" name="tipe" value="{{ old('tipe', $data->tipe) }}" required>
            @error('tipe')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="spk" class="form-label">SPK</label>
            <input type="text" class="form-control @error('spk') is-invalid @enderror" id="spk" name="spk" value="{{ old('spk', $data->spk) }}" required>
            @error('spk')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="ptb" class="form-label">PTB</label>
            <input type="text" class="form-control @error('spk') is-invalid @enderror" id="ptb" name="ptb" value="{{ old('ptb', $data->ptb) }}" required>
            @error('ptb')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="harga_deal" class="form-label">Harga Deal</label>
            <input type="number" class="form-control @error('cicilan') is-invalid @enderror" id="harga_deal" name="harga_deal" value="{{ old('harga_deal', $data->harga_deal) }}" required>
            @error('harga_deal')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        
        <div class="mb-3">
            <label for="progres" class="form-label">Progres (%)</label>
            <input type="number" class="form-control @error('progres') is-invalid @enderror" id="progres" name="progres" value="{{ old('progres', $data->progres) }}" required>
            @error('progres')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="sales" class="form-label">Sales</label>
            <input type="text" class="form-control @error('kavling') is-invalid @enderror" id="sales" name="sales" value="{{ old('sales', $data->sales) }}" required>
            @error('kavling')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="ktp" class="form-label @error('photo') is-invalid @enderror">KTP</label>
            <div>
                <input class="form-control" type="file" id="ktp" name="ktp[]" onchange="previewImages()" multiple>
            </div>
            @error('ktp')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror

            <!-- Inisialisasi variabel $ktpPhotos dengan foto-foto yang sudah ada -->
            @php
    $ktpPhotos = json_decode($data->ktp) ?? []; // Menambahkan nilai default berupa array kosong jika $data->ktp bernilai null
@endphp

            <!-- Tambahkan elemen img-preview di sini -->
<div class="mt-2" id="preview-container" style="display: flex; flex-wrap: wrap;">
    @if (!empty($ktpPhotos)) <!-- Cek apakah $ktpPhotos tidak kosong -->
        @foreach ($ktpPhotos as $index => $photo)
            <div class="img-preview-container mr-2 mb-2" style="max-width: 200px; flex-basis: 20%;">
                <img class="img-preview img-fluid" src="{{ asset('storage/'.$photo) }}" alt="Preview" style="max-width: 100%;">
            </div>
            @if (($index + 1) % 5 === 0)
                <div style="flex-basis: 100%;"></div> <!-- Membuat baris baru setelah 5 gambar -->
            @endif
        @endforeach
    @endif
</div>
            
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>

<script>
    const lokasiSelect = document.getElementById('lokasi');
    const klusterSelect = document.getElementById('kluster');
    const ktpInput = document.getElementById('ktp');
    const previewContainer = document.getElementById('preview-container');

    const klusters = {
        'DJAGAD LAND BATU': ['Tahap 1', 'Tahap 2', 'Tahap 3', 'Tahap 4'],
        'DJAGAD LAND SINGHASARI': ['1'],
        'DPARK CITY': ['Alexandria', 'Sevilla', 'Andalusia', 'Granada']
    };

    function updateKlusterOptions() {
        const selectedLokasi = lokasiSelect.value;
        klusterSelect.innerHTML = '';

        klusters[selectedLokasi].forEach(kluster => {
            const option = document.createElement('option');
            option.value = kluster;
            option.textContent = kluster;
            klusterSelect.appendChild(option);
        });
    }

    document.addEventListener('DOMContentLoaded', () => {
        // Call updateKlusterOptions() to populate kluster based on initial lokasi value
        updateKlusterOptions();

        // Get the initially selected kluster value from the server-side old() method
        const initialKluster = '{{ old("kluster", $data->kluster) }}';

        // Set the initial kluster value in the select element
        klusterSelect.value = initialKluster;

        // Tampilkan pratinjau gambar yang diunggah jika ada
        loadPreviousImages();
        
        // Tambahkan event listener untuk mengupdate pratinjau gambar saat input berubah
        ktpInput.addEventListener('change', previewImages);
    });

    lokasiSelect.addEventListener('change', updateKlusterOptions);

    function loadPreviousImages() {
        const ktpPhotos = {!! json_encode($ktpPhotos) !!}; // Convert the PHP array to a JavaScript array

        previewContainer.innerHTML = ''; // Clear previous previews

        for (const photo of ktpPhotos) {
            const img = document.createElement('img');
            img.src = '{{ asset("storage") }}/' + photo; // Update this line
            img.style.maxWidth = '100%';
            img.style.height = 'auto';

            const imgPreviewContainer = document.createElement('div');
            imgPreviewContainer.className = 'img-preview-container mr-2 mb-2';
            imgPreviewContainer.style.flexBasis = '20%';
            imgPreviewContainer.appendChild(img);

            previewContainer.appendChild(imgPreviewContainer);
        }
    }

    function previewImages() {
        previewContainer.innerHTML = ''; // Clear previous previews

        const files = ktpInput.files;

        for (const file of files) {
            const img = document.createElement('img');
            img.src = URL.createObjectURL(file);
            img.style.maxWidth = '100%';
            img.style.height = 'auto';

            const imgPreviewContainer = document.createElement('div');
            imgPreviewContainer.className = 'img-preview-container mr-2 mb-2';
            imgPreviewContainer.style.flexBasis = '20%';
            imgPreviewContainer.appendChild(img);

            previewContainer.appendChild(imgPreviewContainer);
        }
    }
</script>

@endsection
