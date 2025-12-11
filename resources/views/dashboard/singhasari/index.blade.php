@extends('layout.dashboard.main')

@section('content')
<div class="table-responsive col-lg-10 mx-5 mt-4">
    <div class="row mb-3">
        <div class="col-md-6">
            <h2>Singhasari</h2><br>
            <a href="{{ route('stok-singhasari.create') }}" class="btn btn-primary mb-3">Tambah Stok Singhasari</a>
            <div class="input-group mb-3">
                <input type="text" class="form-control" id="searchInput" placeholder="Cari Kavling...">
            </div>
        </div>
    </div>
    
    <table class="table table-striped table-sm">
        <thead>
            <tr>
                <th scope="col">No.</th>
                <th scope="col">Cluster</th>
                <th scope="col">Kavling</th>
                <th scope="col">Status</th>
                <th scope="col">Keterangan</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody id="tableBody">
            @php
                $count = 1; 
            @endphp
            @foreach ($singhasaris as $singha)
            <tr>
                <td>{{ $count }}</td> <!-- Display the incrementing number -->
                @php
                    $count++; // Increment the counter
                @endphp
                <td>{{ $singha->kluster }}</td>
                <td>{{ $singha->kavling }}</td>
                {{-- <td>{{ $singha->stok }}</td> --}}
                <td>       
                    @if( $singha->status  == 0)
                    <form action="/sold-singhasari" method="get" class="d-inline">
                    @csrf
                    <input type="hidden" name="id" value="{{ $singha->id }}">
                    <button type="submit" class="badge bg-danger border-0" ><span>SOLD</span></button>
                    </form>

                    @else
                    <form action="/open-singhasari" method="get" class="d-inline">
                    @csrf
                    <input type="hidden" name="id" value="{{ $singha->id }}">
                    <button type="submit" class="badge bg-success border-0" ><span>OPEN</span></button>
                    </form>

                    @endif          
                </td>
                <td>{{ $singha->keterangan }}</td>
                <td>
                    <a href="{{ route('stok-singhasari.show', $singha->id) }}" class="badge bg-info" style="text-decoration: none;">Show</a>
                    <a href="{{ route('stok-singhasari.edit', $singha->id) }}" class="badge bg-warning" style="text-decoration: none;">Edit</a>
                    <form action="{{ route('stok-singhasari.destroy', $singha->id) }}" method="post" class="d-inline">
                        @method('delete')
                        @csrf
                        <button class="badge bg-danger border-0" onclick="return confirm('Apakah anda yakin?')">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="d-flex justify-content-center">
        {{ $singhasaris->links() }}
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    // Mendapatkan elemen input pencarian
    const searchInput = $('#searchInput');

    // Menambahkan event listener untuk memantau perubahan pada input pencarian
    searchInput.on('input', function() {
        const searchTerm = searchInput.val().trim().toLowerCase();

        // Mendapatkan semua baris data pada tabel
        const rows = $('#tableBody tr');

        // Loop melalui setiap baris data dan memeriksa apakah kavling cocok dengan pencarian
        rows.each(function() {
            const kavlingCell = $(this).find('td:nth-child(3)');
            const kavlingText = kavlingCell.text().toLowerCase();

            // Menampilkan atau menyembunyikan baris berdasarkan pencocokan
            if (kavlingText.includes(searchTerm)) {
                $(this).show();
            } else {
                $(this).hide();
            }
        });
    });
</script>

@endsection
