@extends('layouts.app')

@section('content')
<main class="app-main">
    <div class="app-content-header py-3 bg-light shadow-sm">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <h2 class="mb-0 fw-bold text-primary">Dashboard</h2>
                </div>
                <div class="col-md-6 text-md-end">
                    <nav>
                        <ol class="breadcrumb float-sm-end">
                            <li class="breadcrumb-item"><a href="#" class="text-decoration-none text-secondary">Home</a></li>
                            <li class="breadcrumb-item active text-primary" aria-current="page">Dashboard</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <div class="app-content">
        <div class="container-fluid py-4">
            <div class="row g-3">
                <!-- Kartu Ringkasan -->
                <div class="col-xl-3 col-md-6">
                    <div class="card border-left-primary shadow h-100">
                        <div class="card-body d-flex align-items-center">
                            <div class="me-3">
                                <i class="fas fa-wallet fa-3x text-primary"></i>
                            </div>
                            <div>
                                <div class="text-xs font-weight-bold text-primary text-uppercase">Saldo Tabungan</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">Rp 500.000</div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-md-6">
                    <div class="card border-left-success shadow h-100">
                        <div class="card-body d-flex align-items-center">
                            <div class="me-3">
                                <i class="fas fa-recycle fa-3x text-success"></i>
                            </div>
                            <div>
                                <div class="text-xs font-weight-bold text-success text-uppercase">Total Sampah Disetorkan</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">25 kg</div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-md-6">
                    <div class="card border-left-info shadow h-100">
                        <div class="card-body d-flex align-items-center">
                            <div class="me-3">
                                <i class="fas fa-tasks fa-3x text-info"></i>
                            </div>
                            <div>
                                <div class="text-xs font-weight-bold text-info text-uppercase">Target Bulanan</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">50%</div>
                                <div class="progress mt-2">
                                    <div class="progress-bar bg-info" style="width: 50%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-md-6">
                    <div class="card border-left-warning shadow h-100">
                        <div class="card-body d-flex align-items-center">
                            <div class="me-3">
                                <i class="fas fa-award fa-3x text-warning"></i>
                            </div>
                            <div>
                                <div class="text-xs font-weight-bold text-warning text-uppercase">Peringkat Nasabah</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">Top 5</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Grafik -->
            <div class="row g-3 mt-2">
                <div class="col-md-8">
                    <div class="card shadow">
                        <div class="card-body">
                            <h6 class="text-primary fw-bold">Tren Setoran Sampah per Bulan</h6>
                            <canvas id="chartTrenSampah"></canvas>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card shadow">
                        <div class="card-body">
                            <h6 class="text-primary fw-bold">Komposisi Jenis Sampah</h6>
                            <canvas id="chartJenisSampah"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Notifikasi -->
            <div class="alert alert-warning mt-3">
                <i class="fas fa-bell"></i> Ingat! Anda belum menyetor sampah selama 2 minggu. Yuk, setor sekarang!
            </div>

            <!-- Riwayat Sampah -->
            <div class="card shadow mt-3">
                <div class="card-header bg-primary text-white fw-bold">
                    Riwayat Sampah
                </div>
                <div class="card-body">
                    <div class="row g-2 mb-3">
                        <div class="col-md-3">
                            <input type="date" class="form-control" id="filterTanggal" placeholder="Filter Tanggal">
                        </div>
                        <div class="col-md-3">
                            <select class="form-control" id="filterJenis">
                                <option value="">Semua Jenis</option>
                                <option value="Plastik">Plastik</option>
                                <option value="Kertas">Kertas</option>
                                <option value="Kaleng">Kaleng</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <input type="number" class="form-control" id="filterBerat" placeholder="Minimal Berat (kg)">
                        </div>
                        <div class="col-md-3">
                            <button class="btn btn-primary w-100" onclick="filterRiwayat()">Filter</button>
                        </div>
                    </div>
                    <table class="table table-bordered">
                        <thead class="table-light">
                            <tr>
                                <th>Tanggal</th>
                                <th>Jenis Sampah</th>
                                <th>Berat</th>
                                <th>Saldo Diperoleh</th>
                            </tr>
                        </thead>
                        <tbody id="riwayatTbody">
                            <tr>
                                <td>22 Maret 2025</td>
                                <td>Plastik</td>
                                <td>2 kg</td>
                                <td>Rp 10.000</td>
                            </tr>
                            <tr>
                                <td>15 Maret 2025</td>
                                <td>Kertas</td>
                                <td>5 kg</td>
                                <td>Rp 25.000</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</main>

<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    var ctx1 = document.getElementById('chartTrenSampah').getContext('2d');
    var chart1 = new Chart(ctx1, {
        type: 'bar',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'],
            datasets: [{ label: 'Kg Sampah', data: [10, 15, 8, 12, 20, 25, 30, 22, 18, 24, 28, 35], backgroundColor: 'rgba(54, 162, 235, 0.7)' }]
        }
    });

    var ctx2 = document.getElementById('chartJenisSampah').getContext('2d');
    var chart2 = new Chart(ctx2, {
        type: 'pie',
        data: { labels: ['Plastik', 'Kertas', 'Kaleng'], datasets: [{ data: [40, 35, 25], backgroundColor: ['blue', 'green', 'red'] }] }
    });

    function filterRiwayat() { console.log("Filter diaktifkan!"); }
</script>
@endsection
