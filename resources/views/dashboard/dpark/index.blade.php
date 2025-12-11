@extends('layout.dashboard.main')

@section('content')
<div class="table-responsive col-lg-10 mx-5 mt-4">
    <div class="row mb-3">
        <div class="col-md-6">
            <h2>Stok DPARK CITY</h2><br>
            <a href="{{ route('stok-dpark.create') }}" class="btn btn-primary mb-3">Tambah Stok</a>
        </div>
    </div>
    
    <ul class="nav nav-tabs">
        @foreach ($clusterOptions as $cluster)
            <li class="nav-item">
                <a class="nav-link {{ $loop->first ? 'active' : '' }}" data-toggle="tab" href="#{{ Str::slug($cluster) }}">{{ $cluster }}</a>
            </li>
        @endforeach
    </ul>

    <div class="tab-content">
        @foreach ($clusterOptions as $cluster)
            <div id="{{ Str::slug($cluster) }}" class="tab-pane fade {{ $loop->first ? 'show active' : '' }}">
                <div class="input-group mb-3 mt-3">
                    <input type="text" class="form-control search-input" placeholder="Cari Kavling...">
                </div>
                <table class="table table-striped table-sm">
                    <thead>
                        <tr>
                            <th scope="col">No.</th>
                            <th scope="col">Kavling</th>
                            <th scope="col">Status</th>
                            <th scope="col">Keterangan</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $count = 1;
                        @endphp
                        @foreach ($clusterData[$cluster] as $dp)
                            <tr class="data-row">
                                <td>{{ $count }}</td>
                                @php
                                    $count++;
                                @endphp
                                <td>{{ $dp->kavling }}</td>
                                <td>
                                    @if ($dp->status == 0)
                                        <form action="/sold-dpark" method="get" class="d-inline">
                                            @csrf
                                            <input type="hidden" name="id" value="{{ $dp->id }}">
                                            <button type="submit" class="badge bg-danger border-0"><span>SOLD</span></button>
                                        </form>
                                    @else
                                        <form action="/open-dpark" method="get" class="d-inline">
                                            @csrf
                                            <input type="hidden" name="id" value="{{ $dp->id }}">
                                            <button type="submit" class="badge bg-success border-0"><span>OPEN</span></button>
                                        </form>
                                    @endif
                                </td>
                                <td>{{ $dp->keterangan }}</td>
                                <td>
                                    <a href="{{ route('stok-dpark.show', $dp->id) }}" class="badge bg-info" style="text-decoration: none;">Show</a>
                                    <a href="{{ route('stok-dpark.edit', $dp->id) }}" class="badge bg-warning" style="text-decoration: none;">Edit</a>
                                    <form action="{{ route('stok-dpark.destroy', $dp->id) }}" method="post" class="d-inline">
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
                    {{ $clusterData[$cluster]->links() }}
                </div>
            </div>
        @endforeach
    </div>
</div>

<script>
    // Mendapatkan elemen input pencarian
    const searchInputs = document.querySelectorAll('.search-input');

    // Menambahkan event listener untuk setiap input pencarian
    searchInputs.forEach(searchInput => {
        searchInput.addEventListener('input', function() {
            const searchTerm = searchInput.value.trim().toLowerCase();
            const dataRows = searchInput.closest('.tab-pane').querySelectorAll('.data-row');

            // Loop melalui setiap baris data dan memeriksa apakah kavling cocok dengan pencarian
            dataRows.forEach(row => {
                const kavlingCell = row.querySelector('td:nth-child(2)');
                const kavlingText = kavlingCell.textContent.toLowerCase();

                // Menampilkan atau menyembunyikan baris berdasarkan pencocokan
                if (kavlingText.includes(searchTerm)) {
                    row.style.display = 'table-row';
                } else {
                    row.style.display = 'none';
                }
            });
        });
    });
</script>

@endsection
