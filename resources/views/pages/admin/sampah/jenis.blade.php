@extends('layouts.app')

@section('content')
    <div class="tabel">
        <div class="card-body">
            <div class="d-flex align-content-center justify-content-between mb-1">
                <h4 class="card-title mb-0"></h4>
                <div class="d-flex">
                    <!-- Button trigger modal -->
                    <a href="#tambah" class="btn btn-primary me-2" data-bs-toggle="modal" style="width: 10 rem;">
                        <i class="bi bi-plus-square"></i> Tambah
                    </a>
                    <a data-bs-toggle="collapse" href="#collapseImport" class="btn btn-info me-2">
                        <span data-feather="upload"></span> Impor
                    </a>
                    <a href="/buku-export" class="btn btn-secondary">
                        <span data-feather="download"></span> Export
                    </a>
                </div>
            </div>

            <div class="table-responsive"style="height: 40rem; width: 100%;">
                <table id="example" class="table table-striped nowrap" style="width:100%; ">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>nama</th>
                            <th>harga</th>
                            <th>foto </th>
                            <th>aksi</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($jenis as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->nama }}</td>
                                <td>{{ $item->harga }}</td>
                                <td>
                                    <div class="showfoto">
                                        <img src="{{ asset('file/' . $item->foto) }}" class="rounded" style="width: 50px">
                                    </div>
                                </td>
                                <td class="d-flex gap-2">
                                    <div class="edit">
                                        <button type="submit" class="btn btn-success text-light" data-bs-toggle="modal"
                                            data-bs-target="#edit{{ $item->id }}"><i
                                                class="bi bi-pencil-square"></i></button>
                                    </div>
                                    <div class="hapus">
                                        <form action="{{ route('jenis.destroy', $item->id) }}" method="post">
                                            @csrf
                                            <button type="submit" class="btn btn-danger text-light"><i
                                                    class="bi bi-trash"></i></button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <!-- Button trigger modal -->


                <!-- Modal -->
                <div class="modal fade" id="tambah" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form method="POST" class="" action="{{ route('jenis.tambah') }}"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="inputJudul" class="form-label">nama</label>
                                        <input type="text" name="nama" value="{{ old('nama') }}"
                                            class="form-control @error('judul') is-invalid @enderror" id="inputnama"
                                            aria-describedby="judulHelp">
                                        @error('judul')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="inputJudul" class="form-label">harga</label>
                                        <input type="number" name="harga" value="{{ old('nama') }}"
                                            class="form-control @error('judul') is-invalid @enderror"
                                            aria-describedby="judulHelp">
                                        @error('harga')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="inputJudul" class="form-label">foto</label>
                                        <input type="file" name="foto" value="{{ old('nama') }}"
                                            class="form-control @error('foto') is-invalid @enderror" id="inputnama"
                                            aria-describedby="judulHelp">
                                        @error('foto')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Save changes</button>
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        @foreach ($jenis as $js)
            <div class="modal fade" id="edit{{ $js->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form method="POST" class="" action="{{ route('jenis.edit', $js->id) }}"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3">
                                    <label for="inputJudul" class="form-label">nama</label>
                                    <input type="text" name="nama" value="{{ $js->nama }}"
                                        class="form-control @error('judul') is-invalid @enderror" id="inputnama"
                                        aria-describedby="judulHelp">
                                    @error('judul')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="inputJudul" class="form-label">harga</label>
                                    <input type="number" name="harga" value="{{ number_format($js->harga, 0, ',', '.') }}}"
                                        class="form-control @error('judul') is-invalid @enderror" id="inputharga"
                                        aria-describedby="judulHelp">
                                    @error('harga')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="inputJudul" class="form-label">foto</label>
                                    <input type="file" name="foto" value="{{ $js->foto }}"
                                        class="form-control @error('foto') is-invalid @enderror" id="inputnama"
                                        aria-describedby="judulHelp">
                                    @error('foto')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Save changes</button>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        @endforeach







        <script>
            document.addEventListener("DOMContentLoaded", function () {
                const inputHarga = document.getElementById("inputharga");
        
                inputHarga.addEventListener("input", function (e) {
                    let value = e.target.value.replace(/\D/g, ""); // Hanya ambil angka
                    let formattedValue = new Intl.NumberFormat("id-ID", {
                        style: "currency",
                        currency: "IDR",
                        minimumFractionDigits: 0
                    }).format(value);
        
                    e.target.value = value ? formattedValue.replace("Rp", "").trim() : ""; // Tampilkan tanpa "Rp"
                });
            });
        </script>
        
    @endsection
