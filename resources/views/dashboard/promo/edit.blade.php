@extends('layout.dashboard.main')

@section('content')
<div class="col-lg-8 mx-5 mt-4">
    <h2>Edit Promo</h2>
    <form action="{{ route('promo.update', $promo->id) }}" method="post" enctype="multipart/form-data">
        @method('PUT')
        @csrf
        <div class="mb-3">
            <label for="gambar" class="form-label">Gambar</label>
            {{-- @if ($promo->gambar)
                <img src="{{ asset('storage/'.$promo->gambar) }}" style="max-width: 200px; max-height: 200px;" alt="Gambar Promo">
            @else
                <p>Tidak ada gambar</p>
            @endif --}}
            <input type="file" class="form-control @error('gambar') is-invalid @enderror" id="gambar" name="gambar">
            @error('gambar')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="keterangan" class="form-label">Keterangan</label>
            <input type="text" class="form-control @error('keterangan') is-invalid @enderror" id="keterangan" name="keterangan" value="{{ $promo->keterangan }}">
            @error('keterangan')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="gambar_preview" class="form-label"></label>
            <img id="gambar_preview" style="max-width: 200px; max-height: 200px;" src="{{ asset('storage/'.$promo->gambar) }}" alt="Preview">
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection

@section('scripts')
<script>
    document.getElementById('gambar').addEventListener('change', function() {
        const preview = document.getElementById('gambar_preview');
        const fileInput = document.getElementById('gambar');

        const file = fileInput.files[0];
        const reader = new FileReader();

        reader.addEventListener("load", function () {
            preview.src = reader.result;
        }, false);

        if (file) {
            reader.readAsDataURL(file);
        }
    });
</script>
@endsection
