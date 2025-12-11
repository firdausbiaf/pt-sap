@extends('layout.dashboard.main')
@section('content')
   
  <div class="col-lg-8 mx-5 mt-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Edit Pertemuan</h1>
      </div>
      <form method="post" action="/admin/materi/{{ $materi->id }}" class="mb-5" enctype="multipart/form-data">
        @method('put')
        @csrf
        <input type="hidden" name="course_id" id="course_id" value="{{ $course_id }}">
        <div class="mb-3">
            <label for="subject" class="form-label">Subject Materi</label>
            <input type="text" class="form-control @error('subject') is-invalid @enderror" id="subject" name="subject" value="{{ old('subject', $materi->subject) }}">
              @error('subject')
              <div class="invalid-feedback">
              {{ $message }}
              </div>
              @enderror
          </div>
          <div class="mb-3">
            <label for="pdf" class="form-label @error('pdf') is-invalid @enderror">PDF</label>
            <input type="hidden" name="oldpdf" value="{{ $materi->pdf }}">
            @if ($materi->pdf)
            <img src="{{ asset('storage/' . $materi->pdf) }}" class="img-preview img-fluid mb-3 col-sm-5 d-block">
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

@endsection