@extends('layout.dashboard.main')
@section('content')
   
  <div class="col-lg-8 mx-5 mt-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Edit Bimbel</h1>
      </div>
      <form method="post" action="/admin/course/{{ $course->id }}" class="mb-5" enctype="multipart/form-data">
        @method('put')
        @csrf
        <div class="mb-3">
            <label for="title" class="form-label">Nama Bimbel</label>
            <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title', $course->title) }}">
              @error('title')
              <div class="invalid-feedback">
              {{ $message }}
              </div>
              @enderror
          </div>
          <div class="mb-3">
            <label for="deskripsi" class="form-label">Deskripsi Singkat</label>
            <input type="text" class="form-control @error('deskripsi') is-invalid @enderror" id="deskripsi" name="deskripsi" value="{{ old('deskripsi', $course->deskripsi) }}">
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
              @if (old('category_id', $course->category_id) == $c->id)
                <option value="{{ $c->id }}" selected>{{ $c->name }}</option>
              @else
                <option value="{{ $c->id }}">{{ $c->name }}</option>
              @endif
              @endforeach
           </select>
          </div>
          <div class="mb-3">
      <div class="mb-3">
            <label for="requirment" class="form-label">Requirement</label>
            <input type="text" class="form-control @error('requirment') is-invalid @enderror" id="requirment" name="requirment" value="{{ old('requirment', $course->requirment) }}">
              @error('requirment')
              <div class="invalid-feedback">
              {{ $message }}
              </div>
              @enderror
          </div>
          <div class="mb-3">         
               <label for="outcome" class="form-label">Outcome</label>
            <input type="text" class="form-control @error('outcome') is-invalid @enderror" id="outcome" name="outcome" value="{{ old('outcome', $course->outcome) }}">
              @error('outcome')
              <div class="invalid-feedback">
              {{ $message }}
              </div>
              @enderror
          </div>
          <div class="mb-3">
            <label for="harga" class="form-label">Harga</label>
            <input type="text" class="form-control @error('harga') is-invalid @enderror" id="harga" name="harga" value="{{ old('harga', $course->harga) }}">
              @error('harga')
              <div class="invalid-feedback">
              {{ $message }}
              </div>
              @enderror
          </div>
          <div class="mb-3">
            <label for="photo" class="form-label @error('photo') is-invalid @enderror">Photo Admin</label>
            <input type="hidden" name="oldPhoto" value="{{ $course->photo }}">
            @if ($course->photo)
            <img src="{{ asset('storage/' . $course->photo) }}" class="img-preview img-fluid mb-3 col-sm-5 d-block">
            @else
            <img class="img-preview img-fluid mb-3 col-sm-5">
            @endif
            <input class="form-control" type="file" id="photo" name="photo"  onchange="previewImage()">
            @error('photo')
            <div class="invalid-feedback">
            {{ $message }}
            </div>
            @enderror
          </div>
          
        
        <button type="submit" class="btn btn-primary">Submit</button>
      </form>
  </div>

@endsection