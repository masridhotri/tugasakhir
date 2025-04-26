@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <!-- Header -->
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h3 class="fw-bold text-dark"><i class="fas fa-wallet"></i> Manajemen Keuangan & Saldo</h3>
        </div>

        <!-- Card Ringkasan Keuangan -->
        <div class="row">
            <div class="col-md-4">
                <div class="card border-0 shadow-sm">
                    <div class="card-body text-center">
                        <h6 class="fw-bold text-muted">Total Saldo Nasabah</h6>
                        <h4 class="fw-bold text-primary">Rp {{ $saldo }}</h4>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card border-0 shadow-sm">
                    <div class="card-body text-center">
                        <h6 class="fw-bold text-muted">Total Pemasukan</h6>
                        <h4 class="fw-bold text-success">Rp {{ $uangmasuk }}</h4>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card border-0 shadow-sm">
                    <div class="card-body text-center">
                        <h6 class="fw-bold text-muted">Total Pengeluaran</h6>
                        <h4 class="fw-bold text-danger">Rp {{$uangkeluar}}</h4>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tabs -->
        <ul class="nav nav-pills mt-4" id="tabMenu">
            <li class="nav-item">
                <a class="nav-link active" data-bs-toggle="pill" href="#rekapTransaksi">
                    <i class="fas fa-list"></i> Rekap Transaksi
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="pill" href="#konfirmasiPenarikan">
                    <i class="fas fa-check-circle"></i> Konfirmasi Penarikan
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="pill" href="#laporanKeuangan">
                    <i class="fas fa-file-alt"></i> Laporan Keuangan
                </a>
            </li>
        </ul>

        <div class="tab-content mt-3">
            <!-- Tab Rekap Transaksi -->
            <div class="tab-pane fade show active" id="rekapTransaksi">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h6 class="mb-0 fw-bold"><i class="fas fa-exchange-alt"></i> Rekap Transaksi</h6>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped text-center">
                            <thead class="table-dark">
                                <tr>
                                    <th>ID Transaksi</th>
                                    <th>Nasabah</th>
                                    <th>Jenis</th>
                                    <th>Jumlah</th>
                                    <th>Saldo Akhir</th>
                                    <th>Tanggal</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>TRX001</td>
                                    <td>Rizky Setiawan</td>
                                    <td><span class="badge bg-success">Setor</span></td>
                                    <td>Rp 500.000</td>
                                    <td>Rp 2.500.000</td>
                                    <td>20 Maret 2025</td>
                                </tr>
                                <tr>
                                    <td>TRX002</td>
                                    <td>Indah Permata</td>
                                    <td><span class="badge bg-danger">Tarik</span></td>
                                    <td>Rp 200.000</td>
                                    <td>Rp 1.200.000</td>
                                    <td>18 Maret 2025</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Tab Konfirmasi Penarikan -->
            <div class="tab-pane fade" id="konfirmasiPenarikan">
                <div class="card shadow-sm">
                    <div class="card-header bg-warning text-dark">
                        <h6 class="mb-0 fw-bold"><i class="fas fa-hand-holding-usd"></i> Konfirmasi Penarikan</h6>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped text-center">
                            <thead class="table-dark">
                                <tr>
                                    <th>ID</th>
                                    <th>Nasabah</th>
                                    <th>Jumlah</th>
                                    <th>Metode</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>WD001</td>
                                    <td>Fajar Hidayat</td>
                                    <td>Rp 300.000</td>
                                    <td>Transfer Bank</td>
                                    <td><span class="badge bg-warning">Menunggu</span></td>
                                    <td>
                                        <button class="btn btn-success btn-sm">
                                            <i class="fas fa-check"></i> Konfirmasi
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>WD002</td>
                                    <td>Siti Rahma</td>
                                    <td>Rp 150.000</td>
                                    <td>E-Wallet</td>
                                    <td><span class="badge bg-warning">Menunggu</span></td>
                                    <td>
                                        <button class="btn btn-success btn-sm">
                                            <i class="fas fa-check"></i> Konfirmasi
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Tab Laporan Keuangan -->
            <div class="tab-pane fade" id="laporanKeuangan">
                <div class="card shadow-sm">
                    <div class="card-header bg-info text-white">
                        <h6 class="mb-0 fw-bold"><i class="fas fa-chart-line"></i> Laporan Keuangan</h6>
                    </div>
                    <div class="card-body">
                        <div class="chart-container">
                            <canvas id="chartKeuangan"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('chartKeuangan').getContext('2d');
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei'],
                datasets: [{
                    label: 'Pemasukan',
                    data: [5000000, 7000000, 6000000, 8000000, 7500000],
                    backgroundColor: 'rgba(54, 162, 235, 0.5)'
                }, {
                    label: 'Pengeluaran',
                    data: [3000000, 4000000, 3500000, 5000000, 4500000],
                    backgroundColor: 'rgba(255, 99, 132, 0.5)'
                }]
            }
        });
    </script>
@endsection
