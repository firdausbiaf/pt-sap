@extends('layout.main')

@section('content')

  <!-- Modal -->
  <div class="modal fade" id="tugasModal" tabindex="-1" aria-labelledby="tugasModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="tugasModalLabel">Pengumpulan Tugas</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form method="post" action="/tugasMember" enctype="multipart/form-data">
          @csrf
          <div class="modal-body">
              Silahkan kumpulkan file tugas
              <input type="hidden" name="materi_id" id="materi_id" value="{{ $materi->id }}">
              <div class="mb-3">
                <img class="img-preview img-fluid my-3 col-sm-5">
                <input class="form-control" type="file" id="pdf" name="pdf">
                @error('pdf')
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


<div class="container my-3"> 
    <div class="row justify-content-center align-items-center">
        <div class="card Mycourse"  style="width: 100%;">
            <h2 class="me-3 my-3"> Kelas {{ $materi->course->category->name }} : {{ $materi->course->title }}</h2>
            <p class="ms-2 linked"><a href="/">Home</a> / <a href="/courseMember">My Class</a> / <a href="/tugasMember/{{ $materi->id }}">Tugas {{$materi->subject}}</a></p>
        </div>
    </div>
    <div class="row justify-content-center align-items-center mt-2 mb-3">
        <div class="card Mycourse"  style="width: 100%;">
            <h2 class="me-3 my-3"> Tugas {{ $materi->subject }}</h2>
            <h6 class="ms-4 my-2">Silahkan kumpulkan tugas dengan format pdf</h6>
            <h4 class="my-3">Submission Status</h4>
            <table class="table table-striped ">
                <tbody>
                    {{-- <tr>
                    <th class="col-2">Status Tugas</th>
                    <td class="col-8">Untuk dinilai</td>
                    </tr> --}}
                    <tr>
                    <th>Status Nilai</th>
                    @if ($tugas == null)
                        <td>Belum dinilai</td>
                    @else
                        @if ($tugas->nilai == null)
                            <td>Belum dinilai</td>
                        @elseif ($tugas->nilai > 60)
                            <td class="table-success">{{ $tugas->nilai }} / 100</td>
                        @else
                            <td class="table-danger">{{ $tugas->nilai }} / 100</td>
                        @endif
                        
                    @endif
                    
                    </tr>
                    <tr>
                    <th>Status Pengumpulan</th>
                        @if ($tugas == null)
                            <td>Belum ada pengumpulan</td>
                        @else
                            <td class="table-success">Tugas sudah dikumpulkan</td>
                        @endif
                    </tr>
                </tbody>
            </table>
            <div class="text-center my-3">
                @if ($tugas == null)
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tugasModal">Upload Tugas</button>
                @else
                    {{-- <button type="button" class="btn btn-secondary">Edit</button> --}}
                    <form action="/tugasMember/{{ $tugas->id }}" method="post" class="d-inline">
                        @method('delete')
                        @csrf
                        <input type="hidden" name="materi_id" id="materi_id" value="{{ $materi->id }}">
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah anda yakin ingin menghapus?')">Hapus</button>
                    </form>
                @endif
                
            </div>
        </div>
    </div>

</div>

@endsection