@extends('layout.dashboard.main')
@section('content')
   
  <div class="col-lg-4 mx-5 mt-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Tambah Bimbel</h1>
      </div>
      <form method="post" action="/admin/course" class="mb-5" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="title" class="form-label">Title Bimbel</label>
            <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title') }}">
              @error('title')
              <div class="invalid-feedback">
              {{ $message }}
              </div>
              @enderror
        </div>
        <div class="mb-3">
          <label for="deskripsi" class="form-label">Deskripsi Singkat</label>
          <input type="text" class="form-control @error('deskripsi') is-invalid @enderror" id="deskripsi" name="deskripsi" value="{{ old('deskripsi') }}">
            @error('deskripsi')
            <div class="invalid-feedback">
            {{ $message }}
            </div>
            @enderror
        </div>
        <div class="mb-3">
          <label for="category_id" class="form-label">Kelas</label>
         <select class="form-select" name="category_id" >
            @foreach ($category as $c)
            @if (old('category_id') == $c->id)
              <option value="{{ $c->id }}" selected>{{ $c->name }}</option>
            @else
              <option value="{{ $c->id }}">{{ $c->name }}</option>
            @endif
            @endforeach
         </select>
        </div>
        <div class="mb-3">
               <div class="mb-3">
          <label for="requirment" class="form-label">Persyaratan</label>
          <input type="text" class="form-control @error('requirment') is-invalid @enderror" id="requirment" name="requirment" value="{{ old('requirment') }}">
            @error('requirment')
            <div class="invalid-feedback">
            {{ $message }}
            </div>
            @enderror
        </div>
        <div class="mb-3">
          <label for="outcome" class="form-label">Hasil Pencapaian</label>
          <input type="text" class="form-control @error('outcome') is-invalid @enderror" id="outcome" name="outcome" value="{{ old('outcome') }}">
            @error('outcome')
            <div class="invalid-feedback">
            {{ $message }}
            </div>
            @enderror
        </div>
        <div class="mb-3">
          <label for="harga" class="form-label">Harga</label>
          <input type="text" class="form-control @error('harga') is-invalid @enderror" id="harga" name="harga" value="{{ old('harga') }}">
            @error('harga')
            <div class="invalid-feedback">
            {{ $message }}
            </div>
            @enderror
        </div>
        <div class="mb-3">
          <label for="photo" class="form-label @error('photo') is-invalid @enderror">Photo Cover</label>
          <img class="img-preview img-fluid mb-3 col-sm-5">
          <input class="form-control" type="file" id="photo" name="photo" onchange="previewImage()">
          @error('photo')
          <div class="invalid-feedback">
          {{ $message }}
          </div>
          @enderror
        </div>
        <button type="submit" class="btn btn-primary" >Submit</button>
      </form>
  </div>
@endsection