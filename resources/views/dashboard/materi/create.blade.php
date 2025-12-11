@extends('layout.dashboard.main')
@section('content')
   
  <div class="col-lg-4 mx-5 mt-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Tambah Materi</h1>
      </div>
      <div class="my-3">
        <label>
            <input type="radio" name="colorRadio" 
                   value="video"> Video</label>
        <label>
            <input type="radio" name="colorRadio" 
                   value="pdf"> PDF</label>
      </div>
      <form method="post" action="/admin/materi" class="mb-5" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="course_id" id="course_id" value="{{ $course_id }}">
        <div class="mb-3">
            <label for="subject" class="form-label">Subject Materi</label>
            <input type="text" class="form-control @error('subject') is-invalid @enderror" id="subject" name="subject" value="{{ old('subject') }}">
              @error('subject')
              <div class="invalid-feedback">
              {{ $message }}
              </div>
              @enderror
        </div>
        <div class="video selectt mb-3" style="display: none;">
          <label for="link" class="form-label">link Video Pembelajaran</label>
          <input type="text" class="form-control @error('link') is-invalid @enderror" id="link" name="link" value="{{ old('link') }}">
            @error('link')
            <div class="invalid-feedback">
            {{ $message }}
            </div>
            @enderror
        </div>
        
        <div class="pdf selectt mb-3" style="display: none;">
          <label for="pdf" class="form-label @error('pdf') is-invalid @enderror">PDF</label>
          <img class="img-preview img-fluid mb-3 col-sm-5">
          <input class="form-control" type="file" id="pdf" name="pdf" onchange="previewImage()">
          @error('pdf')
          <div class="invalid-feedback">
          {{ $message }}
          </div>
          @enderror
        </div>
        <button type="submit" class="btn btn-primary" >Submit</button>
      </form>
      <script type="text/javascript">
        $(document).ready(function() {
            $('input[type="radio"]').click(function() {
                var inputValue = $(this).attr("value");
                var targetBox = $("." + inputValue);
                $(".selectt").not(targetBox).hide();
                $(targetBox).show();
            });
        });
    </script>
  </div>
@endsection