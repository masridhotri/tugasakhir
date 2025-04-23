@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12 col-xl-4">

            <div class="card" style="border-radius: 15px;">
                <div class="card-body text-start">
                    <h4 class="mb-2">{{ Auth::user()->name }} </h4>
                    <div class="d-flex justify-content-between text-center mt-5 mb-2">
                        <div class="ms-3">
                            <p class="mb-2 h5">2000</p>
                            <p class="text-muted mb-0">pengeluaran</p>
                        </div>
                        <div class="px-3 ms-2">
                            <p class="mb-2 h5"></p>
                            <p class="text-muted mb-0">saldo</p>
                        </div>
                        <div>
                            <p class="mb-2 h5"> </p>
                            <p class="text-muted mb-0">Total Sampah</p>
                        </div>
                    </div>
                </div>
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home-tab-pane"
                            type="button" role="tab" aria-controls="home-tab-pane" aria-selected="true">Home</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile-tab-pane"
                            type="button" role="tab" aria-controls="profile-tab-pane"
                            aria-selected="false">Profile</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact-tab-pane"
                            type="button" role="tab" aria-controls="contact-tab-pane"
                            aria-selected="false">Contact</button>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab"
                        tabindex="0">
                        <div class="tab-content pt-3">
                            <div class="tab-pane fade show active" id="dashboard" role="tabpanel"
                                aria-labelledby="info-tab">
                                <div class="mb-3">
                                    <input type="text" name="nama" value="{{ Auth::user()->name }}"
                                        class="form-control @error('judul') is-invalid @enderror" id="inputnama"
                                        aria-describedby="judulHelp" class="border border-3" readonly>
                                </div>
                                <div class="mb-3">
                                    <input type="text" name="email" value="{{ Auth::user()->email }}"
                                        class="form-control @error('judul') is-invalid @enderror" id="inputnama"
                                        aria-describedby="judulHelp" readonly>
                                </div>
                                <div class="mb-3 ">
                                    <form action="{{ route('updatedata') }}" method="POST">
                                        @csrf
                                        <input type="text" name="alamat"
                                            value="{{ old('alamat', Auth::user()->alamat) }}"
                                            class="form-control @error('alamat') is-invalid @enderror mb-2" id="alamat"
                                            readonly>

                                        <div id="map" style="height: 400px; margin-bottom: 20px;"></div>

                                        <input type="hidden" name="garis_lintang" id="latitude"
                                            value="{{ old('garis_lintang', Auth::user()->garis_lintang) }}">
                                        <input type="hidden" name="garis_bujur" id="longitude"
                                            value="{{ old('garis_bujur', Auth::user()->garis_bujur) }}">

                                        <div class="button d-flex">
                                            <button type="submit" class="btn btn-primary mt-3" id="submit"
                                                {{ Auth::user()->alamat && Auth::user()->garis_lintang && Auth::user()->garis_bujur ? 'disabled' : '' }}>
                                                Simpan Lokasi
                                            </button>
                                            <button type="button" class="btn btn-warning mt-3" id="editlokasi"
                                                {{ !(Auth::user()->alamat && Auth::user()->garis_lintang && Auth::user()->garis_bujur) ? 'style=display:none' : '' }}>
                                                Ubah Lokasi
                                            </button>
                                        </div>
                                    </form>

                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="profile-tab-pane" role="tabpanel" aria-labelledby="profile-tab"
                            tabindex="0">

                            @foreach ($tabungan as $nabung)
                                <div class="card" style="width: 18rem;">
                                    <img src="..." class="card-img-top" alt="...">
                                    <div class="card-body">
                                        <p class="card-text">Some quick example text to build on the card title and
                                            make up the bulk of the card's content.</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="tab-pane fade" id="contact-tab-pane" role="tabpanel" aria-labelledby="contact-tab"
                            tabindex="0">soleh </div>
                    </div>

                </div>
            </div>
        </div>

    </div>
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

    <script src="https://unpkg.com/leaflet-routing-machine/dist/leaflet-routing-machine.min.js"></script>

    <script>
        const hasData =
            {{ Auth::user()->alamat && Auth::user()->garis_lintang && Auth::user()->garis_bujur ? 'true' : 'false' }};
        const defaultLat = {{ Auth::user()->garis_lintang ?? -8.198672 }};
        const defaultLng = {{ Auth::user()->garis_bujur ?? 111.101616 }};

        const map = L.map('map').setView([defaultLat, defaultLng], 16);
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© OpenStreetMap contributors'
        }).addTo(map);

        let marker = L.marker([defaultLat, defaultLng]).addTo(map);

        // Helper
        function setMapInteractivity(enabled) {
            if (enabled) {
                map.scrollWheelZoom.enable();
                map.dragging.enable();
                map.doubleClickZoom.enable();
                map.touchZoom.enable();
                map.boxZoom.enable();
                map.keyboard.enable();
            } else {
                map.scrollWheelZoom.disable();
                map.dragging.disable();
                map.doubleClickZoom.disable();
                map.touchZoom.disable();
                map.boxZoom.disable();
                map.keyboard.disable();
                map.off('click'); // Lepas semua event click
            }
        }

        function mapClickHandler(e) {
            const lat = e.latlng.lat.toFixed(6);
            const lng = e.latlng.lng.toFixed(6);

            // Update input value
            document.getElementById('latitude').value = lat;
            document.getElementById('longitude').value = lng;

            if (marker) {
                map.removeLayer(marker);
            }

            marker = L.marker([lat, lng]).addTo(map);
            map.setView([lat, lng], 16);

            // Ambil alamat
            fetch(`https://nominatim.openstreetmap.org/reverse?lat=${lat}&lon=${lng}&format=json`)
                .then(response => response.json())
                .then(data => {
                    let road = data.address.road || '';
                    let county = data.address.county || '';
                    let alamat = `${road}, ${county}`;
                    document.getElementById('alamat').value = alamat;
                })
                .catch(error => {
                    console.error('Gagal ambil alamat:', error);
                    document.getElementById('alamat').value = 'Alamat tidak ditemukan';
                });
        }

        // Kalau belum ada data, langsung aktifkan map click
        if (!hasData) {
            setMapInteractivity(true);
            map.on('click', mapClickHandler);
        } else {
            // Sudah ada data, map dibekukan dulu
            setMapInteractivity(false);
            marker.bindPopup("Lokasi Anda").openPopup();
        }

        // --- Ubah lokasi ---
        const editBtn = document.getElementById('editlokasi');
        const resetBtn = document.getElementById('resetlokasi');
        const alamatInput = document.getElementById('alamat');
        const submitBtn = document.getElementById('submit');

        editBtn?.addEventListener('click', () => {
            setMapInteractivity(true);
            map.on('click', mapClickHandler); // Aktifkan click ulang
            alamatInput.readOnly = false;
            submitBtn.disabled = false;
            editBtn.style.display = 'none';
            resetBtn.style.display = 'inline-block';
            alert('Silakan klik ulang lokasi di peta');
        });

        // --- Reset lokasi ke awal ---
        resetBtn?.addEventListener('click', () => {
            document.getElementById('latitude').value = defaultLat;
            document.getElementById('longitude').value = defaultLng;

            if (marker) {
                map.removeLayer(marker);
            }
            marker = L.marker([defaultLat, defaultLng]).addTo(map);
            map.setView([defaultLat, defaultLng], 16);

            fetch(`https://nominatim.openstreetmap.org/reverse?lat=${defaultLat}&lon=${defaultLng}&format=json`)
                .then(response => response.json())
                .then(data => {
                    let road = data.address.road || '';
                    let county = data.address.county || '';
                    let alamat = `${road}, ${county}`;
                    document.getElementById('alamat').value = alamat;
                })
                .catch(error => {
                    console.error('Gagal ambil alamat:', error);
                    document.getElementById('alamat').value = 'Alamat tidak ditemukan';
                });

            alert('Lokasi dikembalikan ke posisi awal');
        });
    </script>
@endsection
