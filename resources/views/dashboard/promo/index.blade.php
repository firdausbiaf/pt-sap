@extends('layout.dashboard.main')

@section('content')
<div class="table-responsive col-lg-10 mx-5 mt-4">
    <div class="row mb-3">
        <div class="col-md-6">
            <h2>Promo</h2><br>
            <a href="{{ route('promo.create') }}" class="btn btn-primary mb-3">Tambah Promo</a>
        </div>
    </div>

    <table class="table table-striped table-sm">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Gambar</th>
                <th scope="col">Keterangan</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($promos as $promo)
                <tr>
                    <td>{{ $promo->id }}</td>
                    <td>
                        @if ($promo->gambar)
                            <img src="{{ asset('storage/' . $promo->gambar) }}" class="card-img-top" style="max-width: 100px;" alt="Gambar">
                        @else
                            <p>Tidak ada gambar</p>
                        @endif
                    </td>
                    <td>{{ $promo->keterangan }}</td>
                    <td>
                        <a href="{{ route('promo.show', $promo->id) }}" class="badge bg-info" style="text-decoration: none;">Show</a>
                        <a href="{{ route('promo.edit', $promo->id) }}" class="badge bg-warning" style="text-decoration: none;">Edit</a>
                        <form action="{{ route('promo.destroy', $promo->id) }}" method="post" class="d-inline">
                            @method('delete')
                            @csrf
                            <button class="badge bg-danger border-0" onclick="return confirm('Apakah Anda yakin?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            @if(count($promos) === 0)
                <tr>
                    <td colspan="4">Tidak ada data promo</td>
                </tr>
            @endif
        </tbody>
    </table>
    <div class="d-flex justify-content-center">
        {{ $promos->links() }}
    </div>
</div>
@endsection
