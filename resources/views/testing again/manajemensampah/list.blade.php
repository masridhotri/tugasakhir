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
                            <th>Foto</th>
                            <th>ID</th>
                            <th>Nama Jenis Sampah</th>
                            <th>Deskripsi</th>
                            <th>Satuan</th>
                            <th>Harga Jual</th>
                            <th>Harga Beli</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        @php
                        $dataSampah = [
                            ['id' => 'JS001', 'nama' => 'Plastik', 'deskripsi' => 'Botol & kantong plastik.', 'satuan' => 'Kg', 'harga_jual' => 2000, 'harga_beli' => 5000, 'foto' => 'https://via.placeholder.com/50'],
                            ['id' => 'JS002', 'nama' => 'Organik', 'deskripsi' => 'Sampah organik seperti daun.', 'satuan' => 'Kg', 'harga_jual' => 1500, 'harga_beli' => 4500, 'foto' => 'https://via.placeholder.com/50'],
                            ['id' => 'JS003', 'nama' => 'Logam', 'deskripsi' => 'Kaleng & besi bekas.', 'satuan' => 'Kg', 'harga_jual' => 3000, 'harga_beli' => 7000, 'foto' => 'https://via.placeholder.com/50'],
                            ['id' => 'JS004', 'nama' => 'Kertas', 'deskripsi' => 'Koran & kardus.', 'satuan' => 'Kg', 'harga_jual' => 1000, 'harga_beli' => 3000, 'foto' => 'https://via.placeholder.com/50']
                        ];
                        @endphp

                        @foreach ($dataSampah as $index => $sampah)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>
                                <img src="{{ $sampah['foto'] }}" class="rounded shadow-sm border" width="50" alt="Foto Sampah">
                            </td>
                            <td><span class="badge bg-primary">{{ $sampah['id'] }}</span></td>
                            <td class="fw-bold">{{ $sampah['nama'] }}</td>
                            <td>{{ $sampah['deskripsi'] }}</td>
                            <td><span class="badge bg-secondary">{{ $sampah['satuan'] }}</span></td>
                            <td class="text-success fw-bold">Rp {{ number_format($sampah['harga_jual'], 0, ',', '.') }}</td>
                            <td class="text-danger fw-bold">Rp {{ number_format($sampah['harga_beli'], 0, ',', '.') }}</td>
                            <td>
                                <div class="d-flex gap-2 justify-content-center">
                                    <button class="btn btn-warning btn-sm shadow-sm" data-bs-toggle="modal" data-bs-target="#editModal{{ $sampah['id'] }}">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="btn btn-danger btn-sm shadow-sm" onclick="confirmDelete('{{ $sampah['id'] }}')">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>

                        <!-- Modal Edit Data -->
                        <div class="modal fade" id="editModal{{ $sampah['id'] }}" tabindex="-1">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header bg-warning text-white">
                                        <h5 class="modal-title fw-bold"><i class="fas fa-edit"></i> Edit Jenis Sampah</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form>
                                            <div class="mb-3 text-center">
                                                <img src="{{ $sampah['foto'] }}" class="img-thumbnail mb-2 rounded shadow-sm" width="100" alt="Foto Sampah">
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Upload Foto Baru</label>
                                                <input type="file" class="form-control">
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Nama Jenis Sampah</label>
                                                <input type="text" class="form-control" value="{{ $sampah['nama'] }}" required>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Deskripsi</label>
                                                <textarea class="form-control" required>{{ $sampah['deskripsi'] }}</textarea>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Satuan</label>
                                                <input type="text" class="form-control" value="{{ $sampah['satuan'] }}" required>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Harga Jual</label>
                                                <input type="number" class="form-control" value="{{ $sampah['harga_jual'] }}" required>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Harga Beli</label>
                                                <input type="number" class="form-control" value="{{ $sampah['harga_beli'] }}" required>
                                            </div>
                                            <button type="button" class="btn btn-primary w-100 shadow-sm">Simpan Perubahan</button>
                                        </form>
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
                <form>
                    <div class="mb-3">
                        <label class="form-label">Nama Jenis Sampah</label>
                        <input type="text" class="form-control" required>
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
</script>
@endsection
