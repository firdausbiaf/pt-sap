@extends('layout.dashboard.main')

@section('content')
<div class="col-lg-8 mx-5 mt-4">
    <h2>Tambah Durasi Proyek</h2>

    <form action="{{ route('durasi-proyek.store') }}" method="post">
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

        <!-- Tanggal Mulai -->
        <div class="mb-3">
            <label for="tanggal_mulai" class="form-label">Tanggal Mulai Proyek</label>
            <input type="date"
                   class="form-control @error('tanggal_mulai') is-invalid @enderror"
                   name="tanggal_mulai"
                   id="tanggal_mulai"
                   value="{{ old('tanggal_mulai') }}"
                   required>
            @error('tanggal_mulai')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Tanggal Selesai -->
        <div class="mb-3">
            <label for="tanggal_selesai" class="form-label">Tanggal Selesai Proyek</label>
            <input type="date"
                   class="form-control @error('tanggal_selesai') is-invalid @enderror"
                   name="tanggal_selesai"
                   id="tanggal_selesai"
                   value="{{ old('tanggal_selesai') }}"
                   required>
            @error('tanggal_selesai')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">
            Simpan Durasi Proyek
        </button>
    </form>
</div>

<script>
    const kavlingOptions = {!! json_encode($kavlingOptions) !!};

    document.getElementById('lokasi').addEventListener('change', function () {
        const selectedLokasi = this.value;
        const kavlingSelect = document.getElementById('kavling');

        kavlingSelect.innerHTML = '<option value="">Pilih Kavling</option>';

        if (kavlingOptions[selectedLokasi]) {
            kavlingOptions[selectedLokasi].forEach(function (kavling) {
                const option = document.createElement('option');
                option.value = kavling;
                option.text = kavling;
                kavlingSelect.appendChild(option);
            });
        }
    });
</script>
@endsection
