@extends('layout.main')

@section('content')

<div class="row justify-content-center">
    <div class="col-md-8 mb-5 mt-5">
      <h1 class="my-4 text-center text-light">
    <b> Program Bimbingan Belajar </b>
</h1>
        <form action="/course">
            <div class="input-group mb-4 mt-3">
             
                <input type="text" class="form-control" placeholder="Cari Produk" name="search" value="{{ request('search') }}">
                <button class="btn btn-dark" type="submit">Search</button>
              </div>
        </form>
    </div>
</div>

@if (session()->has('success'))
<script>
  $(document).ready(function(){
    $(".modal-title").text("Success !!");
    $(".modal-body p").text("{{ session('success') }}");
    $("#myModal").modal('show');
  });
</script>
  @endif

@if ($course->count())
<!-- <div class="card mb-4">
    <div style="max-height: 400px; overflow:hidden">
        <img src="{{ asset('storage/' . $course[0]->photo) }}" class="card-img-top" alt="{{ $course[0]->photo }}" class="img-fluid ">
    </div>
    <div class="card-body text-center">
      <h5 class="card-title">{{ $course[0]->title }}</h5>
      <p class="card-text"> {{ $course[0]->category->name }}</p>
      <p class="card-text"> Rp.{{ $course[0]->harga }}</p>
      <p class="card-text"><small class="text-muted">Last updated {{ $course[0]->created_at->diffForHumans() }}</small></p>
      <a href="/course/{{ $course[0]->id }}" class="btn btn-primary">More Info</a>
    </div>
  </div> -->
@else
  <p class="text-light text-center fs-4">Produk masih belum tersedia.</p>
@endif
    
<div class="container">
    <div class="row">
        @foreach ($course as $p)
            <div class="col-md-4 mb-4">
                <div class="card">
                    <div style="max-height: 500px; overflow:hidden">
                        <img src="{{ asset('storage/' . $p->photo) }}" class="card-img-top" alt="{{ $p->title }}">
                     </div>
                    <div class="card-body">
                    <h5 class="card-title">{{ $p->title }}</h5>
                    <p class="card-text">Rp.{{ $p->harga }}</p>
                    <p class="card-text"><small class="text-muted">Last updated {{ $p->created_at->diffForHumans() }}</small></p>
                    <a href="/course/{{ $p->id }}" class="btn btn-primary">More Info</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

<nav aria-label="Page navigation example">
  <ul class="pagination justify-content-center">
      {{$course->links()}}
  </ul>
</nav>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header bg-success">
          <h5 class="modal-title"></h5>
          
        </div>
        <div class="modal-body">
          <p></p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <a href="/transaksiMember" class="btn btn-primary">Go To Transaction</a>
        </div>
      </div>
    </div>
  </div>
@endsection