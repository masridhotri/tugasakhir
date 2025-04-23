@extends('layouts.app')

@section('content')
<div class="table-responsive"style="height: 40rem; width: 100%;">
    <table id="example" class="table table-striped nowrap" style="width:100%; ">
        <thead>
            <tr>
                <th>No</th>
                <th>nama</th>
                <th>email</th>
                <th>alamat</th>
                <th>garis bujur</th>
                <th>garis lintang</th>
                <th>role</th>
                <th>aksi</th>

            </tr>
        </thead>
        <tbody>
            @foreach ($user as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->email }}</td>
                    <td>{{$item->alamat}} </td>
                    <td>{{$item->garis_bujur}} </td>
                    <td>{{$item->garis_lintang}} </td>                    
                    <td>{{$item->role}} </td>
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
                        
                        <div>
                            <form action="{{ route('dayli.toggleStatus', $item->id) }}" method="POST"
                                style="display:inline;">
                                @csrf
                                <button type="submit" id="toggle" class="btn btn-primary" data-user-id="{{ $item->id }}" onclick="return confirm('Yakin ingin mengubah status?')">
                                    {{ $item->role === 'user' ? 'Tandai sebagai admin' : 'Tandai sebagai user' }}
                                    </button>
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
                    <h1 class="modal-title fs-5" id="exampleModalLabel">tambah user baru</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" class="" action="#"
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
                            <label for="inputJudul" class="form-label">email</label>
                            <input type="number" name="email" value="{{ old('nama') }}"
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

<script>
    document.getElementById('toogle').addEventListener('click', function() {
        let userId = this.getAttribute('data-user-id');
        fetch(`/toggle-role/${userId}`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        })
        .then(response => response.json())
        .then(data => {
            alert(data.success);
            // Opsional: Perbarui tampilan berdasarkan status baru
            this.textContent = data.status == 1 ? 'Role: Admin' : 'Role: User';
        })
        .catch(error => console.error('Error:', error));
    });
    </script>
@endsection
