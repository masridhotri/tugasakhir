@extends('layouts.app')

@section('content')
    <main class="app-main">
        <!-- Header -->
        <div class="app-content-header py-3 bg-light shadow-sm">
            <div class="container-xl">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <h2 class="mb-0 fw-bold text-primary">
                            <i class="bi bi-clock-history me-2"></i> Riwayat Tugas
                        </h2>
                    </div>
                    <div class="col-md-6 text-md-end">
                        <nav>
                            <ol class="breadcrumb float-sm-end">
                                <li class="breadcrumb-item">
                                    <a href="#" class="text-decoration-none text-secondary"><i
                                            class="bi bi-house-door"></i> Home</a>
                                </li>
                                <li class="breadcrumb-item active text-primary">Riwayat Tugas</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>

        <!-- Content -->
        <div class="app-content py-4">
            <div class="container-xl">
                <!-- Pencarian & Filter -->
                <div class="row align-items-center mb-3">
                    <div class="col-md-6">
                        <h4 class="fw-bold text-secondary">
                            <i class="bi bi-recycle me-2"></i> Riwayat Pengambilan Sampah
                        </h4>
                    </div>
                    <div class="col-md-6">
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-search"></i></span>
                            <input type="text" class="form-control" id="searchInput"
                                placeholder="Cari nama atau alamat...">
                        </div>
                    </div>
                </div>

                <!-- Filter & Export -->
                <div class="row mb-3">
                    <div class="col-md-6">
                        <button class="btn btn-primary" onclick="exportToCSV()">
                            <i class="bi bi-download"></i> Export
                        </button>
                    </div>
                    <div class="col-md-6 text-md-end">
                        <div class="input-group w-50 d-inline-flex">
                            <span class="input-group-text"><i class="bi bi-funnel"></i></span>
                            <select class="form-select" id="filterStatus">
                                <option value="">Filter Status</option>
                                <option value="Selesai">✅ Selesai</option>
                                <option value="Dalam Proses">🔄 Dalam Proses</option>
                                <option value="Dibatalkan">❌ Dibatalkan</option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Tabel Riwayat -->
                <div class="table-responsive">
                    <table class="table table-hover table-bordered align-middle" id="historyTable">
                        <thead class="table-dark">
                            <tr>
                                <th>#</th>
                                <th><i class="bi bi-person-fill"></i> Nama</th>
                                <th><i class="bi bi-geo-alt-fill"></i> Alamat</th>
                                <th><i class="bi bi-calendar-date"></i> Tanggal</th>
                                <th><i class="bi bi-check-circle"></i> Status</th>
                            </tr>
                        </thead>
                        <tbody>
                                @foreach ($tabungan as $taun)
                                <tr class="table-success">

                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $taun->user->name }}</td>
                                    <td>{{ $taun->user->alamat }}</td>
                                    <td>{{ $taun->created_at }}</td>
                                    <td>{{ $taun->status }}</td>
                                </tr>

                                @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </main>

    <!-- JavaScript -->
    <script>
        // document.addEventListener('DOMContentLoaded', function() {
        //     const searchInput = document.getElementById('searchInput');
        //     const filterStatus = document.getElementById('filterStatus');
        //     const rows = document.querySelectorAll('#historyTable tbody tr');

        //     // Fungsi Pencarian
        //     searchInput.addEventListener('keyup', function() {
        //         let filter = searchInput.value.toLowerCase();
        //         rows.forEach(row => {
        //             let name = row.cells[1].textContent.toLowerCase();
        //             let address = row.cells[2].textContent.toLowerCase();
        //             row.style.display = (name.includes(filter) || address.includes(filter)) ? '' :
        //                 'none';
        //         });
        //     });

        //     // Fungsi Filter Status
        //     filterStatus.addEventListener('change', function() {
        //         let status = filterStatus.value;
        //         rows.forEach(row => {
        //             let rowStatus = row.cells[5].textContent.trim();
        //             row.style.display = (status === '' || rowStatus === status) ? '' : 'none';
        //         });
        //     });
        // });

        // // Export ke CSV
        // function exportToCSV() {
        //     let table = document.getElementById('historyTable');
        //     let rows = Array.from(table.rows);
        //     let csvContent = rows.map(row => Array.from(row.cells).map(cell => cell.textContent).join(',')).join('\n');
        //     let blob = new Blob([csvContent], {
        //         type: 'text/csv'
        //     });
        //     let url = URL.createObjectURL(blob);
        //     let a = document.createElement('a');
        //     a.href = url;
        //     a.download = 'riwayat_tugas.csv';
        //     document.body.appendChild(a);
        //     a.click();
        //     document.body.removeChild(a);
        // }
    </script>
@endsection
