@extends('layout.dashboard.main')

@section('content')
<div class="col-lg-8 mx-5 mt-4">
    <h2>Tambah Stok Baru</h2>
    <form action="{{ route('stok-batu.store') }}" method="post">
        @csrf
        <div class="mb-3">
            <label for="cluster" class="form-label">Cluster</label>
            <select class="form-select @error('cluster') is-invalid @enderror" name="cluster" id="cluster" required>
                <option value="">Pilih Cluster</option>
                @foreach ($clusterOptions as $cluster)
                    <option value="{{ $cluster }}">{{ $cluster }}</option>
                @endforeach
            </select>
            @error('cluster')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
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
            <label for="keterangan" class="form-label">Keterangan</label>
            <input type="text" class="form-control @error('keterangan') is-invalid @enderror" id="keterangan" name="keterangan" value="{{ old('keterangan') }}" required>
            @error('keterangan')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
@endsection
