@extends('layout.dashboard.main')

@section('content')
<div class="col-lg-8 mx-5 mt-4">
    <h2>Tambah Data Baru</h2>
    <form action="{{ route('data.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="user_id" class="form-label">Nama User</label>
            <select class="form-select @error('user_id') is-invalid @enderror" name="user_id" id="user_id" required>
                <option value="">Pilih Nama User</option>
                @foreach ($users as $user)
                @if ($user->role !== 'admin' && $user->role !== 'petugas')
                <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>
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
                <option value="DJAGAD LAND BATU" {{ old('lokasi') == 'DJAGAD LAND BATU' ? 'selected' : '' }}>DJAGAD LAND BATU</option>
                <option value="DJAGAD LAND SINGHASARI" {{ old('lokasi') == 'DJAGAD LAND SINGHASARI' ? 'selected' : '' }}>DJAGAD LAND SINGHASARI</option>
                <option value="DPARK CITY" {{ old('lokasi') == 'DPARK CITY' ? 'selected' : '' }}>DPARK CITY</option>
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
            <input type="text" class="form-control @error('kavling') is-invalid @enderror" id="kavling" name="kavling" value="{{ old('kavling') }}" required>
            @error('kavling')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        
        <div class="mb-3">
            <label for="tipe" class="form-label">Tipe</label>
            <input type="number" class="form-control @error('tipe') is-invalid @enderror" id="tipe" name="tipe" value="{{ old('tipe') }}" required>
            @error('tipe')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="spk" class="form-label">SPK</label>
            <input type="text" class="form-control @error('spk') is-invalid @enderror" id="spk" name="spk" value="{{ old('spk') }}" required>
            @error('spk')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="ptb" class="form-label">PTB</label>
            <input type="text" class="form-control @error('spk') is-invalid @enderror" id="ptb" name="ptb" value="{{ old('ptb') }}" required>
            @error('ptb')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="harga_deal" class="form-label">Harga Deal</label>
            <input type="number" class="form-control @error('cicilan') is-invalid @enderror" id="harga_deal" name="harga_deal" value="{{ old('harga_deal') }}" required>
            @error('harga_deal')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        
        <div class="mb-3">
            <label for="progres" class="form-label">Progres (%)</label>
            <input type="number" class="form-control @error('progres') is-invalid @enderror" id="progres" name="progres" value="{{ old('progres') }}" required>
            @error('progres')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="sales" class="form-label">Sales</label>
            <input type="text" class="form-control @error('kavling') is-invalid @enderror" id="sales" name="sales" value="{{ old('sales') }}" required>
            @error('sales')
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

            <!-- Tambahkan elemen img-preview di sini -->
            <div class="img-preview-container mt-2" id="preview-container" style="display: flex; flex-wrap: wrap;"></div>
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>

<style>
    .img-preview-container {
        flex-basis: 20%;
        margin-right: 1rem;
        margin-bottom: 1rem;
    }

    .img-preview-container img {
        display: block;
        max-width: 100%;
        height: auto;
    }
</style>


<script>

const lokasiSelect = document.getElementById('lokasi');
    const klusterSelect = document.getElementById('kluster');

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

    document.addEventListener('DOMContentLoaded', updateKlusterOptions);
    lokasiSelect.addEventListener('change', updateKlusterOptions);

    function previewImages() {
    const previewContainer = document.querySelector('#preview-container');
    const files = document.querySelector('#ktp').files;

    previewContainer.innerHTML = ''; // Clear previous previews

    for (const file of files) {
        const img = document.createElement('img');
        img.src = URL.createObjectURL(file);
        img.style.maxWidth = '100%'; // Set the width to fit the container
        img.style.height = 'auto'; // Keep the aspect ratio
        
        const imgPreviewContainer = document.createElement('div');
        imgPreviewContainer.className = 'img-preview-container mr-2 mb-2';
        imgPreviewContainer.style.flexBasis = '20%';
        imgPreviewContainer.appendChild(img);

        previewContainer.appendChild(imgPreviewContainer);
    }
}

</script>

@endsection