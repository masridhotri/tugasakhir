@extends('layouts.app')

@section('content')
    <main class="app">
        <div class="app-content">
            <div class="container-fluid py-4">

                {{-- DASHBOARD UNTUK USER --}}
                @if (Auth::user()->role === 'user')
                    <section class="app-main">
                        <div class="app-content-header py-3 bg-light shadow-sm">
                            <h4 class="text-primary fw-bold">Selamat datang, {{ Auth::user()->name }}</h4>
                        </div>


                        <div class="row g-3 mt-2">
                            <!-- Kartu: Saldo, Sampah, Target, Ranking -->
                            <div class="col-md-3">
                                <div class="card shadow text-center p-3">
                                    <div class="text-muted">Saldo</div>
                                    <h4 class="text-success fw-bold"> Rp: {{ number_format($saldo) }}</h4>
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#exampleModal">
                                        Tarik saldo
                                    </button>
                                </div>
                            </div>
                            <!-- Tambahkan kartu lainnya di sini -->
                        </div>
                        <div class="row g-3 mt-2">
                            <!-- Kartu: Saldo, Sampah, Target, Ranking -->
                            <div class="col-md-3">
                                <div class="card shadow text-center p-3">
                                    <div class="text-muted">Total Bobot</div>
                                    <h4 class="text-success fw-bold">{{ $totalbobot }} Kg</h4>
                                </div>
                            </div>
                            <!-- Tambahkan kartu lainnya di sini -->
                        </div>
                        <div class="row g-3 mt-2">
                            <!-- Kartu: Saldo, Sampah, Target, Ranking -->
                            <div class="col-md-3">
                                <div class="card shadow text-center p-3">
                                    <div class="text-muted">uang keluar</div>
                                    <h4 class="text-success fw-bold"> {{ $Nominal ? '-' . $Nominal . ' Kg' : '' }}
                                    </h4>
                                </div>
                            </div>
                            <!-- Tambahkan kartu lainnya di sini -->
                        </div>

                        <div class="row g-3 mt-4">
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
                        </div>

                        <form action="{{ route('tabung.new') }}" method="POST" id="transaksiForm" class="mt-4">
                            @csrf
                            <button type="submit" class="btn btn-primary w-100">
                                <span id="btnText">Buat Transaksi Baru</span>
                                <i class="bi bi-rocket-takeoff-fill d-none" id="rocketIcon"></i>
                            </button>
                        </form>
                    </section>
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('saldo', $mutasi->id) }}" method="POST">
                                        @csrf
                                        <label for="nominal">Isi Nominal Pengeluaran:</label>
                                        <input type="number" name="nominal" min="1" required>
                                        <button type="submit" class="btn btn-warning">Simpan</button>
                                    </form>
                                    {{-- @else
                                    <div class="alert alert-warning">Tidak ada data mutasi yang tersedia untuk ditarik.</div>
                                    @endif --}}
                                    
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-primary">Save changes</button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

                {{-- DASHBOARD UNTUK OPERATOR --}}
                @if (Auth::user()->role === 'operator')
                    <section class="app-main">
                        <div class="app-content-header py-3 bg-light shadow-sm">
                            <h4 class="text-primary fw-bold">Dashboard Operator</h4>
                        </div>

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

                        <div class="row mt-4">
                            <div class="col-lg-6">
                                <h5 class="fw-bold text-secondary"><i class="bi bi-graph-up-arrow"></i> Statistik
                                    Pengambilan</h5>
                                <canvas id="chartPengambilanSampah" style="width:100%; height:25rem;"></canvas>
                            </div>

                            <div class="col-lg-6">
                                <h5 class="fw-bold text-secondary"><i class="bi bi-list-ul me-2"></i>Daftar Tugas</h5>
                                <input type="text" class="form-control mb-2" placeholder="Cari tugas...">
                                <div class="card shadow p-3">
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
                                <!-- Tambahkan list tugas lainnya -->
                            </div>
                        </div>
                    </section>
                @endif

            </div>
        </div>
    </main>

    {{-- ChartJS CDN --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    {{-- SCRIPT UNTUK USER --}}
    @if (Auth::user()->role === 'user')
        @php
            $trenData = $chartall ?? [10, 20, 15, 12, 9, 30, 25, 40, 38, 29, 20, 15];
        @endphp

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
                        backgroundColor: ['blue', 'green', 'red']
                    }]
                }
            });
        </script>
    @endif


    {{-- SCRIPT UNTUK OPERATOR --}}
    @if (Auth::user()->role === 'operator')
        @php
            $pengambilanData = $chartData ?? [5, 6, 7, 8, 6, 5, 9, 10, 8, 6, 4, 3];
        @endphp

        <script>
            const pengambilanData = @json($pengambilanData);

            new Chart(document.getElementById('chartPengambilanSampah'), {
                type: 'bar',
                data: {
                    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'],
                    datasets: [{
                        label: 'Jumlah Selesai',
                        data: pengambilanData,
                        backgroundColor: 'rgba(255, 99, 132, 0.7)',
                    }]
                }
            });
        </script>
    @endif
@endsection
