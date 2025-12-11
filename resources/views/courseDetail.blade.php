@extends('layout.main')

@section('content')

  <!-- Modal -->
  <div class="modal fade " id="orderModal" tabindex="-1" aria-labelledby="orderModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="hide modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="orderModalLabel">Pembayaran</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          Terima kasih telah mengambil kelas.<br>
          Pembayaran secara tunai dapat datang langsung ke tempat bimbingan belajar Fast<br><br>
          Pembayaran secara transfer dapat dilakukan melalui nomor rekening berikut:<br>
          BRI : 6287 0100 5040 530 (a/n SABELA FURI ASTARI S)
        </div>
        <div class="modal-footer">
            <form method="post" action="/transaksi">
              @csrf
                <input type="hidden" name="course_id" id="course_id" value="{{ $course->id }}">
               {{-- <button type="submit" class="btn btn-secondary" data-bs-dismiss="modal" onclick="return confirm('Apakah anda yakin?')">Bayar Nanti</button> --}}
            </form>
             <button type="button" class="btn btn-primary" value="purchase" id="hide">Bayar Sekarang</button>
        </div>
      </div>
      <div class="purchase modal-content" style="display: none;">
        <div class="modal-header">
          <h5 class="modal-title" id="orderModalLabel">Pembayaran</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form method="post" action="/transaksi" enctype="multipart/form-data">
          @csrf
          <div class="modal-body">
              Silahkan Mengirimkan Bukti Pembayaran<br><br>
              <b>Pembayaran secara tunai berupa nota/kwitansi pembayaran</b><br>
              <b>Pembayaran secara transfer berupa bukti transfer</b>
              <input type="hidden" name="course_id" id="course_id" value="{{ $course->id }}">
              <div class="mb-3">
                <img class="img-preview img-fluid my-3 col-sm-5">
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

<h1 class="mt-3 mb-3 text-center text-light">
    <b>Detail Bimbingan Belajar</b>
</h1>

<div class="container mt-3 mb-3">
    <div class="row justify-content-center align-items-center">
        <div class="card"  style="width: 30rem;">
            <img src="{{ asset('storage/' . $course->photo) }}" class="card-img-top" alt="{{ $course->nama }}">
            <div class="card-header">
                <b>{{ $course->title }}</b>
            </div>
            <div class="card body">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item"><b>Kelas : </b>{{ $course->category->name }}</li>
                    <li class="list-group-item"><b>Persyaratan :  </b>{{ $course->requirment }}</li>
                    <li class="list-group-item"><b>Hasil Pencapaian : </b>{{ $course->outcome }}</li>
                    <li class="list-group-item"><b>Deskripsi : </b>{{ $course->deskripsi }}</li>
                    <li class="list-group-item"><b>Harga : </b>Rp.{{ $course->harga }}</li>
                    <li class="list-group-item"><b>Jumlah Pertemuan : </b>{{ $course->materi->count() }} Pertemuan</li>
            </div>

            <div class="card-footer text-muted">
                <a class="btn btn-danger my-2" href="/course"><i class="bi bi-arrow-bar-left me-2"></i>kembali</a>
                @auth
                <button type="button" class="btn btn-success my-2 float-end" data-bs-toggle="modal" data-bs-target="#orderModal">
                    <i class="bi bi-bag-plus me-1"></i>
                    Ambil Kelas
                  </button>
                  @endauth
              </div>
            
        </div>
    </div>
    <script>
    $(document).ready(function(){
    $("#hide").click(function(){
    $(".purchase").show();
    $(".hide").hide();
        });
    });
    </script>
</div>

@endsection