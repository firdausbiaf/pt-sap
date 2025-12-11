@extends('layout.dashboard.main')
@section('content')
<div class="main-panel">
  <div class="content-wrapper">
    <div class="row">
      <div class="col-sm-12">
        <div class="home-tab">
          <div class="tab-content tab-content-basic">
            <div class="tab-pane fade show active" id="overview" role="tabpanel" aria-labelledby="overview"> 
              <div class="row">
                <div class="col-sm-12">
                  <div class="statistics-details d-flex align-items-center justify-content-between">
                    <div>
                      <p class="statistics-title">Member</p>
                      <h4 class="rate-percentage">{{ $member->count() }} Persons</h4>
                    </div>
                    <div>
                      <p class="statistics-title">Admin</p>
                      <h4 class="rate-percentage">{{ $admin->count() }} Persons</h4>
                    </div>
                    <div>
                      <p class="statistics-title">Petugas</p>
                      <h4 class="rate-percentage">{{ $petugas->count() }} Persons</h4>
                    </div>
                    <div class="d-none d-md-block">
                      <p class="statistics-title">Data User</p>
                      <h4 class="rate-percentage">{{ $data->count() }} Data</h4>
                    </div>
                    <div class="d-none d-md-block">
                      <p class="statistics-title">Legalitas</p>
                      <h4 class="rate-percentage">{{ $legalitas->count() }} Data</h4>
                    </div>
                  </div>
                </div>
              </div> 
              <div class="row">
                <div class="col-sm-6">
                  <canvas id="personChart" width="300" height="150"></canvas>
                </div>
                <div class="col-sm-6">
                  <canvas id="dataChart" width="300" height="150"></canvas>
                </div>
                <div class="col-sm-12 mt-3">
                  <canvas id="legalChart" width="650" height="350" style="margin-top: 20px;"></canvas>
                </div>
              </div>
              <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
              <script>
                // Ambil referensi ke elemen canvas untuk grafik persons
                var personCtx = document.getElementById('personChart').getContext('2d');
                
                // Data untuk grafik persons
                var personData = {
                  labels: ['Member', 'Admin', 'Petugas'],
                  datasets: [{
                    label: 'Total Persons',
                    data: [{{ $member->count() }}, {{ $admin->count() }}, {{ $petugas->count() }}],
                    backgroundColor: ['red', 'green', 'orange']
                  }]
                };
                
                // Konfigurasi grafik persons
                var personConfig = {
                  type: 'bar',
                  data: personData,
                  options: {
                    scales: {
                      y: {
                        beginAtZero: true
                      }
                    },
                    plugins: {
                      legend: {
                        display: true,
                        position: 'right' // Anda dapat mengatur posisi legenda sesuai keinginan
                      }
                    }
                  }
                };

                // Buat grafik persons
                var personChart = new Chart(personCtx, personConfig);
                
                // Ambil referensi ke elemen canvas untuk grafik data
                var dataCtx = document.getElementById('dataChart').getContext('2d');
                
                // Data untuk grafik data
                var dataData = {
                  labels: {!! json_encode(['Data User', 'Legalitas']) !!},
                  datasets: [{
                    label: 'Total Data',
                    data: [{{ $data->count() }}, {{ $legalitas->count() }}],
                    backgroundColor: ['blue', 'purple']
                  }]
                };
                
                // Konfigurasi grafik data
                var dataConfig = {
                  type: 'bar',
                  data: dataData,
                  options: {
                    scales: {
                      y: {
                        beginAtZero: true
                      }
                    },
                    plugins: {
                      legend: {
                        display: true,
                        position: 'right' // Anda dapat mengatur posisi legenda sesuai keinginan
                      }
                    }
                  }
                };

                // Buat grafik data
                var dataChart = new Chart(dataCtx, dataConfig);

                // Ambil referensi ke elemen canvas untuk grafik legalitas
                var legalCtx = document.getElementById('legalChart').getContext('2d');

                // Ambil data tgl_masuk dan tgl_keluar dari PHP dan konversi menjadi array JavaScript
                var tglmasukData = @json($tglmasukCounts);
                var tglkeluarData = @json($tglkeluarCounts);

                // Buat objek untuk menyimpan data berdasarkan bulan
                var dataByMonth = {};

                var monthNames = [
                    'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
                    'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
                ];

                monthNames.forEach(function(monthName, index) {
                  dataByMonth[monthName] = {
                    tglMasuk: 0,
                    tglKeluar: 0
                  };

                  tglmasukData.forEach(function(item) {
                    if (item.month === index + 1) {
                      dataByMonth[monthName].tglMasuk = item.count_tgl_masuk;
                    }
                  });

                  tglkeluarData.forEach(function(item) {
                    if (item.month === index + 1) {
                      dataByMonth[monthName].tglKeluar = item.count_tgl_keluar;
                    }
                  });
                });

                // Ekstrak data untuk label bulan dan data tgl_masuk dan tgl_keluar
                var labels = Object.keys(dataByMonth);
                var dataTglMasuk = [];
                var dataTglKeluar = [];

                labels.forEach(function(monthName) {
                  var monthData = dataByMonth[monthName];

                  dataTglMasuk.push(monthData.tglMasuk);
                  dataTglKeluar.push(monthData.tglKeluar);
                });

                // Data untuk grafik legalitas
                var legalData = {
                  labels: labels,
                  datasets: [{
                    label: 'Total Legalitas Masuk',
                    data: dataTglMasuk,
                    borderColor: 'blue', // Ubah warna garis
                    fill: false
                  }, {
                    label: 'Total Legalitas Keluar',
                    data: dataTglKeluar,
                    borderColor: 'purple', // Ubah warna garis
                    fill: false
                  }]
                };

                // Konfigurasi grafik legalitas
                var legalConfig = {
                  type: 'line',
                  data: legalData,
                  options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                      y: {
                        beginAtZero: true
                      }
                    },
                    plugins: {
                      legend: {
                        display: true,
                        position: 'top'
                      }
                    }
                  }
                };

                // Buat grafik legalitas
                var legalChart = new Chart(legalCtx, legalConfig);
              </script>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection