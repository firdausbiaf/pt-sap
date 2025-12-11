@extends('layout.dashboard.main')
@section('content')
   

  
  <div class="table-responsive col-lg-8 mx-5 mt-4">
    {{-- <a href="/admin/tugas/create" class="btn btn-primary mb-3">Tambah tugas</a> --}}
    <table class="table table-striped table-sm">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Data Tugas</h1>
      </div>
        @if (session()->has('success'))
      <div class="alert alert-success col-lg-12" role="alert">
        {{ session('success') }}
      </div>
      @endif
      <thead>
        <tr>
          <th scope="col">Bimbel</th>
          <th scope="col">Subject</th>
          <th scope="col">Nama Member</th>
          <th scope="col">Tugas</th>
          <th scope="col">Nilai</th>
          <th scope="col">Action</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($tugas as $t)

        <tr>
                      <!-- Modal -->
            <div class="modal fade " id="nilaiModal{{ $t->id }}" tabindex="-1" aria-labelledby="nilaiModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="nilaiModalLabel">Penilaian</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form method="post" action="/admin/tugas/{{ $t->id }}">
                    @method('put')
                    @csrf
                    <div class="modal-body">
                        Silahkan beri nilai
                        <div class="mb-3">
                          {{-- <input class="form-control" type="text" id="nilai" name="nilai" value="{{ $t->id }}"> --}}
                            <input class="form-control" type="number" id="nilai" name="nilai">
                            @error('nilai')
                            <div class="invalid-feedback">
                            {{ $message }}
                            </div>
                            @enderror
                        </div>
                        </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" onclick="return confirm('Apakah anda yakin?')">Submit</button>
                    </div>
                </form>
                </div>
                </div>
            </div>
          <td>{{ $t->materi->course->title }}</td>
          <td>{{ $t->materi->subject }}</td>
          <td>{{ $t->user->name }}</td>
          <td>
            <a href="{{ asset('storage/' . $t->pdf) }}"><h4><i class="menu-icon mdi mdi-file-pdf mdi-36px icon-red me-2"></i></h4></a>
          </td>
          <td>
            @if ($t->nilai == null)
                Belum dinilai
            @else
                {{ $t->nilai }} / 100
            @endif
          </td>
          <td>
            {{-- <a href="/admin/tugas/{{ $t->id }}" class="badge bg-info" style="text-decoration: none;">Show</a> --}}
            {{-- <a href="/admin/tugas/{{ $t->id }}/edit" class="badge bg-warning" style="text-decoration: none;">Edit</a>
            <form action="/admin/tugas/{{ $t->id }}" method="post" class="d-inline">
              @method('delete')
              @csrf
              <button class="badge bg-danger border-0" onclick="return confirm('Apakah anda yakin?')" >Delete</button>
            </form> --}}
            @if ($t->nilai == null)
                <button type="button" class="btn btn-sm btn-info text-dark" data-bs-toggle="modal" data-bs-target="#nilaiModal{{ $t->id }}">beri nilai</button>
            @else
                <p class="badge bg-success">Selesai</p>
            @endif
          </td>
        </tr>
        @endforeach    
      </tbody>
    </table>
    <div class="d-flex justify-content-center">
      {{ $tugas->links() }}
    </div>
  </div>

@endsection