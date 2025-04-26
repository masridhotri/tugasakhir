@extends('layouts.app')

@section('content')
<main class="app-main">
    <!-- Header -->
    <div class="app-content-header py-3 bg-light shadow-sm">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <h2 class="mb-0 fw-bold text-primary">Dashboard</h2>
                </div>
                <div class="col-md-6 text-md-end">
                    <nav>
                        <ol class="breadcrumb float-sm-end">
                            <li class="breadcrumb-item">
                                <a href="#" class="text-decoration-none text-secondary">Home</a>
                            </li>
                            <li class="breadcrumb-item active text-primary">Dashboard</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <!-- Content -->
    <div class="app-content ">
        <div class="container-fluid">
            <div class="row g-3 d-flex justify-content-center">
               
                <div class="col-lg-3 col-md-6">
                    <div class="small-box text-bg-success shadow-lg rounded-3">
                        <div class="inner">
                            <h3>{{$pelanggan}}</h3>
                            <p>Total Pelanggan </p>
                        </div>
                        <i class="bi-people small-box-icon"></i>
                        <a href="#" class="small-box-footer text-white">Info Selengkapnya <i class="bi bi-link-45deg"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="small-box text-bg-primary shadow-lg rounded-3">
                        <div class="inner">
                            <h3>{{$bobotabung}} kg</h3>
                            <p>Bobot total</p>
                        </div>
                        <i class="bi-cart small-box-icon"></i>
                        <a href="#" class="small-box-footer text-white">Info Selengkapnya <i class="bi bi-link-45deg"></i></a>
                    </div>
                </div>
                {{-- @endforeach --}}
                <div class="col-lg-3 col-md-6">
                    <div class="small-box text-bg-danger shadow-lg rounded-3">
                        <div class="inner">
                            <h3> Rp {{ number_format($totalsaldo) }}</h3>
                            <p>Total Saldo User </p>
                        </div>
                        <i class="bi-wallet small-box-icon"></i>
                        <a href="#" class="small-box-footer text-white">Info Selengkapnya <i class="bi bi-link-45deg"></i></a>
                    </div>
                </div>
               
            </div>

            <!-- Grafik -->
            <div class="row mt-4">
                <div class="col-lg-7">
                    <div class="card shadow-lg rounded-3">
                        <div class="card-header bg-primary text-white d-flex align-items-center">
                            <i class="bi bi-graph-up me-2"></i>
                            <h5 class="card-title mb-0">Grafik Total Bobot Bulanan</h5>
                        </div>
                        <div class="card-body">
                            <canvas id="pendapatanBulanChart" style="height: 300px;"></canvas>
                        </div>
                    </div>
                </div>

                <div class="col-lg-5">
                    <div class="card shadow-lg rounded-3">
                        <div class="card-header bg-success text-white d-flex align-items-center">
                            <i class="bi bi-pie-chart-fill me-2"></i>
                            <h5 class="card-title mb-0">Grafik Pendapatan per Jenis Sampah</h5>
                        </div>
                        <div class="card-body">
                            <canvas id="pendapatanJenisChart" style="height: 300px;"></canvas>
                        </div>
                    </div>
                </div>
                <div class="card shadow mt-3 mb-5">
                    <div class="card-header bg-primary text-white fw-bold">
                        Riwayat Sampah
                    </div>
                   

                </div>
            </div>
        </div>
    </div>

</main>

<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
  const bulanLabels = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];
    const totalBobotPerBulan = @json($finalBobotBulanan);

    new Chart(document.getElementById('pendapatanBulanChart'), {
        type: 'line',
        data: {
            labels: bulanLabels,
            datasets: [{
                label: 'Total Bobot (kg)',
                data: totalBobotPerBulan,
                borderColor: '#007bff',
                backgroundColor: 'rgba(0, 123, 255, 0.2)',
                borderWidth: 2,
                fill: true,
            }]
        },
        options: { responsive: true, maintainAspectRatio: false }
    });
    const jenisSampahLabels = @json(array_keys($pendapatanPerJenis));
    const pendapatanJenis = @json(array_values($pendapatanPerJenis));

    new Chart(document.getElementById('pendapatanJenisChart'), {
        type: 'bar',
        data: {
            labels: jenisSampahLabels,
            datasets: [{
                label: 'bobot',
                data: pendapatanJenis,
                backgroundColor: ['#ff6384', '#36a2eb', '#ffce56', '#4bc0c0', '#9966ff'],
                borderWidth: 1,
            }]
        },
        options: {
            indexAxis: 'y',
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                x: {
                    beginAtZero: true
                }
            }
        }
    });
</script>
@endsection
