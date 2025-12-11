@extends('layout.dashboard.main')

@section('content')
<div class="table-responsive col-lg-10 mx-5 mt-4">
    <h2>Data Pembelian</h2><br>
    <a href="{{ route('data.create') }}" class="btn btn-primary mx-2">Tambah Data</a>

    <!-- Button trigger modal -->
    <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#exampleModal">
      Import
    </button>

    <div class="row justify-content-end mb-3">
      <div class="col-md-4">
          <form action="{{ route('data.search') }}" method="GET">
              <div class="input-group">
                  <input type="text" class="form-control" placeholder="Cari.... " name="search">
                  <button class="btn btn-danger btn-sm" type="submit">Cari</button>
              </div>
          </form>
      </div>
  </div>
  
  
  
  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Input Excel</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="/importexcel" method="POST" action="/upload" enctype="multipart/form-data">
        @csrf
        
        <div class="modal-body">
            <div class="form group">
                <input type="file" name="file" required>
          ...
        </div>
    </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save changes</button>
        </div>
      </div>
    </form>
    </div>
  </div>
  <div class="table-responsive">
    <table class="table table-striped table-sm">
        <thead>
            <tr>
                <th scope="col">No.</th>
                <th scope="col">Nama User</th>
                <th scope="col">Telepon</th>
                <th scope="col">Lokasi</th>
                <th scope="col">Cluster</th>
                <th scope="col">Kavling</th>
                <th scope="col">Tipe</th>
                <th scope="col">SPK</th>
                <th scope="col">PTB</th>
                <th scope="col">Harga Deal</th>
                <th scope="col">Progres (%)</th>
                <th scope="col">Sales</th>
                <th scope="col">Berkas</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @php
              $count = 1; 
            @endphp
            @foreach ($data as $item)
            <tr @if ($item->progres == 100) style="background-color: #C1FF7A;" @endif>
                <td>{{ $count }}</td> <!-- Display the incrementing number -->
                @php
                    $count++; // Increment the counter
                @endphp
                <td>{{ $item->user->name }}</td>
                <td>{{ $item->user->phone }}</td>
                <td>{{ $item->lokasi }}</td>
                <td>{{ $item->kluster }}</td>
                <td>{{ $item->kavling }}</td>
                <td>{{ $item->tipe }}</td>
                <td>{{ $item->spk }}</td>
                <td>{{ $item->ptb }}</td>
                <td>{{ $item->harga_deal }}</td>
                <td>{{ $item->progres }} %</td>
                <td>{{ $item->sales }}</td>
                <td>
                  <a href="{{ route('data.view_ktp', $item->id) }}" class="badge bg-success" style="text-decoration: none;">Klik</a>

                </td>
                <td>
                    <a href="{{ route('data.show', $item->id) }}" class="badge bg-info" style="text-decoration: none;">Show</a>
                    <a href="{{ route('data.edit', $item->id) }}" class="badge bg-warning" style="text-decoration: none;">Edit</a>
                    <form action="{{ route('data.destroy', $item->id) }}" method="post" class="d-inline">
                        @method('delete')
                        @csrf
                        <button class="badge bg-danger border-0" onclick="return confirm('Apakah anda yakin?')">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
  </div>
  <div class="d-flex justify-content-center">
    {{ $data->links() }}
  </div>
</div>
@endsection
