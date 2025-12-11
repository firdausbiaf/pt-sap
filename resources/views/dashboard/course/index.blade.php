@extends('layout.dashboard.main')
@section('content')


<div class="container mx-5 mt-4">
 

    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
        <h1 class="h2">Data Bimbel</h1>
    </div>
    <form action="/admin/course">
            <div class="input-group w-100 mb-3">        
                <input type="text" class="form-control w-60 d-inline" placeholder="Cari Bimbel" name="search" value="{{ request('search') }}">
                <button class="btn btn-dark" type="submit">Search</button>
            </div>
    </form>
        @if (session()->has('successAdd'))
      {{-- <div class="alert alert-success col-lg-12" role="alert">
        {{ session('success') }}
      </div> --}}
      <script>
        $(document).ready(function(){
          $(".modal-title").text("Success !!");
          $(".modal-body p").text("{{ session('successAdd') }}");
          $("#myModal1").modal('show');
        });
      </script>
        @elseif(session()->has('success'))
        <script>
          $(document).ready(function(){
            $(".modal-title").text("Success!!");
            $(".modal-body p").text("{{ session('success') }}");
            $("#myModal").modal('show');
          });
        </script>
        @endif

    <div class="row">
        @foreach ($course as $c)
            <div class="col-md-4 mb-3">
                <div class="card">
                    <div style="max-height: 500px; overflow:hidden">
                        <img src="{{ asset('storage/' . $c->photo) }}" class="card-img-top" alt="{{ $c->photo }}">
                     </div>
                    <div class="card-body">
                    <h5 class="card-title">{{ $c->title }}</h5>
                    <p class="card-text">{{ $c->deskripsi }}</p>
                    {{-- <p class="card-text"><small class="text-muted">Last updated {{ $p->created_at->diffForHumans() }}</small></p> --}}
                    <a href="/admin/course/{{ $c->id }}" class="badge bg-info" style="text-decoration: none;">Show</a>
                    <a href="/admin/course/{{ $c->id }}/edit" class="badge bg-warning" style="text-decoration: none;">Edit</a>
                    <form action="/admin/course/{{ $c->id }}" method="post" class="d-inline">
                      @method('delete')
                      @csrf
                      <button class="badge bg-danger border-0" onclick="return confirm('Apakah anda yakin ingin menghapus?')" >Delete</button>
                    </form>
                    </div>
                </div>
            </div>
        @endforeach
        
        <div class="d-flex justify-content-center">
        </div>
        <div id="myModal" class="modal fade ">
          <div class="modal-dialog">
              <div class="modal-content ">
                  <div class="modal-header bg-success text-center">
                      <h5 class="modal-title"></h5>
                      
                  </div>
                  <div class="modal-body">
              <p></p>
              
                  </div>
              </div>
          </div>
        </div>
        @if ($course->count())
        <div id="myModal1" class="modal fade ">
          <div class="modal-dialog">
              <div class="modal-content ">
                  <div class="modal-header bg-success text-center">
                      <h5 class="modal-title"></h5>
                      
                  </div>
                  <div class="modal-body">
                  <p></p>
                  </div>
                  <div class="modal-footer">
                    <form action="/admin/materi">
                      @csrf
                    <input type="hidden" name="course_id" id="course_id" value="{{ $c->id }}">
                    <button type="submit" class="btn btn-primary" >Tambah Materi</button>
                  </form>
                    {{-- <a href="/materi/{{ $c->id }}" class="btn btn-primary">Tambah Materi</a> --}}
                  </div>
              </div>
          </div>
        </div>
        @else
          <p class="text-center fs-4">Bimbel tidak ditemukan.</p>
        @endif 
    </div>
   
</div>


@endsection