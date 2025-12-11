@extends('layout.dashboard.main')
@section('content')
   
  <div class="col-lg-8 mx-5 mt-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Edit Member</h1>
      </div>
      <form method="post" action="/admin/member/{{ $user->id }}" class="mb-5" enctype="multipart/form-data">
        @method('put')
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Nama Member</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $user->name) }}">
              @error('name')
              <div class="invalid-feedback">
              {{ $message }}
              </div>
              @enderror
          </div>
          <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email', $user->email) }}">
              @error('email')
              <div class="invalid-feedback">
              {{ $message }}
              </div>
              @enderror
          </div>
          <div class="mb-3">
            <label for="phone" class="form-label">Phone Number</label>
            <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" value="{{ old('phone', $user->phone) }}">
              @error('phone')
              <div class="invalid-feedback">
              {{ $message }}
              </div>
              @enderror
          </div>
          {{-- <div class="mb-3">
            <label for="photo" class="form-label @error('photo') is-invalid @enderror">Photo Member</label>
            <input type="hidden" name="oldPhoto" value="{{ $user->photo }}">
            @if ($user->photo)
            <img src="{{ asset('storage/' . $user->photo) }}" class="img-preview img-fluid mb-3 col-sm-5 d-block">
            @else
            <img class="img-preview img-fluid mb-3 col-sm-5">
            @endif
            <input class="form-control" type="file" id="photo" name="photo"  onchange="previewImage()">
            @error('photo')
            <div class="invalid-feedback">
            {{ $message }}
            </div>
            @enderror
          </div> --}}
        
        <button type="submit" class="btn btn-primary">Submit</button>
      </form>
  </div>

  <script>

    function previewImage(){
      const image = document.querySelector('#photo');
      const imgPreview = document.querySelector('.img-preview');

      imgPreview.style.display = 'block';

      const oFReader = new FileReader();
      oFReader.readAsDataURL(image.files[0]);

      oFReader.onload = function(oFREvent){
        imgPreview.src = oFREvent.target.result;
      }

    }
    
  </script>

@endsection