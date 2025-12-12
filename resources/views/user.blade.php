@extends('layout.main')

@section('content')

<style>
    .card {
        border-radius: 10px;
    }
</style>

<!-- Carousel Start -->
<div class="container-fluid">
    <div class="row">
        <div class="col">
            <center><br>
                <h3 class="display-4 text-white">PT SEATERO ARTHA PRIMA</h3>
                <h4 class="text-white text-uppercase mb-3">Supplier & Perdagangan Umum</h4><br>
            </center>
            @auth
                @if(auth()->user()->role == "member" && $data)
                    <div class="row">
                        <!-- Content Column -->
                        <div class="col-lg-12 mb-4">

                            <div class="container-fluid pt-2 px-2">
                                <div class="row g-4">
                                    
                                    {{-- Tabel Data Member --}}
                                    <div class="col-sm-12 col-xl-7">
                                        <div class="bg-light rounded-card p-4">
                                            {{-- <div class="d-flex align-items-center justify-content-between mb-4"> --}}
                                            <div class="row" style="max-height: 850px; overflow: auto;">
                                                <h5 class="mb-2">KAVLING</h5>
                                                <!-- Nav tabs for kavling -->
                                                <ul class="nav nav-tabs" id="kavlingTab" role="tablist">
                                                    @foreach ($data as $item)
                                                        <li class="nav-item">
                                                            <a class="nav-link" id="kavling-tab-{{ $item->id }}" data-toggle="tab" href="#content-{{ $item->id }}" role="tab" aria-controls="content-{{ $item->id }}" aria-selected="false" style="font-size: 18px;">{{ $item->kavling }}</a>
                                                        </li>
                                                    @endforeach
                                                </ul>

                                                <!-- Tab panes for kavling -->
                                                <div class="tab-content mt-4" id="kavlingTabContent" style="max-height: 850px;">
                                                    @foreach ($data as $item)
                                                        <div class="tab-pane fade @if($loop->first) show active @endif" id="content-{{ $item->id }}" role="tabpanel" aria-labelledby="kavling-tab-{{ $item->id }}">
                                                            <div class="card shadow mb-4 rounded-card">
                                                                <div class="card-header py-3">
                                                                    <h5 class="m-1 font-weight-bold text-primary">Data Pembeli Kavling {{ $item->kavling }}</h5>
                                                                </div>
                                                                <div class="card-body">
                                                                    <div class="table-responsive col-lg-11 mx-4 mt-4">
                                                                        <table class="table table-striped table-sm">
                                                                            <tr style="margin-bottom: 100px;">
                                                                                <th scope="row">Nama User</th>
                                                                                <td>{{ $item->user->name }}</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th scope="row">Kavling</th>
                                                                                <td>{{ $item->kavling }}</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th scope="row">Lokasi</th>
                                                                                <td>{{ $item->lokasi }}</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th scope="row">Tipe</th>
                                                                                <td>{{ $item->tipe }}</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th scope="row">Harga Deal</th>
                                                                                <td>{{ $item->harga_deal }}</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th scope="row">PTB</th>
                                                                                <td>{{ $item->ptb }}</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th scope="row">Progres (%)</th>
                                                                                <td>{{ $item->progres }} %</td>
                                                                            </tr>
                                                
                                                                        </table>
                                                                        <h5 class="medium font-weight-bold"> Progress Pembangunan <span class="float-right">{{ $item->progres }}%</span></h5>
                                                                        <div class="progress mb-4">
                                                                            <div class="progress-bar" role="progressbar" style="width: {{ $item->progres }}%" aria-valuenow="{{ $item->progres }}" aria-valuemin="0" aria-valuemax="100"></div>
                                                                        </div>
                                                                        <!-- <h6 class="medium font-weight-bold">Progress Cicilan ({{ $item->uang_masuk }} / {{ $item->harga_deal }})</h6>
                                                                                @php
                                                                                    $progressCicilan = ($item->uang_masuk / $item->harga_deal) * 100;
                                                                                @endphp
                                                                                <div class="progress mb-4">
                                                                                    <div class="progress-bar" id="cicilan-progress" role="progressbar" style="width: {{ $progressCicilan }}%" aria-valuenow="{{ $progressCicilan }}" aria-valuemin="0" aria-valuemax="100"></div>
                                                                                </div> -->
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div> 
                                    
                                    {{-- Foto --}}
                                    <div class="col-sm-12 col-xl-5">

                                        {{-- Progress --}}
                                        <div class="row mb-3" style="max-height: 500px; overflow: auto;">
                                            <div class="bg-light rounded-card p-4">
                                                {{-- <div class="d-flex align-items-center justify-content-between mb-4"> --}}
                                                <div class="row">
                                                    {{-- <h6 class="mb-0">Foto Progress</h6> --}}
                                                    <div class="card shadow">
                                                        <div class="card-header py-3">
                                                            <h6 class="m-0 font-weight-bold text-primary">PROGRESS PEMBANGUNAN</h6>
                                                        </div>
                                                        <div class="card-body">
                                                            <div class="table-responsive col-md-10 mx-4 mt-1">
                                                                <div class="tab-content mt-1" id="fotoTabContent">
                                                                    @foreach ($data as $item)
                                                                        <div class="tab-pane fade" id="foto-content-{{ $item->id }}" role="tabpanel" aria-labelledby="foto-tab-{{ $item->id }}">
                                                                            @php
                                                                                $itemFoto = $foto->where('data_id', $item->id)->sortByDesc('created_at')->take(4);
                                                                            @endphp
                                                                            <div class="row" style="width: 90%; margin-left: 30px">
                                                                                <div class="col-md-12">
                                                                                    <div id="progressPhotoCarousel-{{ $item->id }}" class="carousel slide" data-bs-ride="carousel">
                                                                                        <div class="carousel-inner">
                                                                                            @if($itemFoto->count() == 0)
                                                                                                <div class="d-flex justify-content-center align-items-center" style="height: 190px;">
                                                                                                    <img src="{{ asset('images/proses.png') }}" class="d-block" alt="Foto" style="max-height: 100%; object-fit: cover;">
                                                                                                </div>
                                                                                            @else
                                                                                                @foreach($itemFoto as $f)
                                                                                                    <div class="carousel-item @if ($loop->first) active @endif">
                                                                                                        <img src="{{ asset('storage/' . $f->photo) }}" class="card-img-top" alt="Foto" style="width: 100%; max-height: 300px; object-fit: cover;">
                                                                                                    </div>
                                                                                                @endforeach
                                                                                            @endif
                                                                                        </div>
                                                                                        
                                                                                    </div>
                                                                                    <button class="carousel-control-prev custom-carousel-prev" type="button" data-bs-target="#progressPhotoCarousel-{{ $item->id }}" data-bs-slide="prev">
                                                                                        <span class="carousel-control-prev-icon custom-carousel-prev-icon" aria-hidden="true"></span>
                                                                                        <span class="visually-hidden">Previous</span>
                                                                                    </button>
                                                                                    <button class="carousel-control-next custom-carousel-next" type="button" data-bs-target="#progressPhotoCarousel-{{ $item->id }}" data-bs-slide="next">
                                                                                        <span class="carousel-control-next-icon custom-carousel-next-icon" aria-hidden="true"></span>
                                                                                        <span class="visually-hidden">Next</span>
                                                                                    </button>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    @endforeach
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        {{-- Promo --}}
                                        <div class="row mb-3 d-flex justify-content-center align-items-center">
                                            <div class="row">
                                                <div id="promoCarousel" class="carousel slide" data-bs-ride="carousel">
                                                    <div class="carousel-inner">
                                                        @php
                                                            $latestPromo = $promo->sortByDesc('created_at');
                                                        @endphp

                                                        @foreach ($latestPromo as $index => $pro)
                                                            <div class="carousel-item @if ($index === 0) active @endif" style="max-height: 400px;">
                                                                @if ($pro->gambar)
                                                                <div class="d-flex justify-content-center align-items-center" style="padding-bottom: 100%; position: relative; overflow: hidden;">
                                                                    <img src="{{ asset('storage/' . $pro->gambar) }}" class="d-block position-absolute top-0 start-0" alt="Promo Gambar" style="width: 100%; height: 80%; object-fit: contain;">
                                                                </div>
                                                                @else
                                                                    <p>Tidak ada promo</p>
                                                                @endif
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                    <button class="carousel-control-prev custom-carousel-prev" type="button" data-bs-target="#promoCarousel" data-bs-slide="prev">
                                                        <span class="carousel-control-prev-icon custom-carousel-prev-icon" aria-hidden="true"></span>
                                                        <span class="visually-hidden">Previous</span>
                                                    </button>
                                                    <button class="carousel-control-next custom-carousel-next" type="button" data-bs-target="#promoCarousel" data-bs-slide="next">
                                                        <span class="carousel-control-next-icon custom-carousel-next-icon" aria-hidden="true"></span>
                                                        <span class="visually-hidden">Next</span>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                        

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>                    
                @endif
            @endauth
        </div>
    </div>
</div>

<script>
    
    $(document).ready(function() {
        // Ambil elemen tab pertama untuk kavling dan foto
        const firstKavlingTab = $('#kavlingTab .nav-link:first');
        const firstFotoTab = $('#fotoTab .nav-link:first');
        const firstProgresTab = $('#progresTab .nav-link:first')

        // Tambahkan kelas 'active' pada tab pertama secara manual saat memuat halaman
        firstKavlingTab.addClass('active');
        firstFotoTab.addClass('active');
        firstProgresTab.addClass('active');

        // Tampilkan konten tab pertama saat halaman dimuat
        $('#kavlingTabContent .tab-pane:first').addClass('show active');
        $('#fotoTabContent .tab-pane:first').addClass('show active');
        $('#progresTabContent .tab-pane:first').addClass('show active');

        // Fungsi untuk menampilkan foto berdasarkan kavling yang dipilih
        function showFotoByKavling(kavlingId) {
            // Sembunyikan semua foto
            $('#fotoTabContent .tab-pane').removeClass('show active');

            // Tampilkan foto yang sesuai dengan kavlingId yang dipilih
            $('#foto-content-' + kavlingId).addClass('show active');
        }

        // Saat halaman dimuat, tampilkan foto berdasarkan tab pertama yang aktif
        showFotoByKavling(firstKavlingTab.attr('href').replace('#content-', ''));

        // Fungsi untuk menampilkan progress berdasarkan kavling yang dipilih
        function showProgresByKavling(kavlingId) {
            // Ambil progress value berdasarkan kavlingId yang dipilih
            const progress = $('#content-' + kavlingId + ' .progress-value').text();

            // Update progress value on the progress bar
            $('#progress-bar-' + kavlingId).css('width', progress + '%');
            $('#progress-bar-' + kavlingId).attr('aria-valuenow', progress);
        }

        // Saat halaman dimuat, tampilkan progress berdasarkan tab pertama yang aktif
        const firstKavlingTabId = firstKavlingTab.attr('href').replace('#content-', '');
        showProgresByKavling(firstKavlingTabId);

        // Tangani peristiwa klik pada tab kavling
        $('#kavlingTab .nav-link, #fotoTab .nav-link, #progresTab .nav-link').on('click', function(e) {
            e.preventDefault();

            // Hilangkan kelas 'active' dari semua tab kavling
            $('#kavlingTab .nav-link, #fotoTab .nav-link, #progresTab .nav-link').removeClass('active');

            // Tambahkan kelas 'active' pada tab kavling yang diklik
            $(this).addClass('active');

            // Ambil ID konten tab kavling yang sesuai dari atribut href
            const targetContentId = $(this).attr('href');

            // Sembunyikan semua konten tab kavling
            $('#kavlingTabContent .tab-pane').removeClass('show active');

            // Tampilkan konten tab kavling yang sesuai
            $('#kavlingTabContent .tab-pane, #fotoTabContent .tab-pane, #progresTabContent .tab-pane').removeClass('show active');

            // Tampilkan konten tab yang sesuai
            $(targetContentId).addClass('show active');

            // Ambil kavlingId dari atribut href dan tampilkan foto serta progres sesuai tab yang dipilih
            const kavlingId = targetContentId.replace('#content-', '');
            showFotoByKavling(kavlingId);
            showProgresByKavling(kavlingId);
        });
    });
</script>


@endsection
