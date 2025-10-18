@extends('layouts.app')

@section('content')
    <main class="app-main">
        <!-- Header -->
        {{-- <div class="app-content-header py-3 bg-light shadow-sm">
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
        </div> --}}

        <div class="app-content">
            <div class="container-fluid">
                <!-- Statistik -->
                <div class="row g-3 text-center">
                    <div class="col-12">
                        <h4 class="fw-bold text-secondary my-4"><i class="bi bi-list-task me-2"></i>Daftar Tugas Hari Ini</h4>
                    </div>

                    <div class="col-lg-3 col-md-6">
                        <div class="small-box text-bg-primary shadow-sm">
                            <div class="inner">
                                <h3> {{ $tabungproses }} Lokasi</h3>
                                <p>Total Permintaan Pengambilan</p>
                            </div>
                            <i class="bi bi-map-fill small-box-icon"></i>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6">
                        <div class="small-box text-bg-success shadow-sm">
                            <div class="inner">
                                <h3>{{ $dataBobot }}</h3>
                                <p>Total Estimasi Sampah</p>
                            </div>
                            <i class="bi bi-recycle small-box-icon"></i>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6">
                        <div class="small-box text-bg-warning text-white shadow-sm">
                            <div class="inner">
                                <h3>1</h3>
                                <p>Status Sudah Diambil</p>
                            </div>
                            <i class="bi bi-check-circle-fill small-box-icon"></i>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6">
                        <div class="small-box text-bg-danger shadow-sm">
                            <div class="inner">
                                <h3>2</h3>
                                <p>Status Belum Diambil</p>
                            </div>
                            <i class="bi bi-x-circle-fill small-box-icon"></i>
                        </div>
                    </div>
                </div>

                <!-- Notifikasi -->
                {{-- <section id="notifikasi" class="mt-4">
                    <h4 class="fw-bold text-secondary text-center"><i class="bi bi-bell-fill me-2"></i>Notifikasi & Pemberitahuan</h4>
                    <div class="alert alert-warning">
                        <i class="bi bi-exclamation-circle-fill me-2"></i> Tugas baru: Pengambilan sampah di Jl. Sudirman No. 20 pukul 11:30 AM.
                    </div>
                    <div class="alert alert-info">
                        <i class="bi bi-calendar-check-fill me-2"></i> Perubahan jadwal: Pengambilan sampah di Jl. Ahmad Yani dimajukan ke pukul 09:00AM.
                    </div>
                    <div class="alert alert-danger">
                        <i class="bi bi-exclamation-triangle-fill me-2"></i> Pengingat: Pastikan pengambilan di Jl. Gatot Subroto sebelum pukul 14:00.
                    </div>
                </section> --}}

                <!-- Peta dan Tabel Daftar Tugas -->

                <div class="row mt-4">
                    <div class="col-lg-6">
                        <h5 class="fw-bold text-secondary"><i class="bi bi-geo-alt-fill me-2"></i>Lokasi Penjemputan</h5>
                        <div id="maps" style="height: 400px; width: 100%;" class="rounded border"></div>
                    </div>

                    <div class="col-lg-6">
                        <h5 class="fw-bold text-secondary"><i class="bi bi-list-ul me-2"></i>Daftar Tugas</h5>
                        <div class="mb-3">
                            <input type="text" class="form-control" id="searchInput"
                                placeholder="Cari Nama atau Alamat...">
                        </div>
                        <div class="table-responsive">
                            <table class="table table-hover table-bordered text-center">
                                <thead class="table-dark">
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Alamat</th>
                                        <th>Jumlah Sampah</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody id="tableBody">
                                    @foreach ($tabungpro as $tabung)
                                        <tr class="table-success">
                                            <td>{{ $loop->iteration }} </td>
                                            <td>{{ $tabung->nama_user }} </td>
                                            <td>{{ $tabung->alamat_user }} </td>
                                            <td>5 kg</td>
                                            <td class ="d-flex justify-content-center gap-1">
                                                @if ($tabung->status === 'proses')
                                                    <form action="{{ route('tabung.update', $tabung->id) }}" method="POST">
                                                        @csrf
                                                        <button type="submit"
                                                            class="btn btn-outline-primary">ambil</button>
                                                    </form>
                                                @endif
                                                @if ($tabung->status === 'pengambilan')
                                                    <form action="{{ route('tabung.sampai', $tabung->id) }} "
                                                        method="POST">
                                                        @csrf
                                                        <button type="submit" class="btn btn-success">sampai</button>
                                                    </form>
                                                @elseif($tabung->status === 'sampai')
                                                    <form action="{{ route('tabung.input', $tabung->id) }} " method="POST">
                                                        @csrf
                                                        <button type="submit" class="btn btn-success ">input</button>
                                                    </form>
                                                @endif
                                                <a href="{{ route('detailjemput', $tabung->id) }}">
                                                    <button type="button" class="btn btn-success ">Konfirmasi</button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>

                <!-- Permintaan Baru -->
                {{-- <section id="permintaan-baru" class="mt-5">
                    <h4 class="fw-bold text-secondary text-center"><i class="bi bi-person-plus-fill me-2"></i>Permintaan
                        Baru</h4>
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered text-center">
                            <thead class="table-primary">
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Alamat</th>
                                    <th>Jumlah Sampah</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>Siti</td>
                                    <td>Jl. Anggrek No. 20</td>
                                    <td>4 kg</td>
                                    <td>
                                        <button class="btn btn-success btn-sm"><i class="bi bi-check2"></i> Terima</button>
                                        <button class="btn btn-danger btn-sm"><i class="bi bi-x"></i> Tolak</button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>Rudi</td>
                                    <td>Jl. Kenanga No. 5</td>
                                    <td>2 kg</td>
                                    <td>
                                        <button class="btn btn-success btn-sm"><i class="bi bi-check2"></i> Terima</button>
                                        <button class="btn btn-danger btn-sm"><i class="bi bi-x"></i> Tolak</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </section> --}}
            </div>
        </div>
    </main>
@endsection
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script src="https://unpkg.com/leaflet-routing-machine@3.2.12/dist/leaflet-routing-machine.min.js"></script>
<script>
    // Ambil semua data user dari controller
    const lokasiUsers = @json($lokasi);

    // Inisialisasi peta
    const maps = L.map('maps').setView([-8.198672, 111.101616], 12);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '© OpenStreetMap'
    }).addTo(maps);

    // Tambahkan marker untuk setiap user
    lokasiUsers.forEach(user => {
        if (user.garis_lintang && user.garis_bujur) {
            L.marker([user.garis_lintang, user.garis_bujur])
                .addTo(maps)
                .bindPopup(`<b>${user.name}</b><br>Lat: ${user.garis_lintang}<br>Lng: ${user.garis_bujur}`);
        }
    });

    // Opsional: auto zoom agar semua marker kelihatan
    const group = new L.featureGroup(lokasiUsers.map(u => L.marker([u.garis_lintang, u.garis_bujur])));
    maps.fitBounds(group.getBounds());\
    let operatorMarker;

if (navigator.geolocation) {
    navigator.geolocation.watchPosition(function(position) {
        const lat = position.coords.latitude;
        const lng = position.coords.longitude;

        if (operatorMarker) {
            operatorMarker.setLatLng([lat, lng]);
        } else {
            operatorMarker = L.marker([lat, lng], {
                icon: L.icon({
                    iconUrl: 'https://cdn-icons-png.flaticon.com/512/684/684908.png',
                    iconSize: [32, 32],
                })
            }).addTo(maps).bindPopup("Posisi Kamu").openPopup();
        }
    });
}
</script>

