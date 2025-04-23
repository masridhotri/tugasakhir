@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3 class="fw-bold text-primary"><i class="bi bi-arrow-left-right"></i> Mutasi Saldo</h3>
        <div class="d-flex gap-2">
            <select class="form-select form-select-sm" id="filterMutasi">
                <option value="all">Semua</option>
                <option value="setor">Setoran</option>
                <option value="tarik">Penarikan</option>
            </select>
            <input type="date" class="form-control form-control-sm" id="filterTanggal">
            <button class="btn btn-outline-primary btn-sm" onclick="applyFilter()">
                <i class="bi bi-funnel"></i> Filter
            </button>
        </div>
    </div>

    <!-- Ringkasan Saldo -->
    <div class="row g-3">
        <div class="col-md-4">
            <div class="card shadow border-0 text-bg-success">
                <div class="card-body">
                    <h6><i class="bi bi-arrow-down-circle-fill"></i> Total Setoran</h6>
                    <h4 class="fw-bold">Rp 2.500.000</h4>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow border-0 text-bg-danger">
                <div class="card-body">
                    <h6><i class="bi bi-arrow-up-circle-fill"></i> Total Penarikan</h6>
                    <h4 class="fw-bold">Rp 1.200.000</h4>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow border-0 text-bg-primary">
                <div class="card-body">
                    <h6><i class="bi bi-wallet-fill"></i> Saldo Akhir</h6>
                    <h4 class="fw-bold">Rp 1.300.000</h4>
                </div>
            </div>
        </div>
    </div>

    <!-- Tabel Mutasi -->
    <div class="card shadow-lg border-0 mt-4">
        <div class="card-header bg-dark text-white fw-bold">
            <i class="bi bi-journal-text"></i> Riwayat Mutasi
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-dark text-center">
                        <tr>
                            <th>No</th>
                            <th>Tanggal</th>
                            <th>Keterangan</th>
                            <th>Jenis</th>
                            <th>Jumlah</th>
                            <th>Saldo Akhir</th>
                        </tr>
                    </thead>
                    <tbody class="text-center" id="mutasiTable">
                        @php
                        $mutasi = [
                            ['tanggal' => '2025-03-20', 'keterangan' => 'Setor Sampah', 'jenis' => 'setor', 'jumlah' => 500000, 'saldo' => 1300000],
                            ['tanggal' => '2025-03-18', 'keterangan' => 'Penarikan Dana', 'jenis' => 'tarik', 'jumlah' => 300000, 'saldo' => 800000],
                            ['tanggal' => '2025-03-15', 'keterangan' => 'Setor Sampah', 'jenis' => 'setor', 'jumlah' => 700000, 'saldo' => 1100000],
                            ['tanggal' => '2025-03-10', 'keterangan' => 'Penarikan Dana', 'jenis' => 'tarik', 'jumlah' => 400000, 'saldo' => 400000],
                            ['tanggal' => '2025-03-05', 'keterangan' => 'Setor Sampah', 'jenis' => 'setor', 'jumlah' => 800000, 'saldo' => 800000],
                        ];
                        @endphp

                        @foreach ($mutasi as $index => $m)
                        <tr class="{{ $m['jenis'] == 'setor' ? 'table-success' : 'table-danger' }}">
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $m['tanggal'] }}</td>
                            <td>{{ $m['keterangan'] }}</td>
                            <td>
                                <span class="badge {{ $m['jenis'] == 'setor' ? 'bg-success' : 'bg-danger' }}">
                                    {{ ucfirst($m['jenis']) }}
                                </span>
                            </td>
                            <td class="fw-bold">
                                <span class="{{ $m['jenis'] == 'setor' ? 'text-success' : 'text-danger' }}">
                                    {{ $m['jenis'] == 'setor' ? '+' : '-' }} Rp {{ number_format($m['jumlah'], 0, ',', '.') }}
                                </span>
                            </td>
                            <td>Rp {{ number_format($m['saldo'], 0, ',', '.') }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Script Filter -->
<script>
    function applyFilter() {
        const filterJenis = document.getElementById('filterMutasi').value;
        const filterTanggal = document.getElementById('filterTanggal').value;
        const rows = document.querySelectorAll("#mutasiTable tr");

        rows.forEach(row => {
            const jenis = row.querySelector("td:nth-child(4) span").textContent.toLowerCase();
            const tanggal = row.querySelector("td:nth-child(2)").textContent;

            let show = true;
            if (filterJenis !== "all" && filterJenis !== jenis) show = false;
            if (filterTanggal && filterTanggal !== tanggal) show = false;

            row.style.display = show ? "" : "none";
        });
    }
</script>
@endsection
