@extends('layout.dashboard.main')

@section('content')
<div class="table-responsive col-lg-10 mx-5 mt-4">
    <div class="row mb-3">
        <div class="col-md-6">
            <h2>Stok BATU</h2><br>
            <a href="{{ route('stok-batu.create') }}" class="btn btn-primary mb-3">Tambah Stok</a>
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
                        @foreach ($clusterData[$cluster] as $batu)
                            <tr class="data-row">
                                <td>{{ $count }}</td>
                                @php
                                    $count++;
                                @endphp
                                <td>{{ $batu->kavling }}</td>
                                <td>
                                    @if ($batu->status == 0)
                                        <form action="/sold-batu" method="get" class="d-inline">
                                            @csrf
                                            <input type="hidden" name="id" value="{{ $batu->id }}">
                                            <button type="submit" class="badge bg-danger border-0"><span>SOLD</span></button>
                                        </form>
                                    @else
                                        <form action="/open-batu" method="get" class="d-inline">
                                            @csrf
                                            <input type="hidden" name="id" value="{{ $batu->id }}">
                                            <button type="submit" class="badge bg-success border-0"><span>OPEN</span></button>
                                        </form>
                                    @endif
                                </td>
                                <td>{{ $batu->keterangan }}</td>
                                <td>
                                    <a href="{{ route('stok-batu.show', $batu->id) }}" class="badge bg-info" style="text-decoration: none;">Show</a>
                                    <a href="{{ route('stok-batu.edit', $batu->id) }}" class="badge bg-warning" style="text-decoration: none;">Edit</a>
                                    <form action="{{ route('stok-batu.destroy', $batu->id) }}" method="post" class="d-inline">
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
