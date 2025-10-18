@extends('layouts.app')

@section('content')
    <main class="app">
        <div class="app-content">
            <div class="container-fluid py-4">

                {{-- ===================== DASHBOARD UNTUK USER ===================== --}}
                <section class="app-main">

                    {{-- Header --}}
                    <div class="app-content-header py-3 bg-light shadow-sm rounded mb-4">
                        <h4 class="text-primary fw-bold mb-0">
                            Selamat datang, {{ Auth::user()->name }}
                        </h4>
                    </div>

                    {{-- Kartu Ringkasan --}}
                    <div class="row g-3">
                        {{-- Saldo --}}
                        <div class="col-md-3">
                            <div class="card shadow-sm text-center p-3 border-0">
                                <div class="text-muted">Saldo</div>
                                <h4 class="text-success fw-bold">Rp {{ number_format($saldo) }}</h4>
                                <button type="button" class="btn btn-primary mt-2" data-bs-toggle="modal"
                                    data-bs-target="#exampleModal">
                                    Tarik Saldo
                                </button>
                            </div>
                        </div>

                        {{-- Total Bobot --}}
                        <div class="col-md-3">
                            <div class="card shadow-sm text-center p-3 border-0">
                                <div class="text-muted">Total Bobot</div>
                                <h4 class="text-success fw-bold">{{ $totalbobot }} Kg</h4>
                            </div>
                        </div>

                        {{-- Uang Keluar --}}
                        <div class="col-md-3">
                            <div class="card shadow-sm text-center p-3 border-0">
                                <div class="text-muted">Uang Keluar</div>
                                <h4 class="text-danger fw-bold">-</h4>
                            </div>
                        </div>
                    </div>

                    {{-- Grafik --}}
                    <div class="row g-3 mt-4">
                        <div class="col-md-8">
                            <div class="card shadow-sm border-0">
                                <div class="card-body">
                                    <h6 class="text-primary fw-bold mb-3">Tren Setoran Sampah per Bulan</h6>
                                    <canvas id="chartTrenSampah" height="120"></canvas>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card shadow-sm border-0">
                                <div class="card-body">
                                    <h6 class="text-primary fw-bold mb-3">Komposisi Jenis Sampah</h6>
                                    <canvas id="chartJenisSampah" height="120"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Tombol Transaksi --}}
                    <form action="{{ route('tabung.new') }}" method="POST" id="transaksiForm" class="mt-4">
                        @csrf
                        <button type="submit" class="btn btn-primary w-100">
                            <span id="btnText">Buat Transaksi Baru</span>
                            <i class="bi bi-rocket-takeoff-fill d-none" id="rocketIcon"></i>
                        </button>
                    </form>
                </section>

                {{-- Modal Tarik Saldo --}}
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content border-0 shadow">
                            <div class="modal-header">
                                <h5 class="modal-title fw-bold text-primary" id="exampleModalLabel">
                                    Tarik Saldo
                                </h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('saldo') }}" method="POST">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="nominal" class="form-label">Nominal Pengeluaran</label>
                                        <input type="number" name="nominal" id="nominal" class="form-control"
                                            min="1" required placeholder="Masukkan jumlah saldo...">
                                    </div>
                                    <button type="submit" class="btn btn-warning w-100">Simpan</button>
                                </form>
                            </div>
                            <div class="modal-footer border-0">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    {{-- ===================== SCRIPT UNTUK USER ===================== --}}

    @php
        $trenData = $chartall ?? [10, 20, 15, 12, 9, 30, 25, 40, 38, 29, 20, 15];
    @endphp

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        const trenData = @json($trenData);

        new Chart(document.getElementById('chartTrenSampah'), {
            type: 'bar',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'],
                datasets: [{
                    label: 'Kg Sampah',
                    data: trenData,
                    backgroundColor: 'rgba(54, 162, 235, 0.7)',
                }]
            }
        });

        new Chart(document.getElementById('chartJenisSampah'), {
            type: 'pie',
            data: {
                labels: ['Plastik', 'Kertas', 'Kaleng'],
                datasets: [{
                    data: [40, 35, 25],
                    backgroundColor: ['#36A2EB', '#4CAF50', '#F44336']
                }]
            }
        });
    </script>


    {{-- ===================== SCRIPT UNTUK OPERATOR ===================== --}}
@endsection
