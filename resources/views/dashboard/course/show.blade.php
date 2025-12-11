@extends('layout.dashboard.main')

@section('content')
  
<div class="container my-5">
    <div class="row justify-content-center align-items-center">
        <div class="card"  style="width: 30rem;">
            <img src="{{ asset('storage/' . $course->photo) }}" class="card-img-top" alt="{{ $course->title }}">
            <div class="card-header ">
               Detail Course
            </div>
            <div class="card body">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item"><b>Title Bimbel :  </b>{{ $course->title }}</li>
                    <li class="list-group-item"><b>Deskripsi Singkat :  </b>{{ $course->deskripsi }}</li>
                    <li class="list-group-item"><b>Kelas : </b>{{ $course->category->name }}</li> 
                    <li class="list-group-item"><b>Persyaratan : </b>{{ $course->requirment }}</li>
                    <li class="list-group-item"><b>Hasil Pencapaian : </b>{{ $course->outcome }}</li>
                    <li class="list-group-item"><b>Harga : </b>Rp.{{ $course->harga }}</li>
                    <li class="list-group-item"><b>Pertemuan : </b>
                        <form action="/admin/materi" class="d-inline mx-3">
                            @csrf
                          <input type="hidden" name="course_id" id="course_id" value="{{ $course->id }}">
                          <button type="submit" class="badge bg-primary border-0" >Lihat Pertemuan</button>
                        </form>
                    </li>
            </div>
            <a class="btn btn-success mt-3 mb-3" href="/admin/course">kembali</a>
        </div>
    </div>
</div>


@endsection
