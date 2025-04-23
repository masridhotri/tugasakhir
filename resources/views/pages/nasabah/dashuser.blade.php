@extends('layouts.app')

@section('content')
    {{-- @if (auth()->user()->role === 'admin') --}}
    <main class="app">
        {{-- <div class="app-content-header py-3 bg-light shadow-sm">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <h2 class="mb-0 fw-bold text-primary">{{ Auth::user()->name }}</h2>
                    </div>
                    <div class="col-md-6 text-md-end">
                        <nav>
                            <ol class="breadcrumb float-sm-end">
                                <li class="breadcrumb-item"><a href="#"
                                        class="text-decoration-none text-secondary">Home</a></li>
                                <li class="breadcrumb-item active text-primary" aria-current="page">Dashboard</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div> --}}

        <div class="app-content">
            <div class="container-fluid py-4">
                <div class="row g-3">
                    <!-- Kartu Ringkasan -->
                 

                </div>
                {{-- for user --}}
                @if (Auth::user()->role === 'user')
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
                                                <li class="breadcrumb-item"><a href="#"
                                                        class="text-decoration-none text-secondary">Home</a></li>
                                                <li class="breadcrumb-item active text-primary" aria-current="page">
                                                    Dashboard</li>
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
                                                    <div class="text-xs font-weight-bold text-primary text-uppercase">Saldo
                                                        Tabungan</div>
                                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                        Rp{{ number_format($saldo, 0, ',', '.') }}</div>
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
                                                    <div class="text-xs font-weight-bold text-success text-uppercase">Total
                                                        Sampah Disetorkan</div>
                                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                        {{ number_format($totalbobot, 2, ',', '.') }} Kg</div>
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
                                                    <div class="text-xs font-weight-bold text-info text-uppercase">Target
                                                        Bulanan</div>
                                                    <div class="h5 mb-0 font-weight-bold text-gray-800">50%</div>
                                                    <div class="progress mt-2">
                                                        <div class="progress-bar bg-info" style="width: 50%;"
                                                            aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
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
                                                    <div class="text-xs font-weight-bold text-warning text-uppercase">
                                                        Peringkat Nasabah</div>
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
                                    <form action="{{ route('tabung.new') }}" method="POST" id="transaksiForm">
                                        @csrf
                                        <button type="submit"
                                            class="btn btn-primary w-100  justify-content-center align-items-center gap-2"
                                            id="submitBtn">
                                            <span id="btnText">Buat Transaksi Baru</span>
                                            <i class="bi bi-rocket-takeoff-fill d-none" id="rocketIcon"></i>
                                        </button>
                                    </form>
                                </div>

                                <!-- Notifikasi -->
                                {{-- <div class="alert alert-warning mt-3">
                                    <i class="fas fa-bell"></i> Ingat! Anda belum menyetor sampah selama 2 minggu. Yuk, setor sekarang!
                                </div> --}}

                                <!-- Riwayat Sampah -->
                                {{-- <div class="card shadow mt-3">
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
                                </div> --}}

                            </div>
                        </div>
                    </main>
                @endif

                {{-- for operator --}}
                @if (Auth::user()->role === 'operator')
                    <main class="app-main">
                        <!-- Header -->
                        <div class="app-content-header py-3 bg-light shadow-sm">
                            <div class="container-fluid">
                                <div class="row align-items-center">
                                    <div class="col-md-6">
                                        <h2 class="mb-0 fw-bold text-primary"></i>Dashboard</h2>
                                    </div>
                                    <div class="col-md-6 text-md-end">
                                        <nav>
                                            <ol class="breadcrumb float-sm-end">
                                                <li class="breadcrumb-item">
                                                    <a href="#" class="text-decoration-none text-secondary">
                                                        <i class="bi bi-house-door-fill"></i> Home
                                                    </a>
                                                </li>
                                                <li class="breadcrumb-item active text-primary">Dashboard</li>
                                            </ol>
                                        </nav>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="app-content">
                            <div class="container-fluid">
                                <!-- Statistik -->
                                <div class="row g-2 text-center">
                                    <div class="col-12">
                                        <h4 class="fw-bold text-secondary my-4"><i class="bi bi-list-task me-2"></i>Daftar
                                            Tugas Hari Ini</h4>
                                    </div>
                                    <div class="col-12">
                                        <div class="row">
                                            <div class="col-4">
                                                <div class="small-box text-bg-primary shadow-sm">
                                                    <div class="inner">
                                                        <h3>{{ $tabungtotalreq }}</h3>
                                                        <p>Total Permintaan </p>
                                                    </div>
                                                    <i class="bi bi-map-fill small-box-icon"></i>
                                                </div>
                                            </div>

                                            <div class="col-4">
                                                <div class="small-box text-bg-warning text-white shadow-sm">
                                                    <div class="inner">
                                                        <h3>{{ $tabungtuntas }}</h3>
                                                        <p>Permintaan Tuntas </p>
                                                    </div>
                                                    <i class="bi bi-check-circle-fill small-box-icon"></i>
                                                </div>
                                            </div>

                                            <div class="col-4">
                                                <div class="small-box text-bg-danger shadow-sm">
                                                    <div class="inner">
                                                        <h3>{{ $tabunganproses }}</h3>
                                                        <p>Tabungan Diproses </p>
                                                    </div>
                                                    <i class="bi bi-x-circle-fill small-box-icon"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Notifikasi -->
                                {{-- <section id="notifikasi" class="mt-4">
                                    <h4 class="fw-bold text-secondary text-center"><i
                                            class="bi bi-bell-fill me-2"></i>Notifikasi & Pemberitahuan</h4>
                                    <div class="alert alert-warning">
                                        <i class="bi bi-exclamation-circle-fill me-2"></i> Tugas baru: Pengambilan sampah
                                        di Jl. Sudirman No. 20 pukul 11:30 AM.
                                    </div>
                                    <div class="alert alert-info">
                                        <i class="bi bi-calendar-check-fill me-2"></i> Perubahan jadwal: Pengambilan sampah
                                        di Jl. Ahmad Yani dimajukan ke pukul 09:00AM.
                                    </div>
                                    <div class="alert alert-danger">
                                        <i class="bi bi-exclamation-triangle-fill me-2"></i> Pengingat: Pastikan
                                        pengambilan di Jl. Gatot Subroto sebelum pukul 14:00.
                                    </div>
                                </section> --}}

                                <!-- Peta dan Tabel Daftar Tugas -->
                                <div class="row mt-4">
                                    <div class="col-lg-6">
                                        <h5 class="fw-bold text-secondary"><i class="bi bi-graph-up-arrow"></i> Statistik
                                            Pengambilan</h5>
                                        <canvas id="chartpengambilansampah"style="width:40rem; height:25rem;"></canvas>

                                    </div>

                                    <div class="col-lg-6">
                                        <h5 class="fw-bold text-secondary"><i class="bi bi-list-ul me-2"></i>Daftar Tugas
                                        </h5>
                                        <div class="mb-3">
                                            <input type="text" class="form-control" id="searchInput"
                                                placeholder="Cari Nama atau Alamat...">
                                        </div>
                                        <div class="container"
                                            style="height: 40vh; width:100%; overflow-y: auto; overflow-x: hidden; padding-right: 0.5rem; scrollbar-width: none; -ms-overflow-style: none;">
                                            @foreach ($tabungproses as $tabung)
                                                <div class="card mt-3 mb-4" style="height:13rem; width:100%;">
                                                    <div class="card-header mt-1" style="background-color:black;">
                                                        <h3 class="text-light">{{ $tabung->nama_user }}</h3>
                                                    </div>
                                                    <div class="card-body">
                                                        <div class="datadiri">
                                                            <h5>Status :{{ $tabung->status }}</h5>
                                                            <h5>Alamat :{{ $tabung->alamat_user }}</h5>
                                                        </div>
                                                        <div class="button d-flex justify-content-end">
                                                            @if ($tabung->status === 'proses')
                                                                <form action="{{ route('tabung.update', $tabung->id) }}"
                                                                    method="POST">
                                                                    @csrf
                                                                    <button type="submit"
                                                                        class="btn btn-outline-primary">ambil</button>
                                                                </form>
                                                            @endif
                                                            @if ($tabung->status === 'pengambilan')
                                                                <form action="{{ route('tabung.sampai', $tabung->id) }} "
                                                                    method="POST">
                                                                    @csrf
                                                                    <button type="submit"
                                                                        class="btn btn-success">sampai</button>
                                                                </form>
                                                            @elseif($tabung->status === 'sampai')
                                                                <form action="{{ route('tabung.input', $tabung->id) }} "
                                                                    method="POST">
                                                                    @csrf
                                                                    <button type="submit"
                                                                        class="btn btn-success ">input</button>
                                                                </form>
                                                            @endif
                                                            <a href="{{ route('detailjemput', $tabung->id) }}">
                                                                <button type="button"
                                                                    class="btn btn-outline-success ">Konfirmasi
                                                                    Pengambilan</button>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>

                                <!-- Permintaan Baru -->

                            </div>
                        </div>
                    </main>
                @endif

                <!-- Grafik -->
                @if (Auth::user()->role === 'admin')
                    <div class="row g-3 mt-2">
                        <div class="col-md-8">
                            <div class="card shadow">
                                <div class="card-body">
                                    <h6 class="text-primary fw-bold">Tren Setoran Sampah per Bulan</h6>
                                    <canvas id="adminsampah"></canvas>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="card shadow">
                                <div class="card-body">
                                    <h6 class="text-primary fw-bold">Komposisi Jenis Sampah</h6>
                                    <canvas id="charJenisSampah"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
                <!-- Notifikasi -->
                {{-- <div class="alert alert-warning mt-3">
                    <i class="fas fa-bell"></i> Ingat! Anda belum menyetor sampah selama 2 minggu. Yuk, setor sekarang!
                </div> --}}

                <!-- Riwayat Sampah -->
                @if (Auth::user()->role === 'admin')
                   
                @endif




                @if (Auth::user()->role === 'operator')
                @endif
            </div>
        </div>



    </main>
    {{-- @elseif(auth()->user()->role === 'user') --}}

   







    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Chart Pengambilan Sampah
        const dataChart = @json($chartData);

        var ctxPengambilan = document.getElementById('chartpengambilansampah').getContext('2d');
        var chartPengambilan = new Chart(ctxPengambilan, {
            type: 'bar',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'],
                datasets: [{
                    label: 'Jumlah Selesai',
                    data: dataChart,
                    backgroundColor: 'rgba(54, 162, 235, 0.7)'
                }]
            }
        });

        // Chart Tren Sampah
        // Data total bobot sampah per bulan yang diambil dari query
        const totalBobotPerBulan = @json($chartall  );

        var ctxTren = document.getElementById('adminsampah').getContext('2d');
        var chartTren = new Chart(ctxTren, {
            type: 'bar',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'],
                datasets: [{
                    label: 'Kg Sampah',
                    data: totalBobotPerBulan,
                    backgroundColor: 'rgba(54, 162, 235, 0.7)',
                }]
            }
        });


        // Chart Jenis Sampah
        var ctxJenis = document.getElementById('chartJenisSampah').getContext('2d');
        var chartJenis = new Chart(ctxJenis, {
            type: 'pie',
            data: {
                labels: ['Plastik', 'Kertas', 'Kaleng'],
                datasets: [{
                    data: [40, 35, 25],
                    backgroundColor: ['blue', 'green', 'red']
                }]
            }
        });
    </script>

@endsection
