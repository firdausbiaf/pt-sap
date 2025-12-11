@extends('layout.main')

@section('content')

<h1 class="my-5 text-center text-light">
    <b> My Transaction </b>
</h1>

@if (session()->has('success'))
<script>
  $(document).ready(function(){
    $(".modal-title").text("Success !!");
    $(".modal-body p").text("{{ session('success') }}");
    $("#myModal").modal('show');
  });
</script>
  @endif

<div class="container my-3">
    
    @foreach ($transaksi as $t)
    @if ($t->course->count())
        @if ($t->user_id == auth()->user()->id)
            <div class="row course align-items-center mb-3">
                <!-- Modal -->
                <div class="modal fade " id="orderModal{{ $t->id }}" tabindex="-1" aria-labelledby="orderModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                            <h5 class="modal-title" id="orderModalLabel">Pembayaran</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            
                            <form method="post" action="/bayar" enctype="multipart/form-data">
                            @csrf
                            <div class="modal-body">
                                Silahkan Mengirimkan bukti Pembayaran
                                <div class="mb-3">
                                    <img class="img-preview img-fluid my-3 col-sm-5">
                                    <input type="hidden" name="id" id="id" value="{{ $t->id }}">
                                    <input class="form-control" type="file" id="bukti" name="bukti" onchange="previewImage()">
                                    @error('bukti')
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
                <div class="col-auto">
                    {{-- <input type="checkbox" name="" id=""> --}}
                </div>
                <div class="col">
                    <div style="max-height: 500px; overflow:hidden" class="my-2">
                        <img src="{{ asset('storage/' . $t->course->photo) }}" class="card-img-top" alt="{{ $t->course->title }}">
                    </div>
                </div>
                <div class="col-6 text-dark mt-3">
                    <p><b>Title : </b>{{ $t->course->title }}</p>
                    <p><b>Kelas : </b>{{ $t->course->category->name }}</p>
                    <p><b>Harga : </b>Rp.{{ $t->course->harga }}</p>
                    <p><b>Pertemuan : </b>{{ $t->course->materi->count()}} Pertemuan</p>
                    
                </div>
                <div class="col">
                    @if ($t->bukti == null)
                    <button type="button" class="btn btn-primary my-2 btn-sm" data-bs-toggle="modal" data-bs-target="#orderModal{{ $t->id }}">
                        <i class="bi bi-bag-plus me-1"></i>
                        Pay Now!!
                    </button>
                    @else
                        @if ($t->verify == 0)
                        <h4><span class="badge bg-warning text-black"><i class="bi bi-dash-circle-dotted me-2"></i>Menunggu Verifikasi...</span></h4>
                        @else
                        <h4><span class="badge bg-success"><i class="bi bi-check-circle me-2"></i>Transaksi Selesai</span><h4>
                        @endif
                    @endif
                </div>
            </div>
        @endif
    @else
    <p class="text-light text-center fs-4">Anda Belum Memiliki transaksi apapun</p>
    @endif
    @endforeach

    <nav aria-label="Page navigation example">
        <ul class="pagination justify-content-center">
            {{-- {{$transaksi->links()}} --}}
        </ul>
    </nav>
    
</div>

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
          
        </div>
      </div>
    </div>
  </div>

@endsection