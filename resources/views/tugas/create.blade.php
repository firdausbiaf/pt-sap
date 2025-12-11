@extends('layout.main')

@section('content')
<div class="col d-flex justify-content-center">  
  <div class="card" style="width: 80rem; opacity: 65%; margin-top: 5%;">
    <div class="col-lg-4 mx-5 mt-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Upload Tugas</h1>
        </div>
          <div class="my-3">

            <label>
                <input type="radio" name="colorRadio" 
                      value="pdf"> PDF</label>
          </div>
          <form method="post" action="/member/tugas" class="mb-5" enctype="multipart/form-data">
            @csrf
            <div class="pdf selectt mb-3" style="display: none;">
              <input type="hidden" name="materi_id" id="materi_id" value="{{ $materi_id }}">
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
  </div>
</div>
@endsection