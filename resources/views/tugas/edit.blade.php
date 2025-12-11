@extends('layout.main')

@section('content')
<div class="col d-flex justify-content-center">  
  <div class="card" style="width: 80rem; opacity: 65%; margin-top: 5%;">
    <div class="col-lg-8 mx-5 mt-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Edit Tugas</h1>
          </div>
          <form method="post" action="/member/tugas/{{ $tugas->id }}" class="mb-5" enctype="multipart/form-data">
            @method('put')
            @csrf
            <input type="hidden" name="materi_id" id="materi_id" value="{{ $materi_id }}">
              <div class="mb-3">
                <label for="pdf" class="form-label @error('pdf') is-invalid @enderror">pdf Admin</label>
                <input type="hidden" name="oldpdf" value="{{ $tugas->pdf }}">
                @if ($tugas->pdf)
                <img src="{{ asset('storage/' . $tugas->pdf) }}" class="img-preview img-fluid mb-3 col-sm-5 d-block">
                @else
                <img class="img-preview img-fluid mb-3 col-sm-5">
                @endif
                <input class="form-control" type="file" id="pdf" name="pdf"  onchange="previewImage()">
                @error('pdf')
                <div class="invalid-feedback">
                {{ $message }}
                </div>
                @enderror
              </div>              
            <button type="submit" class="btn btn-primary">Submit</button>
          </form>
      </div>
  </div>
</div>
@endsection
