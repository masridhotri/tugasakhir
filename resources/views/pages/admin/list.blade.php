@extends('layouts.app')

@section('content')
<main class="app-main">
    <!-- Header -->
    <div class="app-content-header py-3 bg-light shadow-sm">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <h2 class="mb-0 fw-bold text-primary">Dashboard</h2>
                </div>
                <div class="col-md-6 text-md-end">
                    <nav>
                        <ol class="breadcrumb float-sm-end">
                            <li class="breadcrumb-item">
                                <a href="#" class="text-decoration-none text-secondary">Home</a>
                            </li>
                            <li class="breadcrumb-item active text-primary">Dashboard</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <!-- Content -->
    <div class="app-content ">
        <div class="container-fluid">
            <div class="row g-3 d-flex justify-content-center">
               
                <div class="col-lg-3 col-md-6">
                    <div class="small-box text-bg-success shadow-lg rounded-3">
                        <div class="inner">
                            <h3>{{$pelanggan}}</h3>
                            <p>Total Pelanggan </p>
                        </div>
                        <i class="bi-people small-box-icon"></i>
                        <a href="#" class="small-box-footer text-white">Info Selengkapnya <i class="bi bi-link-45deg"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="small-box text-bg-primary shadow-lg rounded-3">
                        <div class="inner">
                            <h3>{{$bobotabung}} kg</h3>
                            <p>Bobot total</p>
                        </div>
                        <i class="bi-cart small-box-icon"></i>
                        <a href="#" class="small-box-footer text-white">Info Selengkapnya <i class="bi bi-link-45deg"></i></a>
                    </div>
                </div>
                {{-- @endforeach --}}
                <div class="col-lg-3 col-md-6">
                    <div class="small-box text-bg-danger shadow-lg rounded-3">
                        <div class="inner">
                            <h3> Rp {{ number_format($totalsaldo) }}</h3>
                            <p>Total Saldo User </p>
                        </div>
                        <i class="bi-wallet small-box-icon"></i>
                        <a href="#" class="small-box-footer text-white">Info Selengkapnya <i class="bi bi-link-45deg"></i></a>
                    </div>
                </div>
               
            </div>

            <!-- Grafik -->
            <div class="row mt-4">
                <div class="col-lg-7">
                    <div class="card shadow-lg rounded-3">
                        <div class="card-header bg-primary text-white d-flex align-items-center">
                            <i class="bi bi-graph-up me-2"></i>
                            <h5 class="card-title mb-0">Grafik Total Bobot Bulanan</h5>
                        </div>
                        <div class="card-body">
                            <canvas id="pendapatanBulanChart" style="height: 300px;"></canvas>
                        </div>
                    </div>
                </div>

                <div class="col-lg-5">
                    <div class="card shadow-lg rounded-3">
                        <div class="card-header bg-success text-white d-flex align-items-center">
                            <i class="bi bi-pie-chart-fill me-2"></i>
                            <h5 class="card-title mb-0">Grafik Pendapatan per Jenis Sampah</h5>
                        </div>
                        <div class="card-body">
                            <canvas id="pendapatanJenisChart" style="height: 300px;"></canvas>
                        </div>
                    </div>
                </div>
                <div class="card shadow mt-3 mb-5">
                    <div class="card-header bg-primary text-white fw-bold">
                        Riwayat Sampah
                    </div>
                    <div class="card-body">
                        <table id="example" class="table table-striped nowrap" style="width:100%; ">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>nama</th>
                                    <th>status</th>
                                    <th>alamat</th>
                                    <th>aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($tabunginput as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->nama_user }}</td>
                                        <td>{{ $item->status }}</td>
                                        <td>{{ $item->alamat_user }}</td>
                                        <td class="d-flex gap-2">
                                            <div class="edit">
                                                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                                    data-bs-target="#editmodal{{ $item->id }}">
                                                    input data
                                                </button>
                                            </div>
                                            <div>

                                            </div>
                                        </td>
                                    </tr>
                                    <div class="modal fade" id="editmodal{{ $item->id }}" aria-hidden="true"
                                        tabindex="-1">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header bg-warning text-white">
                                                    <h5 class="modal-title fw-bold"><i class="fas fa-edit"></i>input
                                                        data
                                                        sampah user</h5>
                                                    <button type="button" class="btn-close"
                                                        data-bs-dismiss="modal"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <label class="form-label">nama</label>
                                                    <input type="text" value="{{ $item->nama_user }}"
                                                        class="form-control" readonly>

                                                    <form id="formTabung{{ $item->id }}"
                                                        action="{{ route('tabung.store', $item->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        <label class="form-label">Jenis Sampah</label>
                                                        <div class="mb-2 d-flex">
                                                            <select name="select"
                                                                id="selectjenis{{ $item->id }}"
                                                                class="form-control me-2">
                                                                <option value="">-- Pilih Jenis Sampah --
                                                                </option>
                                                                @foreach ($jenismutasi as $jenis)
                                                                    <option value="{{ $jenis->id }}"
                                                                        dataharga="{{ $jenis->harga }}">
                                                                        {{ $jenis->nama_sampah }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                            <input type="number" name="bobot"
                                                                id="Jumlah{{ $item->id }}"
                                                                class="form-control me-2" placeholder="Bobot (kg)">
                                                            <input type="text" name="harga"
                                                                id="harga{{ $item->id }}"
                                                                class="form-control me-2"
                                                                placeholder="Total Harga (Rp)" readonly>
                                                            <button type="button" id="btnTambah{{ $item->id }}"
                                                                class="btn btn-primary">Tambah</button>
                                                        </div>

                                                        <div id="lisitem{{ $item->id }}"></div>

                                                        <button type="submit"
                                                            class="btn btn-success mt-2">Kirim</button>
                                                    </form>

                                                </div>
                                            </div>
                                        </div>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>

</main>

<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        function formatRupiah(amount) {
            return new Intl.NumberFormat('id-ID', {
                style: 'currency',
                currency: 'IDR',
                minimumFractionDigits: 0
            }).format(amount);
        }

        @foreach ($tabunginput as $item)
            (() => {
                const id = {{ $item->id }};
                const selectJenis = document.getElementById('selectjenis' + id);
                const inputJumlah = document.getElementById('Jumlah' + id);
                const inputHarga = document.getElementById('harga' + id);
                const btnTambah = document.getElementById('btnTambah' + id);
                const listItem = document.getElementById('lisitem' + id);
                const form = document.getElementById('formTabung' + id);

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

                    const isDuplicate = [...form.querySelectorAll(
                            'input[name$="[jenismutasi_id]"]')]
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
                        form.querySelectorAll(
                            `input[data-index="${preview.dataset.index}"]`).forEach(i =>
                            i.remove());
                        preview.remove();
                    });

                    listItem.appendChild(preview);
                    itemCounter++;

                    // Reset input
                    selectJenis.value = '';
                    inputJumlah.value = '';
                    inputHarga.value = '';
                });
            })();
        @endforeach
    });
</script>
<script>
  const bulanLabels = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];
    const totalBobotPerBulan = @json($finalBobotBulanan);

    new Chart(document.getElementById('pendapatanBulanChart'), {
        type: 'line',
        data: {
            labels: bulanLabels,
            datasets: [{
                label: 'Total Bobot (kg)',
                data: totalBobotPerBulan,
                borderColor: '#007bff',
                backgroundColor: 'rgba(0, 123, 255, 0.2)',
                borderWidth: 2,
                fill: true,
            }]
        },
        options: { responsive: true, maintainAspectRatio: false }
    });
    const jenisSampahLabels = @json(array_keys($pendapatanPerJenis));
    const pendapatanJenis = @json(array_values($pendapatanPerJenis));

    new Chart(document.getElementById('pendapatanJenisChart'), {
        type: 'bar',
        data: {
            labels: jenisSampahLabels,
            datasets: [{
                label: 'bobot',
                data: pendapatanJenis,
                backgroundColor: ['#ff6384', '#36a2eb', '#ffce56', '#4bc0c0', '#9966ff'],
                borderWidth: 1,
            }]
        },
        options: {
            indexAxis: 'y',
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                x: {
                    beginAtZero: true
                }
            }
        }
    });
</script>
@endsection
