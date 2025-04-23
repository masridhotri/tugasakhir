@extends('layouts.app')

@section('content')
    <main class="app-main">
        <div class="app-content-header py-3 bg-white shadow-sm">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-md-6 d-flex align-items-center">
                        <i class="fas fa-history fa-2x text-primary me-2"></i>
                        <h2 class="mb-0 fw-bold text-primary">Riwayat Transaksi</h2>
                    </div>
                    <div class="col-md-6 text-md-end">
                        <nav>
                            <ol class="breadcrumb float-sm-end">
                                <li class="breadcrumb-item"><a href="#" class="text-decoration-none text-secondary">
                                        <i class="fas fa-home"></i> Home</a>
                                </li>
                                <li class="breadcrumb-item active text-primary">
                                    <i class="fas fa-list"></i> Riwayat Transaksi
                                </li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>

        <div class="app-content">
            <div class="container-fluid py-4">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card shadow border-0">
                            <div
                                class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                                <h5 class="mb-0"><i class="fas fa-receipt"></i> Daftar Transaksi Setor Sampah</h5>
                                <button class="btn btn-sm btn-light text-danger fw-bold" onclick="resetTransaksi()">
                                    <i class="fas fa-trash"></i> Reset Data
                                </button>
                            </div>
                            <div class="card-body">
                                <!-- Filter -->
                                <div class="row mb-3">
                                    <div class="col-md-4">
                                        <label class="form-label"><i class="fas fa-calendar-alt"></i> Filter Tanggal</label>
                                        <input type="date" class="form-control shadow-sm" id="filterTanggal">
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label"><i class="fas fa-filter"></i> Filter Jenis Sampah</label>
                                        <select class="form-control shadow-sm" id="filterJenis">
                                            <option value="">Semua Jenis</option>
                                            <option value="Plastik">Plastik</option>
                                            <option value="Kertas">Kertas</option>
                                            <option value="Logam">Logam</option>
                                            <option value="Organik">Organik</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4 d-flex align-items-end">
                                        <button class="btn btn-primary w-100 shadow-sm" onclick="loadTransaksi()">
                                            <i class="fas fa-search"></i> Filter
                                        </button>
                                    </div>
                                </div>

                                <!-- Tabel -->
                                <div class="table-responsive">
                                    <table class="table table-hover table-bordered align-middle">
                                        <thead class="table-dark text-white">
                                            <tr class="text-center">
                                                <th><i class="fas fa-calendar-day"></i> Tanggal</th>
                                                <th><i class="fas fa-recycle"></i> Jenis Sampah</th>
                                                <th><i class="fas fa-weight-hanging"></i> Berat (kg)</th>
                                                <th><i class="fas fa-money-bill-wave"></i> Nilai Tukar</th>
                                                <th><i class="fas fa-wallet"></i> Saldo</th>
                                            </tr>
                                        </thead>
                                        <tbody id="transaksiTbody" class="text-center">
                                           
                                        </tbody>
                                    </table>
                                </div>

                                <div class="mt-3 text-end">
                                    <h5><strong>Total Saldo:</strong> <span id="totalSaldo" class="fw-bold text-success">Rp
                                            0</span></h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            cekDanTambahkanContohData();
            loadTransaksi();
        });

        function cekDanTambahkanContohData() {
            let transaksi = JSON.parse(localStorage.getItem("transaksiSampah")) || [];

            if (transaksi.length === 0) {
                let contohData = [{
                        tanggal: "2025-03-10",
                        jenis: "Plastik",
                        berat: 2,
                        nilaiTukar: 5000,
                        saldo: 10000
                    },
                    {
                        tanggal: "2025-03-12",
                        jenis: "Kertas",
                        berat: 3,
                        nilaiTukar: 4000,
                        saldo: 12000
                    },
                    {
                        tanggal: "2025-03-15",
                        jenis: "Logam",
                        berat: 1.5,
                        nilaiTukar: 7000,
                        saldo: 10500
                    },
                    {
                        tanggal: "2025-03-18",
                        jenis: "Organik",
                        berat: 4,
                        nilaiTukar: 2000,
                        saldo: 8000
                    }
                ];
                localStorage.setItem("transaksiSampah", JSON.stringify(contohData));
            }
        }

        function loadTransaksi() {
            let transaksi = JSON.parse(localStorage.getItem("transaksiSampah")) || [];
            let transaksiTbody = document.getElementById("transaksiTbody");
            let filterTanggal = document.getElementById("filterTanggal").value;
            let filterJenis = document.getElementById("filterJenis").value;
            let totalSaldo = document.getElementById("totalSaldo");
            let saldoAkhir = 0;
            transaksiTbody.innerHTML = "";

            transaksi.forEach(item => {
                if ((filterTanggal && item.tanggal !== filterTanggal) || (filterJenis && item.jenis !==
                    filterJenis)) return;

                saldoAkhir = item.saldo;
                transaksiTbody.innerHTML += `
            <tr>
                <td>${item.tanggal}</td>
                <td><span class="badge bg-info text-dark">${item.jenis}</span></td>
                <td>${item.berat} kg</td>
                <td>Rp ${item.nilaiTukar.toLocaleString()}</td>
                <td>Rp ${item.saldo.toLocaleString()}</td>
            </tr>`;
            });

            totalSaldo.textContent = `Rp ${saldoAkhir.toLocaleString()}`;
        }

        function resetTransaksi() {
            localStorage.removeItem("transaksiSampah");
            cekDanTambahkanContohData();
            loadTransaksi();
            alert("Data transaksi berhasil direset!");
        }
    </script>
@endsection
