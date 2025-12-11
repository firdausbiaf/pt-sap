@extends('layout.dashboard.main')
@section('content')
   
  
  
  <div class="table-responsive col-lg-6 mx-5 my-4">
    <div class="text-left">

      <form action="/admin/materi/create" method="get" class="d-inline">
        @csrf
        @if (session()->has('course_id'))
        <input type="hidden" name="course_id" id="course_id" value="{{  session('course_id')}}">
        @else
        <input type="hidden" name="course_id" id="course_id" value="{{ $course_id }}">
        @endif
        <button type="submit" class="btn btn-primary mb-3" ><span class="menu-icon mdi mdi-plus me-4"></span>Tambah Materi</button>
        </form>
        {{-- <a href="/admin/materi/{{ (array) $course_id }}/create" class="btn btn-primary mb-3"><span class="menu-icon mdi mdi-plus"></span>Tambah Pertemuan</a> --}}
    </div>
    <table class="table table-striped table-sm">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Pertemuan</h1>
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
        @foreach ($materi as $m)
        @if($m->course_id == $course_id)    
        <tr>
          {{-- <td>{{ $m->id }}</td> --}}
          <td>{{ $m->subject }}</td>
          @if ($m->pdf == null)
            <td>
              <p>null</p>   
            
            </td>
          @else
              <td>
                <a href="{{ asset('storage/' . $m->pdf)  }}" class="badge bg-danger"><span class="menu-icon mdi mdi-file-pdf mdi-24px"></span></a>   
              </td>
          @endif
          
          <td>
            {{-- <a href="/admin/materi/{{ $c->id }}" class="badge bg-info"><span class="menu-icon mdi mdi-eye"></span></a> --}}
            {{-- <a href="/admin/materi/{{ $m->id }}/edit" class="badge bg-warning"><span class="menu-icon mdi mdi-circle-edit-outline"></span></a> --}}
            <form action="/admin/materi/{{ $m->id }}/edit" class="d-inline">
              @csrf
              @if (session()->has('course_id'))
              <input type="hidden" name="course_id" id="course_id" value="{{  session('course_id')}}">
              @else
              <input type="hidden" name="course_id" id="course_id" value="{{ $course_id }}">
              @endif
              <button class="badge bg-warning border-0"><span class="menu-icon mdi mdi-circle-edit-outline"></button>
            </form>
            <form action="/admin/materi/{{ $m->id }}" method="post" class="d-inline">
              @method('delete')
              @csrf
              @if (session()->has('course_id'))
              <input type="hidden" name="course_id" id="course_id" value="{{  session('course_id')}}">
              @else
              <input type="hidden" name="course_id" id="course_id" value="{{ $course_id }}">
              @endif
              <button class="badge bg-danger border-0" onclick="return confirm('Apakah anda yakin?')" ><span class="menu-icon mdi mdi-backspace"></button>
            </form>
          </td>
        </tr>
        @endif
        @endforeach    
      </tbody>
    </table>
    <a href="/admin/course" class="btn btn-success my-3">Back</a>
  </div>

@endsection