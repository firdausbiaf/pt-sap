@extends('layout.main')

@section('content')

<!-- Carousel Start -->
<div class="container-fluid">
    <div class="row">
        <div class="col">
            <h1 class="display-3 text-white">Djagad Land Group</h1>
            
            @if(auth()->check() == 0)
                <h3 class="text-white text-uppercase mb-3">Pilihan Investasi Terbaik</h3>
                <p class="fs-5 text-white mb-4 pb-2">PT JAGAD KARYA UTAMA  adalah Developer Rumah yang terpercaya dengan nomer 
                    TDP 132516801408 dan telah terdaftar sebagai anggota Asosiasi Pengembang Perumahan dan 
                    Pemukiman Seluruh Indonesia (APERSI) dengan NIA: 04.18.0777. telah sukses membangun perumahan dengan Konsep 
                    Rumah Villa di Kabupaten Malang dan Kota Batu Selain di Indonesia</p>
            @endif
            
            @auth
                @if(auth()->user()->role == "member" && $data)
                    <div class="col">
                        <h3 class="text-white text-uppercase mb-3">Pemantauan Proses Pembangunan</h3>
                    </div>
                    <div class="row">
                        <!-- Content Column -->
                        <div class="col-lg-12 mb-4">

                            <div class="container-fluid pt-2 px-2">
                                <div class="row g-4">
                                    {{-- Tabel Data Member --}}
                                    <div class="col-sm-12 col-xl-5">
                                        <div class="bg-light  rounded p-4">
                                            {{-- <div class="d-flex align-items-center justify-content-between mb-4"> --}}
                                            <div class="row">
                                                <h6 class="mb-0">Kavling</h6>
                                                <!-- Nav tabs for kavling -->
                                                <ul class="nav nav-tabs" id="kavlingTab" role="tablist">
                                                    @foreach ($data as $item)
                                                        <li class="nav-item">
                                                            <a class="nav-link" id="kavling-tab-{{ $item->id }}" data-toggle="tab" href="#content-{{ $item->id }}" role="tab" aria-controls="content-{{ $item->id }}" aria-selected="false">{{ $item->kavling }}</a>
                                                        </li>
                                                    @endforeach
                                                </ul>

                                                <!-- Tab panes for kavling -->
                                                <div class="tab-content mt-4" id="kavlingTabContent">
                                                    @foreach ($data as $item)
                                                        <div class="tab-pane fade @if($loop->first) show active @endif" id="content-{{ $item->id }}" role="tabpanel" aria-labelledby="kavling-tab-{{ $item->id }}">
                                                            <div class="card shadow mb-4">
                                                                <div class="card-header py-3">
                                                                    <h6 class="m-0 font-weight-bold text-primary">Data Pembeli Kavling {{ $item->kavling }}</h6>
                                                                </div>
                                                                <div class="card-body">
                                                                    <div class="table-responsive col-lg-10 mx-4 mt-4">
                                                                        <table class="table table-striped table-sm">
                                                                            <tr>
                                                                                <th scope="row">Nama User</th>
                                                                                <td>{{ $item->user->name }}</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th scope="row">Telepon</th>
                                                                                <td>{{ $item->user->phone }}</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th scope="row">Alamat</th>
                                                                                <td>{{ $item->alamat }}</td>
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
                                                                                <th scope="row">Cicilan Ke</th>
                                                                                <td>{{ $item->cicilan }}</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th scope="row">Uang Masuk</th>
                                                                                <td>{{ $item->uang_masuk }}</td>
                                                                            </tr>
                                                                            {{-- <tr>
                                                                                <th scope="row">SPK</th>
                                                                                <td>{{ $item->spk }}</td>
                                                                            </tr> --}}
                                                                            <tr>
                                                                                <th scope="row">Progres (%)</th>
                                                                                <td>{{ $item->progres }} %</td>
                                                                            </tr>
                                                
                                                                        </table>
                                                                        <h4 class="medium font-weight-bold"> Progress Pembangunan <span class="float-right">{{ $item->progres }}%</span></h4>
                                                                        <div class="progress mb-4">
                                                                            <div class="progress-bar" role="progressbar" style="width: {{ $item->progres }}%" aria-valuenow="{{ $item->progres }}" aria-valuemin="0" aria-valuemax="100"></div>
                                                                        </div>
                                                                        <h4 class="medium font-weight-bold">Progress Cicilan ({{ $item->uang_masuk }} / {{ $item->harga_deal }})</h4>
                                                                                @php
                                                                                    $progressCicilan = ($item->uang_masuk / $item->harga_deal) * 100;
                                                                                @endphp
                                                                                <div class="progress mb-4">
                                                                                    <div class="progress-bar" id="cicilan-progress" role="progressbar" style="width: {{ $progressCicilan }}%" aria-valuenow="{{ $progressCicilan }}" aria-valuemin="0" aria-valuemax="100"></div>
                                                                                </div>
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
                                    <div class="col-sm-12 col-xl-7">
                                        <div class="bg-light  rounded p-4">
                                            {{-- <div class="d-flex align-items-center justify-content-between mb-4"> --}}
                                            <div class="row">
                                                <h6 class="mb-0 text-white">P</h6>
                                                <h6 class="mb-0 text-white">P</h6>
                                                {{-- <h6 class="mb-0">Foto Progress</h6> --}}
                                                <div class="card shadow mb-4">
                                                    <div class="card-header py-3">
                                                        <h6 class="m-0 font-weight-bold text-primary">Progress</h6>
                                                    </div>
                                                    <div class="card-body">
                                                        <div class="table-responsive col-md-10 mx-5 mt-4">
                                                            <h2>Progress Pembangunan</h2><br>
                                                            <div class="tab-content mt-4" id="fotoTabContent">
                                                                @foreach ($data as $item)
                                                                    <div class="tab-pane fade" id="foto-content-{{ $item->id }}" role="tabpanel" aria-labelledby="foto-tab-{{ $item->id }}">
                                                                        @php
                                                                            $itemFoto = $foto->where('data_id', $item->id)->sortByDesc('created_at')->take(4);
                                                                        @endphp
                                                                        <div class="row">
                                                                            @foreach($itemFoto as $f)
                                                                                <div class="col-lg-6 mb-3">
                                                                                    <img src="{{ asset('storage/' . $f->photo) }}" class="card-img-top" alt="Foto" style="width: 100%; height: 200px; object-fit: cover;">
                                                                                </div>
                                                                            @endforeach
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

@endsection