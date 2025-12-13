@extends('layout.dashboard.main')

@section('content')
<div class="table-responsive col-lg-10 mx-5 mt-4">
    <div class="row mb-3">
        <div class="col-md-6">
            <h2>Video</h2><br>
            <a href="{{ route('video.create') }}" class="btn btn-primary mb-3">Tambah Video</a>
        </div>
    </div>

    <!-- Nav tabs untuk lokasi -->
    <ul class="nav nav-tabs" id="lokasiTab" role="tablist">
        @foreach ($lokasiList as $lokasi)
            <li class="nav-item" role="presentation">
                <a class="nav-link @if($loop->first) active @endif" 
                    id="{{ $lokasi }}-tab" 
                    data-lokasi="{{ $lokasi }}" 
                    data-toggle="tab" 
                    href="#lokasi-{{ $lokasi }}" 
                    role="tab" 
                    aria-selected="{{ $loop->first ? 'true' : 'false' }}">
                    {{ $lokasi }}
                </a>
            </li>
        @endforeach
    </ul>

    <!-- Tab content lokasi -->
    <div class="tab-content" id="lokasiTabContent">
        @foreach ($lokasiList as $lokasi)
            <div class="tab-pane fade @if($loop->first) show active @endif" 
                id="lokasi-{{ $lokasi }}" 
                role="tabpanel" 
                data-lokasi="{{ $lokasi }}">

                <!-- FILTER KAVLING -->
                <div class="mb-3 mt-3">
                    <label class="form-label">Filter Kavling</label>
                    <select class="form-select kavling-filter" data-lokasi="{{ $lokasi }}">
                        <option value="">Semua Kavling</option>
                        @foreach ($videosByLokasi[$lokasi] as $video)
                            <option value="{{ $video->data->kavling }}">{{ $video->data->kavling }}</option>
                        @endforeach
                    </select>
                </div>

                <table class="table table-striped table-sm">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Lokasi</th>
                            <th>Kavling</th>
                            <th>Video</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($videosByLokasi[$lokasi] as $video)
                            <tr class="table-row" 
                                data-lokasi="{{ $lokasi }}" 
                                data-kavling="{{ $video->data->kavling }}">

                                <td>{{ $video->id }}</td>
                                <td>{{ $video->data->lokasi }}</td>
                                <td>{{ $video->data->kavling }}</td>

                                <td>
                                    @if ($video->video)
                                        <video width="150" controls>
                                            <source src="{{ asset('storage/'.$video->video) }}" type="video/mp4">
                                            Browser Anda tidak mendukung video.
                                        </video>
                                    @else
                                        <p>Tidak ada video</p>
                                    @endif
                                </td>

                                <td>
                                    <a href="{{ route('video.show', $video->id) }}" 
                                        class="badge bg-info" style="text-decoration: none;">Show</a>

                                    <a href="{{ route('video.edit', $video->id) }}" 
                                        class="badge bg-warning" style="text-decoration: none;">Edit</a>

                                    <form action="{{ route('video.destroy', $video->id) }}" 
                                        method="post" class="d-inline">
                                        @method('delete')
                                        @csrf
                                        <button class="badge bg-danger border-0"
                                            onclick="return confirm('Apakah anda yakin?')">
                                            Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5">Tidak ada data video untuk lokasi {{ $lokasi }}</td>
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
    // Hide all tab-pane except first
    $('.tab-pane').not(':first').removeClass('show active').hide();

    // Show correct tab on initial load
    const activeTab = $('#lokasiTab .nav-link.active');
    $(`.tab-pane[data-lokasi="${activeTab.data('lokasi')}"]`).show();

    // Tab click handler
    $('#lokasiTab .nav-link').on('click', function(e) {
        e.preventDefault();
        const lokasi = $(this).data('lokasi');
        $('.tab-pane').hide().removeClass('show active');
        $(`.tab-pane[data-lokasi="${lokasi}"]`).show().addClass('show active');

        updateKavlingOptions(lokasi);
    });

    // Filter kavling
    $('select.kavling-filter').change(function() {
        const lokasi = $(this).data('lokasi');
        const kavlingFilter = $(this).val();
        updateTable(lokasi, kavlingFilter);
    });

    function updateKavlingOptions(lokasi) {
        const select = $(`.kavling-filter[data-lokasi="${lokasi}"]`);
        const rows = $(`.tab-pane[data-lokasi="${lokasi}"] .table-row`);

        const kavlings = new Set();
        rows.each(function() {
            kavlings.add($(this).data('kavling'));
        });

        select.empty().append('<option value="">Semua Kavling</option>');
        kavlings.forEach(k => {
            select.append(`<option value="${k}">${k}</option>`);
        });
    }

    function updateTable(lokasi, kavling) {
        const rows = $(`.tab-pane[data-lokasi="${lokasi}"] .table-row`);
        rows.each(function() {
            $(this).toggle(!kavling || $(this).data('kavling') == kavling);
        });
    }
});
</script>
@endsection
