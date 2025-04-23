@extends('layouts.app')

@section('content')

    <main class="app-main">
        <!-- Header -->
        <div class="app-content-header py-3 bg-light shadow-sm">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <h2 class="mb-0 fw-bold text-primary"><i class="bi bi-check-circle-fill me-2"></i>Konfirmasi Pengambilan</h2>
                    </div>
                    <div class="col-md-6 text-md-end">
                        <nav>
                            <ol class="breadcrumb float-sm-end">
                                <li class="breadcrumb-item">
                                    <a href="#" class="text-decoration-none text-secondary"><i class="bi bi-house-door"></i> Home</a>
                                </li>
                                <li class="breadcrumb-item active text-primary">Konfirmasi Pengambilan</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>

        <div class="app-content">
            <div class="container-fluid">
                <!-- Detail Pengambilan -->
                <div class="row mt-4">
                    <div class="col-12">
                        <h4 class="fw-bold text-secondary"><i class="bi bi-info-circle-fill me-2"></i> Detail Pengambilan</h4>
                    </div>
                </div>

                <div class="card shadow-sm mt-3 border-0">
                    <div class="card-body">
                        <p><i class="bi bi-person-fill me-2"></i><strong>Nama Nasabah:</strong> John Doe</p>
                        <p><i class="bi bi-geo-alt-fill me-2"></i><strong>Alamat:</strong> Jl. Mawar No. 10</p>
                        <p><i class="bi bi-recycle me-2"></i><strong>Jenis Sampah:</strong> Plastik</p>
                        <p><i class="bi bi-balance-scale me-2"></i><strong>Estimasi Berat:</strong> 2 kg</p>
                        <p><i class="bi bi-hourglass-split me-2"></i><strong>Status:</strong> <span id="status" class="badge bg-warning text-dark">Menunggu</span></p>

                        <!-- Tombol Aksi -->
                        <div class="d-grid gap-2 mt-3">
                            <button class="btn btn-primary" id="btnMulai"><i class="bi bi-truck"></i> Mulai Perjalanan</button>
                            <button class="btn btn-success d-none" id="btnSelesai"><i class="bi bi-check-circle"></i> Sampah Diambil</button>
                            <button class="btn btn-danger d-none" id="btnKendala"><i class="bi bi-exclamation-triangle"></i> Laporkan Kendala</button>
                            <button class="btn btn-secondary d-none" id="btnBatal"><i class="bi bi-x-circle"></i> Batal</button>
                        </div>

                        <!-- Notifikasi -->
                        <div id="notifikasiNasabah" class="alert alert-info mt-3 d-none">📢 Operator sedang dalam perjalanan!</div>
                        <div id="notifikasiDiambil" class="alert alert-success mt-3 d-none">📢 Sampah sudah diambil!</div>
                        <div id="notifikasiAdmin" class="alert alert-warning mt-3 d-none">⚠️ Ada kendala dalam pengambilan sampah!</div>
                        <div id="notifikasiKonfirmasi" class="alert alert-warning mt-3 d-none">⚠️ Konfirmasi Berhasil!</div>

                        <!-- Form Konfirmasi -->
                        <div id="formSelesai" class="mt-3 d-none">
                            <label for="foto"><i class="bi bi-camera-fill me-2"></i>Upload Foto Bukti:</label>
                            <input type="file" class="form-control mb-2" id="foto">

                            <label for="beratAktual"><i class="bi bi-scale me-2"></i>Berat Aktual (kg):</label>
                            <input type="number" class="form-control mb-2" id="beratAktual" placeholder="Masukkan berat sebenarnya">

                            <label for="catatan"><i class="bi bi-pencil-square me-2"></i>Catatan Tambahan:</label>
                            <textarea class="form-control mb-2" id="catatan" rows="3" placeholder="Catatan jika ada kendala"></textarea>

                            <button class="btn btn-success mt-2" id="btnKonfirmasi">
                                <i class="bi bi-check-square"></i> Konfirmasi
                            </button>
                        </div>

                        <!-- Komunikasi -->
                        <h5 class="mt-4"><i class="bi bi-chat-left-text-fill me-2"></i>Komunikasi</h5>
                        <div class="d-grid gap-2 mt-2">
                            <button class="btn btn-success" id="btnChat"><i class="bi bi-chat-dots"></i> Chat dengan Nasabah</button>
                            <button class="btn btn-secondary" id="btnCall"><i class="bi bi-telephone-fill"></i> Panggilan Cepat</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- JavaScript -->
        <script>
            document.getElementById("btnMulai").addEventListener("click", function() {
                document.getElementById("status").textContent = "Dalam Perjalanan";
                document.getElementById("status").classList.replace("bg-warning", "bg-primary");
                this.classList.add("d-none");
                document.getElementById("btnSelesai").classList.remove("d-none");
                document.getElementById("btnKendala").classList.remove("d-none");
                document.getElementById("btnBatal").classList.remove("d-none");
                document.getElementById("notifikasiNasabah").classList.remove("d-none");
            });

            document.getElementById("btnSelesai").addEventListener("click", function() {
                document.getElementById("status").textContent = "Selesai";
                document.getElementById("status").classList.replace("bg-primary", "bg-success");
                this.classList.add("d-none");
                document.getElementById("notifikasiDiambil").classList.remove("d-none");
                document.getElementById("formSelesai").classList.remove("d-none");
            });

            document.getElementById("btnKendala").addEventListener("click", function() {
                document.getElementById("notifikasiAdmin").classList.remove("d-none");
            });

            document.getElementById("btnBatal").addEventListener("click", function() {
                document.getElementById("status").textContent = "Dibatalkan";
                document.getElementById("status").classList.replace("bg-primary", "bg-danger");
                this.classList.add("d-none");
                document.getElementById("btnSelesai").classList.add("d-none");
            });

            document.getElementById("btnKonfirmasi").addEventListener("click", function() {
                document.getElementById("notifikasiKonfirmasi").classList.remove("d-none");
            });

            document.getElementById("btnChat").addEventListener("click", function() {
                alert("Menghubungkan ke chat dengan nasabah...");
            });

            document.getElementById("btnCall").addEventListener("click", function() {
                alert("Melakukan panggilan ke nasabah...");
            });
        </script>

    </main>

@endsection
