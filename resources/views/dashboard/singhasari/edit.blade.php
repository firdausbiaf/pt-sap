@extends('layout.dashboard.main')

@section('content')
<div class="col-lg-8 mx-5 mt-4">
    <h2>Edit Stok Singhasari</h2>
    <form action="{{ route('stok-singhasari.update', $singhasari->id) }}" method="post">
        @csrf
        @method('PUT') {{-- For the update method --}}
        <div class="mb-3">
            <label for="kluster" class="form-label">Cluster</label>
            <select class="form-select @error('kluster') is-invalid @enderror" id="kluster" name="kluster" required>
                <option value="1" {{ old('kluster', $singhasari->kluster) == 1 ? 'selected' : '' }}>1</option>
            </select>
            @error('kluster')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="kavling" class="form-label">Kavling</label>
            <input type="text" class="form-control @error('kavling') is-invalid @enderror" id="kavling" name="kavling" value="{{ old('kavling', $singhasari->kavling) }}" required>
            @error('kavling')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="keterangan" class="form-label">Keterangan</label>
            <input type="text" class="form-control @error('keterangan') is-invalid @enderror" id="keterangan" name="keterangan" value="{{ old('keterangan', $singhasari->keterangan) }}" required>
            @error('keterangan')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection
