@extends('layout.dashboard.main')

@section('content')
<div class="table-responsive col-lg-10 mx-5 mt-4">
    <div class="row mb-3">
        <div class="col-md-6">
            <h2>Durasi Proyek</h2><br>
            <a href="{{ route('durasi-proyek.create') }}" class="btn btn-primary mb-3">
                Tambah Durasi Proyek
            </a>
        </div>
    </div>

    <!-- Nav tabs untuk lokasi -->
    <ul class="nav nav-tabs" id="lokasiTab" role="tablist">
        @foreach ($lokasiList as $lokasi)
            <li class="nav-item" role="presentation">
                <a class="nav-link @if($loop->first) active @endif"
                   data-lokasi="{{ $lokasi }}"
                   href="#">
                    {{ $lokasi }}
                </a>
            </li>
        @endforeach
    </ul>

    <!-- Tab content lokasi -->
    <div class="tab-content">
        @foreach ($lokasiList as $lokasi)
            <div class="tab-pane @if($loop->first) show active @endif"
                 data-lokasi="{{ $lokasi }}">

                <!-- FILTER KAVLING -->
                <div class="mb-3 mt-3">
                    <label class="form-label">Filter Kavling</label>
                    <select class="form-select kavling-filter" data-lokasi="{{ $lokasi }}">
                        <option value="">Semua Kavling</option>
                        @foreach ($durasiByLokasi[$lokasi] as $durasi)
                            <option value="{{ $durasi->proyek->kavling }}">
                                {{ $durasi->proyek->kavling }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <table class="table table-striped table-sm">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Lokasi</th>
                            <th>Kluster</th>
                            <th>Kavling</th>
                            <th>Mulai</th>
                            <th>Selesai</th>
                            <th>Durasi (hari)</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($durasiByLokasi[$lokasi] as $durasi)
                            <tr class="table-row"
                                proyek-lokasi="{{ $lokasi }}"
                                proyek-kavling="{{ $durasi->proyek->kavling }}">

                                <td>{{ $durasi->id }}</td>
                                <td>{{ $durasi->proyek->lokasi }}</td>
                                <td>{{ $durasi->proyek->kluster }}</td>
                                <td>{{ $durasi->proyek->kavling }}</td>
                                <td>{{ $durasi->tanggal_mulai }}</td>
                                <td>{{ $durasi->tanggal_selesai }}</td>
                                <td>{{ $durasi->durasi_hari }}</td>

                                <td>
                                    <a href="{{ route('durasi-proyek.show', $durasi->id) }}"
                                       class="badge bg-info" style="text-decoration:none">
                                        Show
                                    </a>

                                    <a href="{{ route('durasi-proyek.edit', $durasi->id) }}"
                                       class="badge bg-warning" style="text-decoration:none">
                                        Edit
                                    </a>

                                    <form action="{{ route('durasi-proyek.destroy', $durasi->id) }}"
                                          method="post" class="d-inline">
                                        @csrf
                                        @method('delete')
                                        <button class="badge bg-danger border-0"
                                                onclick="return confirm('Apakah anda yakin?')">
                                            Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8">
                                    Tidak ada durasi proyek untuk lokasi {{ $lokasi }}
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        @endforeach
    </div>
</div>
@endsection

@section('scripts')
<script>
$(document).ready(function() {

    $('.tab-pane').not(':first').hide();

    $('#lokasiTab .nav-link').on('click', function(e) {
        e.preventDefault();

        $('#lokasiTab .nav-link').removeClass('active');
        $(this).addClass('active');

        const lokasi = $(this).data('lokasi');
        $('.tab-pane').hide().removeClass('show active');
        $(`.tab-pane[data-lokasi="${lokasi}"]`).show().addClass('show active');
    });

    $('select.kavling-filter').on('change', function() {
        const lokasi = $(this).data('lokasi');
        const kavling = $(this).val();

        const rows = $(`.tab-pane[data-lokasi="${lokasi}"] .table-row`);
        rows.each(function() {
            $(this).toggle(!kavling || $(this).data('kavling') == kavling);
        });
    });

});
</script>
@endsection
