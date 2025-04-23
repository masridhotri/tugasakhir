@extends('layouts.app')

@section('content')
    <main class="app-main">
        {{-- <div class="app-content-header py-3 bg-white shadow-sm">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-md-6 d-flex align-items-center">
                        <i class="fas fa-wallet fa-2x text-primary me-2"></i>
                        <h2 class="mb-0 fw-bold text-primary">Mutasi Saldo</h2>
                    </div>
                    <div class="col-md-6 text-md-end">
                        <nav>
                            <ol class="breadcrumb float-sm-end">
                                <li class="breadcrumb-item"><a href="#" class="text-decoration-none text-secondary">
                                        <i class="fas fa-home"></i> Home</a>
                                </li>
                                <li class="breadcrumb-item active text-primary">
                                    <i class="fas fa-list"></i> Mutasi Saldo
                                </li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div> --}}

        <div class="app-content">
            <div class="container-fluid py-4">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card shadow border-0">
                            <div
                                class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                                <h5 class="mb-0"><i class="fas fa-exchange-alt"></i> Riwayat Tabungan user</h5>
                                {{-- <button class="btn btn-sm btn-light text-danger fw-bold" onclick="resetMutasi()">
                                    <i class="fas fa-trash"></i> Reset Data
                                </button> --}}
                            </div>
                            <div class="card-body">
                                <!-- Filter -->
                                <div class="row mb-3">
                                    <div class="col-md-4">
                                        <label class="form-label"><i class="fas fa-calendar-alt"></i> Filter Tanggal</label>
                                        <input type="date" class="form-control shadow-sm" id="filterTanggal">
                                    </div>

                                    <div class="col-md-4 d-flex justify-content-center gap-2" style="margin-top: 2rem; ">
                                        <button type="button" class="btn btn-primary"
                                            style="height: 2.5rem; width: 10rem;"><i class="bi bi-send"></i> Export</button>
                                        <button type="button" class="btn btn-primary"
                                            style="height: 2.5rem; width: 10rem;"><i class="bi bi-send"></i> Import</button>
                                    </div>
                                    <div class="col-md-4 d-flex align-items-end">
                                        <input class="form-control me-2" type="search" placeholder="Search"
                                            aria-label="Search" name="cari">
                                    </div>
                                </div>

                                <!-- Tabel -->
                                <div class="table-responsive">
                                    <table class="table table-hover table-bordered align-middle">
                                        <thead class="table-dark text-white">
                                            <tr class="text-center">
                                                <th><i class="fas fa-calendar-day"></i>no</th>
                                                <th><i class="fas fa-calendar-day"></i>Nama</th>
                                                <th><i class="fas fa-sticky-note"></i>Status</th>
                                                <th><i class="fas fa-tags"></i>Operator</th>
                                                <th><i class="fas fa-tags"></i>tanggal</th>
                                                <th><i class="fas fa-money-bill-wave"></i>Totalbobot</th>
                                                <th><i class="fas fa-wallet"></i> Total Pemasukan</th>
                                                <th><i class="fas fa-wallet"></i>Aksi</th>

                                            </tr>
                                        </thead>
                                        <tbody id="mutasiTbody" class="text-center">
                                            @foreach ($tabunganall as $tabungan)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $tabungan->user->name }}</td>
                                                    <td>{{ $tabungan->status }}</td>
                                                    <td>{{ $tabungan->operator?->name ?? '-' }}</td>
                                                    <td>{{ $tabungan->updated_at->format('d M Y')}}</td>
                                                    <td>{{ $tabungan->total_bobot }}</td>
                                                    <td>
                                                        Rp {{ number_format(optional($tabungan->mutasi)->sum('total_harga') ?? 0) }}
                                                    </td>
                                                    
                                                    <td>
                                                        <div class="d-flex justify-content-center">
                                                            <button type="button" class="btn btn-success"><i
                                                                    class="bi bi-pencil-square"></i></button>
                                                            <button type="button" class="btn btn-danger"><i
                                                                    class="bi bi-trash"></i></button>
                                                            <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#modaldata{{$tabungan->id}}"><i
                                                                    class="bi bi-eye"></i></button>

                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>

                                @foreach($tabunganall as $tabung)
                                <div class="modal fade" id="modaldata{{$tabung->id}}" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
                                    <div class="modal-dialog modal-dialog-centered">
                                      <div class="modal-content">
                                        <div class="modal-header">
                                          <h1 class="modal-title fs-5" id="exampleModalToggleLabel">Modal 1</h1>
                                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <table class="table table-bordered table-sm">
                                                <thead class="table-dark text-white">
                                                    <tr>
                                                        <th>No</th>
                                                        <th>Item</th>
                                                        <th>Total Harga</th>
                                                        <th>Bobot</th>
                                                        <th>Tanggal</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @forelse ($tabung->mutasi as $index => $mutasi)
                                                        <tr>
                                                            <td>{{ $index + 1 }}</td>
                                                            <td>{{ $mutasi->jenis?->nama_sampah ?? '-' }}</td>
                                                            <td>{{ number_format($mutasi->total_harga) }}</td>
                                                            <td>{{ $mutasi->bobot }}</td>
                                                            <td>{{ $mutasi->created_at->format('d M Y') }}</td>
                                                        </tr>
                                                    @empty
                                                        <tr>
                                                            <td colspan="4" class="text-center">Tidak ada data mutasi</td>
                                                        </tr>
                                                    @endforelse
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="modal-footer">
                                          <button class="btn btn-primary" data-bs-target="#exampleModalToggle2" data-bs-toggle="modal">Open second modal</button>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                @endforeach
                                <!-- Total Saldo -->
                                {{-- <div class="mt-3 text-end">
                                    <h5><strong>Total Saldo:</strong> <span id="totalSaldo" class="fw-bold text-success">Rp
                                            0</span></h5>
                                </div> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    {{-- <script>
    document.addEventListener("DOMContentLoaded", function () {
        cekDanTambahkanContohMutasi();
        loadMutasi();
    });

    function cekDanTambahkanContohMutasi() {
        let mutasi = JSON.parse(localStorage.getItem("mutasiSaldo")) || [];

        if (mutasi.length === 0) {
            let contohData = [
                { tanggal: "2025-03-10", keterangan: "Setoran Sampah", jenis: "Pemasukan", jumlah: 15000, saldo: 15000 },
                { tanggal: "2025-03-12", keterangan: "Pembelian Produk", jenis: "Pengeluaran", jumlah: 5000, saldo: 10000 },
                { tanggal: "2025-03-15", keterangan: "Setoran Sampah", jenis: "Pemasukan", jumlah: 20000, saldo: 30000 },
                { tanggal: "2025-03-18", keterangan: "Tarik Tunai", jenis: "Pengeluaran", jumlah: 10000, saldo: 20000 }
            ];
            localStorage.setItem("mutasiSaldo", JSON.stringify(contohData));
        }
    }

    function loadMutasi() {
        let mutasi = JSON.parse(localStorage.getItem("mutasiSaldo")) || [];
        let mutasiTbody = document.getElementById("mutasiTbody");
        let totalSaldo = document.getElementById("totalSaldo");
        let filterTanggal = document.getElementById("filterTanggal").value;
        let filterJenis = document.getElementById("filterJenis").value;
        let saldoAkhir = 0;
        mutasiTbody.innerHTML = "";

        mutasi.forEach(item => {
            if ((filterTanggal && item.tanggal !== filterTanggal) || (filterJenis && item.jenis !== filterJenis)) return;

            saldoAkhir = item.saldo;
            let jenisBadge = item.jenis === "Pemasukan" ? "bg-success" : "bg-danger";

            mutasiTbody.innerHTML += `
            <tr>
                <td>${item.tanggal}</td>
                <td>${item.keterangan}</td>
                <td><span class="badge ${jenisBadge}">${item.jenis}</span></td>
                <td>Rp ${item.jumlah.toLocaleString()}</td>
                <td>Rp ${item.saldo.toLocaleString()}</td>
            </tr>`;
        });

        totalSaldo.textContent = `Rp ${saldoAkhir.toLocaleString()}`;
    }

    function resetMutasi() {
        localStorage.removeItem("mutasiSaldo");
        cekDanTambahkanContohMutasi();
        loadMutasi();
        alert("Data mutasi saldo berhasil direset!");
    }
</script> --}}
@endsection
