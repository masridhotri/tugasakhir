@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <!-- Header -->
        <div class="d-flex justify-content-between align-items-center mb-4 p-3 bg-light shadow-sm rounded">
            <h3 class="fw-bold text-success"><i class="fas fa-recycle"></i> Manajemen Jenis Sampah</h3>
            <button class="btn btn-success btn-sm shadow-sm" data-bs-toggle="modal" data-bs-target="#modalTambah">
                <i class="fas fa-plus"></i> Tambah Data
            </button>
        </div>

        <!-- Card Tabel -->
        <div class="card border-0 shadow-sm rounded">
            <div class="card-header bg-success text-white fw-bold">
                <i class="fas fa-trash-alt"></i> Daftar Jenis Sampah
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover table-striped align-middle">
                        <thead class="bg-dark text-white text-center">
                            <tr>
                                <th>No</th>
                                <th>foto</th>
                                <th>Nama Jenis Sampah</th>
                                <th>harga</th>
                                <th>deskripsi</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="text-center">

                            @foreach ($jenis as $index)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td><img src="{{ asset("file/$index->foto") }}" alt="" width="100"></td>
                                    <td>{{ $index->nama_sampah }}</td>
                                    <td>{{ $index->harga }}</td>
                                    <td>{{ $index->deskripsi }}</td>

                                    <td>
                                        <div class="d-flex gap-2 justify-content-center">
                                            <button class="btn btn-warning btn-sm shadow-sm" data-bs-toggle="modal"
                                                data-bs-target="#editModal{{ $index->id }}">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <form action="{{ route('jenis.destroy', $index->id) }}"method="POST"
                                                enctype="multipart/form-data">
                                                @csrf
                                                <button class="btn btn-danger btn-sm shadow-sm" type="submit">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>

                                <!-- Modal Edit Data -->
                                <div class="modal fade" id="editModal{{ $index->id }}" tabindex="-1">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header bg-warning text-white">
                                                <h5 class="modal-title fw-bold"><i class="fas fa-edit"></i> Edit Jenis
                                                    Sampah</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>
                                            <div class="modal-body">
                                                {{-- <form>
                                            <div class="mb-3 text-center">
                                                <img src="{{ $index['foto'] }}" class="img-thumbnail mb-2 rounded shadow-sm" width="100" alt="Foto Sampah">
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Upload Foto Baru</label>
                                                <input type="file" class="form-control">
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Nama Jenis Sampah</label>
                                                <input type="text" class="form-control" value="{{ $index['nama'] }}" required>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Deskripsi</label>
                                                <textarea class="form-control" required>{{ $index['deskripsi'] }}</textarea>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Satuan</label>
                                                <input type="text" class="form-control" value="{{ $index['satuan'] }}" required>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Harga Jual</label>
                                                <input type="number" class="form-control" value="{{ $index['harga_jual'] }}" required>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Harga Beli</label>
                                                <input type="number" class="form-control" value="{{ $index['harga_beli'] }}" required>
                                            </div>
                                            <button type="button" class="btn btn-primary w-100 shadow-sm">Simpan Perubahan</button>
                                        </form> --}}
                                            </div>
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

    <!-- Modal Tambah Data -->
    <div class="modal fade" id="modalTambah" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title fw-bold"><i class="fas fa-plus"></i> Tambah Jenis Sampah</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('jenis.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Nama Jenis Sampah</label>
                            <input type="text" name="nama_sampah" class="form-control" required>
                            <label class="form-label">harga</label>
                            <input type="text" id="harga" name="harga" class="form-control" required>
                            <label class="form-label">foto</label>
                            <input type="file" name="foto" class="form-control" required>
                            <label class="form-label">deskripsi</label>
                            <input type="text" name="deskripsi" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-success w-100 shadow-sm">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Script Konfirmasi Hapus -->
    <script>
        function confirmDelete(id) {
            if (confirm("Apakah Anda yakin ingin menghapus data ini?")) {
                alert("Data dengan ID " + id + " telah dihapus (simulasi).");
            }
        }
            const hargaInput = document.getElementById('harga');

            hargaInput.addEventListener('input', function(e) {
                let value = hargaInput.value;

                // Hapus semua karakter non-digit
                value = value.replace(/[^\d]/g, '');

                // Konversi ke angka lalu format
                const angka = parseInt(value);
                if (!isNaN(angka)) {
                    hargaInput.value = angka.toLocaleString('id-ID');
                } else {
                    hargaInput.value = '';
                }
            });
    </script>
@endsection
