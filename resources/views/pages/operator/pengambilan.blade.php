@extends('layouts.app')

@section('content')
    <main class="app-main">
        <!-- Header -->
        <div class="app-content-header py-3 bg-light shadow-sm">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <h2 class="mb-0 fw-bold text-primary">
                            <i class="bi bi-check-circle-fill me-2"></i> Konfirmasi Pengambilan
                        </h2>
                    </div>
                    <div class="col-md-6 text-md-end">
                        <nav>
                            <ol class="breadcrumb float-sm-end">
                                <li class="breadcrumb-item">
                                    <a href="#" class="text-decoration-none text-secondary"><i
                                            class="bi bi-house-door"></i> Home</a>
                                </li>
                                <li class="breadcrumb-item active text-primary">Konfirmasi Pengambilan</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>

        <!-- Content -->
        <div class="app-content">
            <div class="container-fluid">
                <!-- Detail Pengambilan -->
                <div class="row mt-4">
                    <div class="col-12">
                        <h4 class="fw-bold text-secondary">
                            <i class="bi bi-info-circle-fill me-2"></i> Detail Pengambilan
                        </h4>
                    </div>
                </div>

                <div class="card shadow-sm mt-3 border-0">
                    <div class="card-body">
                        <!-- Info Nasabah -->
                        <p>
                            <i class="bi bi-person-fill me-2"></i><strong>Nama Nasabah:
                            </strong>{{ $tabungana->user->name }}
                        </p>
                        <p>
                            <i class="bi bi-geo-alt-fill me-2"></i><strong>Alamat: </strong> {{ $tabungana->user->alamat }}
                        </p>

                        <!-- Status -->
                        <p>
                            <i class="bi bi-hourglass-split me-2"></i><strong>Status: </strong>
                            <span
                                class="badge {{ $tabungana->status === 'proses' ? 'bg-warning text-dark' : 'bg-success text-light' }}">
                                {{ $tabungana->status }}
                            </span>
                        </p>

                        <!-- Tombol Aksi -->
                        <div class="d-grid gap-2 mt-3">
                            @if ($tabungana->status === 'proses')
                                <form action="{{ route('tabung.update', $tabungana->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-primary w-100" id="btnMulai">
                                        <i class="bi bi-truck"></i> Mulai Perjalanan
                                    </button>
                                </form>
                            @elseif ($tabungana->status === 'pengambilan')
                                <form action="{{ route('tabung.sampai', $tabungana->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-success w-100">Sampai</button>
                                </form>
                                <button class="btn btn-danger" id="btnBatal">
                                    <i class="bi bi-x-circle"></i> Batal
                                </button>
                            @elseif ($tabungana->status === 'sampai')
                                <form action="{{ route('tabung.input', $tabungana->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-success w-100">Input</button>
                                </form>
                            @elseif ($tabungana->status === 'inputdata')
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#editmodal{{ $tabungana->id }}">
                                    input data
                                </button>
                            @endif
                        </div>
                        <div class="modal fade" id="editmodal{{ $tabungana->id }}" aria-hidden="true" tabindex="-1">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header bg-warning text-white">
                                        <h5 class="modal-title fw-bold"><i class="fas fa-edit"></i>input
                                            data
                                            sampah user</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body">
                                        <label class="form-label">nama</label>
                                        <input type="text" value="{{ $tabungana->user->name }}" class="form-control"
                                            readonly>

                                        <form id="formTabung" action="{{ route('tabung.store', $tabungana->id) }}"
                                            method="POST">
                                            @csrf
                                            <label class="form-label">Jenis Sampah</label>
                                            <div class="mb-2 d-flex">
                                                <select name="select" id="selectjenis" class="form-control me-2">
                                                    <option value="">-- Pilih Jenis Sampah --</option>
                                                    @foreach ($jenismutasi as $jenis)
                                                        <option value="{{ $jenis->id }}"
                                                            dataharga="{{ $jenis->harga }}">
                                                            {{ $jenis->nama_sampah }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                <input type="number" name="bobot" id="Jumlah"
                                                    class="form-control me-2" placeholder="Bobot (kg)">
                                                <input type="text" name="harga" id="harga"
                                                    class="form-control me-2" placeholder="Total Harga (Rp)" readonly>
                                                <button type="button" id="btnTambah"
                                                    class="btn btn-primary">Tambah</button>
                                            </div>

                                            <div id="lisitem"></div>

                                            <button type="submit" class="btn btn-success mt-2">Kirim</button>
                                        </form>


                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Map -->
                        <div id="maps" class="w-10 mt-4" style="height: 60vh;"></div>

                        <!-- Komunikasi -->
                        <h5 class="mt-4"><i class="bi bi-chat-left-text-fill me-2"></i> Komunikasi</h5>
                        <div class="d-grid gap-2 mt-2">
                            <button class="btn btn-success" id="btnChat">
                                <i class="bi bi-chat-dots"></i> Chat dengan Nasabah
                            </button>
                            <button class="btn btn-secondary" id="btnCall">
                                <i class="bi bi-telephone-fill"></i> Panggilan Cepat
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            function formatRupiah(amount) {
                return new Intl.NumberFormat('id-ID', {
                    style: 'currency',
                    currency: 'IDR',
                    minimumFractionDigits: 0
                }).format(amount);
            }

            const selectJenis = document.getElementById('selectjenis');
            const inputJumlah = document.getElementById('Jumlah');
            const inputHarga = document.getElementById('harga');
            const btnTambah = document.getElementById('btnTambah');
            const listItem = document.getElementById('lisitem');
            const form = document.getElementById('formTabung');

            let itemCounter = 0;

            const hitungTotalHarga = () => {
                const selected = selectJenis.options[selectJenis.selectedIndex];
                const harga = parseFloat(selected.getAttribute('dataharga')) || 0;
                const jumlah = parseFloat(inputJumlah.value || 0);
                const total = harga * jumlah;
                inputHarga.value = formatRupiah(total);
            };

            selectJenis.addEventListener('change', hitungTotalHarga);
            inputJumlah.addEventListener('input', hitungTotalHarga);

            btnTambah.addEventListener('click', () => {
                const selectedOption = selectJenis.options[selectJenis.selectedIndex];
                const jumlah = parseFloat(inputJumlah.value || 0);
                const jenisId = selectedOption.value;

                if (!jenisId || isNaN(jumlah) || jumlah <= 0) {
                    alert("Pilih jenis sampah dan isi jumlah > 0");
                    return;
                }

                const isDuplicate = [...form.querySelectorAll('input[name$="[jenismutasi_id]"]')]
                    .some(input => input.value === jenisId);

                if (isDuplicate) {
                    alert("Jenis sampah ini sudah ditambahkan.");
                    return;
                }

                const hargaPerKg = parseFloat(selectedOption.getAttribute('dataharga'));
                const totalHarga = hargaPerKg * jumlah;

                // Hidden inputs
                const createHidden = (name, value) => {
                    const input = document.createElement('input');
                    input.type = 'hidden';
                    input.name = `items[${itemCounter}][${name}]`;
                    input.value = value;
                    input.dataset.index = itemCounter;
                    return input;
                };

                form.appendChild(createHidden('jenismutasi_id', jenisId));
                form.appendChild(createHidden('bobot', jumlah));
                form.appendChild(createHidden('total_harga', totalHarga));

                // Preview
                const preview = document.createElement('div');
                preview.className = 'mb-2 d-flex align-items-center item-row';
                preview.dataset.index = itemCounter;
                preview.innerHTML = `
                    <select class="form-control me-2" disabled>
                        <option>${selectedOption.text}</option>
                    </select>
                    <input type="number" class="form-control me-2" value="${jumlah}" readonly>
                    <input type="text" class="form-control me-2" value="${formatRupiah(totalHarga)}" readonly>
                    <button type="button" class="btn btn-danger btn-hapus-item">Hapus</button>
                `;

                preview.querySelector('.btn-hapus-item').addEventListener('click', () => {
                    form.querySelectorAll(`input[data-index="${preview.dataset.index}"]`).forEach(
                        i => i.remove());
                    preview.remove();
                });

                listItem.appendChild(preview);
                itemCounter++;

                // Reset input
                selectJenis.value = '';
                inputJumlah.value = '';
                inputHarga.value = '';
            });
        });
    </script>

    <!-- Leaflet.js & Routing -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script src="https://unpkg.com/leaflet-routing-machine@3.2.12/dist/leaflet-routing-machine.min.js"></script>
    <script>
        // Data Koordinat Lokasi Nasabah
        const userLat = {{ $tabungana->garis_lintang ?? -8.198672 }};
        const userLng = {{ $tabungana->garis_bujur ?? 111.101616 }};

        // Pastikan map hanya dideklarasikan sekali
        let maps = L.map('maps').setView([userLat, userLng], 14);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© OpenStreetMap'
        }).addTo(maps);

        // Marker Lokasi Nasabah
        L.marker([userLat, userLng]).addTo(maps).bindPopup('Lokasi Nasabah').openPopup();

        // Geolocation: Posisi Operator
        let routeControl;
        let operatorMarker;

        if (navigator.geolocation) {
            navigator.geolocation.watchPosition(function(position) {
                const lat = position.coords.latitude;
                const lng = position.coords.longitude;

                // Update Marker Posisi Operator
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

                // Hapus rute lama sebelum menggambar rute baru
                if (routeControl) {
                    map.removeControl(routeControl);
                }

                // Menambahkan Rute (Garis) antara Posisi Operator dan Lokasi Nasabah
                routeControl = L.Routing.control({
                    waypoints: [
                        L.latLng(lat, lng),
                        L.latLng(userLat, userLng)
                    ],
                    lineOptions: {
                        styles: [{
                            color: 'green',
                            weight: 4
                        }]
                    },
                    createMarker: () => null,
                    addWaypoints: false,
                    draggableWaypoints: false,
                    routeWhileDragging: false // <--- ubah ini dulu jadi false
                }).addTo(maps);


            }, function(error) {
                alert("Gagal mendapatkan lokasi: " + error.message);
            });
        } else {
            alert("Browser kamu tidak mendukung geolocation.");
        }
    </script>
@endsection
