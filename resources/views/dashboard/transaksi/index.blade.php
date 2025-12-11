@extends('layout.dashboard.main')
@section('content')
   
  
  
  <div class="table-responsive col-lg-8 mx-5 mt-4">
    <table class="table table-striped table-sm">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Data Transaksi</h1>
      </div>
      <a href="/laporanTransaksi" type="button" class="d-inline btn btn-primary btn-sm my-2 ">
        <i class="bi bi-printer"></i>
        <b>Cetak Transaksi</b>
      </a>
        @if (session()->has('success'))
      <div class="alert alert-success col-lg-12" role="alert">
        {{ session('success') }}
      </div>
      @endif
      <thead>
        <tr>
          <th scope="col">ID</th>
          <th scope="col">Tanggal</th>
          <th scope="col">Member</th>
          <th scope="col">Bimbel</th>
          <th scope="col">Bukti</th>
          <th scope="col">Verify</th>
          <th scope="col">Action</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($transaksi as $t)
        <!-- Modal -->
        <div class="modal fade " id="orderModal{{ $t->id }}" tabindex="-1" aria-labelledby="orderModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered">
              <div class="modal-content">
                  <div class="modal-header">
                  <h5 class="modal-title" id="orderModalLabel">Bukti Pembayaran</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="card" >
                    <img src="{{ asset('storage/' . $t->bukti) }}" class="card-img-top" alt="{{ $t->course->title }}{{ $t->user->name  }}">
                  </div>                 
                  <div class="modal-footer">
                    @if ($t->verify == 0)
                      <form action="/verifyTransaksi" method="get" class="d-inline">
                      @csrf
                      <input type="hidden" name="id" value="{{ $t->id }}">
                      <button type="submit" class="badge bg-warning border-0" >Verify Now !!</button>
                      </form>
                    @else
                      <h4><span class="badge bg-success">verified</span></h4>
                    @endif
                  </div>
                  </form>
              </div>
          </div>
      </div>
        <tr>
          <td>{{ $t->id }}</td>
          <td>{{ \Carbon\Carbon::parse($t->created_at)->format('d/m/Y') }}</td>
          <td>{{ $t->user->name }}</td>
          <td>{{ $t->course->title }}</td>
          <td>
            @if ($t->bukti == null)
              Belum Bayar
            @else
              <img src="{{ asset('storage/' . $t->bukti) }}" alt="{{ $t->course->title }}{{ $t->user->name  }}">
            @endif
            
          </td>
          <td>
              @if ($t->bukti == null)
                -
              @else
                @if( $t->verify  == 0)
                <form action="/verifyTransaksi" method="get" class="d-inline">
                @csrf
                <input type="hidden" name="id" value="{{ $t->id }}">
                <button type="submit" class="badge bg-warning border-0" >Verify</button>
                </form>
                @else
                <h4><span class="badge bg-success">verified</span></h4>

                @endif
              @endif       
              
            
          </td>
          <td>
            <a href="#orderModal{{ $t->id }}" data-bs-toggle="modal" class="badge bg-info" style="text-decoration: none;">Show</a>
            {{-- <a href="/admin/member/{{ $t->id }}/edit" class="badge bg-warning" style="text-decoration: none;">Edit</a> --}}
            <form action="/transaksi/{{ $t->id }}" method="post" class="d-inline">
              @method('delete')
              @csrf
              <button class="badge bg-danger border-0" onclick="return confirm('Apakah anda yakin?')" >Delete</button>
            </form>
          </td>
        </tr>
        @endforeach    
      </tbody>
    </table>
    <div class="d-flex justify-content-center">
      {{ $transaksi->links() }}
    </div>
  </div>

@endsection