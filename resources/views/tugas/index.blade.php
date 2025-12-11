@extends('layout.main')

@section('content')
<div class="col d-flex justify-content-center">  
  <div class="card" style="width: 80rem; opacity: 65%; margin-top: 5%;">
    <div class="table-responsive col-lg-6 mx-5 my-4">
      <div class="container my-3">
        <div class="text-left">
            <form action="/member/tugas/create" method="get" class="d-inline">
              @csrf
              @if (session()->has('materi_id'))
              <input type="hidden" name="materi_id" id="materi_id" value="{{  session('materi_id')}}">
              @else
              <input type="hidden" name="materi_id" id="materi_id" value="{{ $materi_id }}">
              @endif
              <button type="submit" class="btn btn-primary mb-3" ><span></span>Upload Tugas</button>
              </form>
              {{-- <a href="/member/tugas/{{ (array) $materi_id }}/create" class="btn btn-primary mb-3"><span class="menu-icon mdi mdi-plus"></span>Tambah Pertemuan</a> --}}
        </div>
          <table class="table table-striped table-sm">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap pt-3 pb-2 mb-3 border-bottom">
              <h1 class="h2">Tugas</h1>
            </div>
              @if (session()->has('success'))
            <div class="alert alert-success col-lg-12" role="alert">
              {{ session('success') }}
            </div>
            @endif
            <thead>
              <tr>
                {{-- <th scope="col">ID</th> --}}
                <th scope="col">Subject</th>
                <th scope="col">Media</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($tugas as $t)
              @if($t->materi_id == $materi_id)    
              <tr>
                {{-- <td>{{ $t->id }}</td> --}}
                    <td>
                      <a href="{{ asset('storage/' . $t->pdf)  }}" class="badge bg-danger"><span class="menu-icon mdi mdi-file-pdf mdi-24px"></span></a>   
                    </td>
                
                <td>
                  {{-- <a href="/member/tugas/{{ $t->id }}" class="badge bg-info"><span class="menu-icon mdi mdi-eye"></span></a> --}}
                  {{-- <a href="/member/tugas/{{ $t->id }}/edit" class="badge bg-warning"><span class="menu-icon mdi mdi-circle-edit-outline"></span></a> --}}
                  <form action="/member/tugas/{{ $t->id }}/edit" class="d-inline">
                    @csrf
                    @if (session()->has('materi_id'))
                    <input type="hidden" name="materi_id" id="materi_id" value="{{  session('materi_id')}}">
                    @else
                    <input type="hidden" name="materi_id" id="materi_id" value="{{ $materi_id }}">
                    @endif
                    <button class="badge bg-warning border-0"><span class="menu-icon mdi mdi-circle-edit-outline"></button>
                  </form>
                  <form action="/member/tugas/{{ $t->id }}" method="post" class="d-inline">
                    @method('delete')
                    @csrf
                    @if (session()->has('materi_id'))
                    <input type="hidden" name="materi_id" id="materi_id" value="{{  session('materi_id')}}">
                    @else
                    <input type="hidden" name="materi_id" id="materi_id" value="{{ $materi_id }}">
                    @endif
                    <button class="badge bg-danger border-0" onclick="return confirm('Apakah anda yakin?')" ><span class="menu-icon mdi mdi-backspace"></button>
                  </form>
                </td>
              </tr>
              @endif
              @endforeach    
            </tbody>
          </table>
          <a href="/myCourse/{id}" class="btn btn-success my-3">Back</a>
      </div>
    </div>
  </div>
</div>
@endsection