@extends('layouts.app')

@section('content')
<main class="app-main">
    <!-- Header -->
    <div class="app-content-header py-3 bg-light shadow-sm">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <h2 class="mb-0 fw-bold text-primary"><i class="fas fa-trash-alt"></i> Setor Sampah</h2>
                </div>
                <div class="col-md-6 text-md-end">
                    <nav>
                        <ol class="breadcrumb float-sm-end">
                            <li class="breadcrumb-item">
                                <a href="#" class="text-decoration-none text-secondary">
                                    <i class="fas fa-home"></i> Home
                                </a>
                            </li>
                            <li class="breadcrumb-item active text-primary">
                                <i class="fas fa-recycle"></i> Setor Sampah
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
                <!-- Form Setor Sampah -->
                <div class="col-lg-12">
                    <div class="card shadow-sm border-0">
                        <div class="card-header bg-primary text-white">
                            <h5 class="mb-0"><i class="fas fa-truck"></i> Form Permintaan Penjemputan Sampah</h5>
                        </div>
                        <div class="card-body">
                            <form id="formSetorSampah">
                                <div class="row g-3">
                                    <div class="col-md-3">
                                        <label class="form-label"><i class="fas fa-recycle"></i> Jenis Sampah</label>
                                        <select class="form-select" id="jenisSampah" onchange="hitungSaldo()">
                                            <option value="Plastik" data-harga="5000">Plastik</option>
                                            <option value="Kertas" data-harga="4000">Kertas</option>
                                            <option value="Logam" data-harga="7000">Logam</option>
                                            <option value="Organik" data-harga="2000">Organik</option>
                                        </select>
                                    </div>
                                    <div class="col-md-2">
                                        <label class="form-label"><i class="fas fa-weight"></i> Berat (kg)</label>
                                        <input type="number" class="form-control" id="beratSampah" placeholder="Masukkan berat" oninput="hitungSaldo()">
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label"><i class="fas fa-map-marker-alt"></i> Alamat Lengkap</label>
                                        <input type="text" class="form-control" id="alamatLengkap" placeholder="Masukkan alamat lengkap">
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label"><i class="fas fa-calendar-alt"></i> Jadwal Penjemputan</label>
                                        <input type="datetime-local" class="form-control" id="jadwalSampah">
                                    </div>
                                </div>
                                <div class="mt-4 d-flex justify-content-between align-items-center">
                                    <strong>Estimasi Saldo yang Didapat:</strong> 
                                    <span id="estimasiSaldo" class="fw-bold text-success">Rp 0</span>
                                    <button type="button" class="btn btn-primary px-4" onclick="kirimPermintaan()">
                                        <i class="fas fa-paper-plane"></i> Kirim
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Peta Interaktif -->
                <div class="col-lg-12 mt-4">
                    <div class="card shadow-sm border-0">
                        <div class="card-header bg-success text-white">
                            <h5 class="mb-0"><i class="fas fa-map-marked-alt"></i> Pilih Lokasi Penjemputan</h5>
                        </div>
                        <div class="card-body">
                            <div id="map" class="rounded border" style="height: 350px;"></div>
                            <input type="text" class="form-control mt-3" id="lokasiSampah" placeholder="Koordinat Lokasi" readonly>
                        </div>
                    </div>
                </div>

                <!-- Tabel Jadwal Penjemputan -->
                <div class="col-lg-12 mt-4">
                    <div class="card shadow-sm border-0">
                        <div class="card-header bg-info text-white d-flex justify-content-between align-items-center">
                            <h5 class="mb-0"><i class="fas fa-list"></i> Jadwal Penjemputan Sampah</h5>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered table-striped text-center">
                                <thead class="table-light">
                                    <tr>
                                        <th><i class="fas fa-calendar-day"></i> Tanggal</th>
                                        <th><i class="fas fa-recycle"></i> Jenis Sampah</th>
                                        <th><i class="fas fa-weight"></i> Berat</th>
                                        <th><i class="fas fa-map-marker-alt"></i> Alamat</th>
                                        <th><i class="fas fa-map-pin"></i> Lokasi</th>
                                        <th><i class="fas fa-info-circle"></i> Status</th>
                                    </tr>
                                </thead>
                                <tbody id="jadwalTbody"></tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</main>

<!-- Leaflet.js untuk Peta -->
<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        loadData();
        initMap();
    });

    function hitungSaldo() {
        let jenis = document.getElementById("jenisSampah");
        let berat = document.getElementById("beratSampah").value;
        let harga = jenis.options[jenis.selectedIndex].getAttribute("data-harga");
        let saldo = berat * harga;
        document.getElementById("estimasiSaldo").textContent = saldo ? `Rp ${saldo.toLocaleString()}` : "Rp 0";
    }

    function kirimPermintaan() {
        let jenis = document.getElementById("jenisSampah").value;
        let berat = document.getElementById("beratSampah").value;
        let alamat = document.getElementById("alamatLengkap").value;
        let lokasi = document.getElementById("lokasiSampah").value;
        let jadwal = document.getElementById("jadwalSampah").value;

        if (!jenis || !berat || !alamat || !lokasi || !jadwal) {
            alert("Harap isi semua data!");
            return;
        }

        let dataSampah = JSON.parse(localStorage.getItem("dataSampah")) || [];
        dataSampah.push({ jadwal, jenis, berat, alamat, lokasi, status: "Menunggu" });
        localStorage.setItem("dataSampah", JSON.stringify(dataSampah));

        loadData();
        alert("Permintaan penjemputan berhasil dikirim!");
    }

    function loadData() {
        let dataSampah = JSON.parse(localStorage.getItem("dataSampah")) || [];
        let jadwalTbody = document.getElementById("jadwalTbody");
        jadwalTbody.innerHTML = "";

        dataSampah.forEach(item => {
            jadwalTbody.innerHTML += `<tr><td>${item.jadwal}</td><td>${item.jenis}</td><td>${item.berat} kg</td><td>${item.alamat}</td><td>${item.lokasi}</td><td><span class="badge bg-warning">${item.status}</span></td></tr>`;
        });
    }

    function initMap() {
        let map = L.map('map').setView([-6.2, 106.816], 12);
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(map);
        let marker;
        map.on('click', function (e) {
            if (marker) map.removeLayer(marker);
            marker = L.marker(e.latlng).addTo(map);
            document.getElementById("lokasiSampah").value = `${e.latlng.lat}, ${e.latlng.lng}`;
        });
    }
</script>
@endsection
