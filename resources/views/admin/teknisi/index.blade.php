@extends('layouts.app')

@section('title', 'Kelola Teknisi')

@section('content')
<style>
    .table-purple thead {
        background-color: #3120CD;
        color: white;
    }
    .btn-add {
        background-color: #3120CD;
        border: none;
        color: white !important;
    }
    .btn-add:hover {
        background-color: #3120CD;
        color: white !important;
    }

    .btn-edit, .btn-delete {
        font-size: 0.8rem;
        padding: 4px 10px;
        border-radius: 6px;
        display: inline-flex;
        align-items: center;
        gap: 4px;
    }
    .btn-edit {
        background-color: #3120CD;
        color: white;
    }
    .btn-edit:hover {
        background-color: #3120CD;
    }
    .btn-delete {
        background-color: #cc0000;
        color: white;
    }
    .btn-delete:hover {
        background-color: #990000;
    }

    .card-custom {
        background: white;
        padding: 50px;
        border-radius: 10px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.15);
    }
    .text-custom-blue {
        color: #3120CD !important;
    }
    .table-custom {
        border: 1px solid #000;
        border-collapse: collapse;
        width: 100%;
        text-align: center;
    }

    .table-custom thead {
        background-color: #CFCCE3; 
    }

    .table-custom th, .table-custom td {
        border: 1px solid #000;
        padding: 8px;
        vertical-align: middle;
    }
    body {
        background-color: #F5F5F5;
    }
</style>

<div class="container my-4">
    <div class="card-custom">
        <!-- Judul -->
        <div class="text-center mb-4">
            <i class="bi bi-person-gear fs-1 d-block text-custom-blue"></i>
            <h3 class="fw-bold text-custom-blue">Data Teknisi</h3>
        </div>

        <!-- search -->
            <form action="{{ route('admin.teknisi.index') }}" method="GET" class="d-flex">
                <input type="text" name="search" value="{{ request('search') }}" 
                       class="form-control form-control-sm me-2" placeholder="Cari teknisi...">
                <button class="btn btn-sm btn-outline-secondary">
                    <i class="bi bi-search"></i>
                </button>
            </form>
        </div>

        <!-- Notifikasi -->
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <!-- Tabel -->
        <table class="table-custom">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Teknisi</th>
                    <th>Alamat</th>
                    <th>No. Handphone</th>
                    <th>Jenis Kelamin</th>
                    <th>Keahlian</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($teknisi as $index => $t)
                    <tr>
                        <td>{{ ($teknisi->currentPage() - 1) * $teknisi->perPage() + $loop->iteration }}</td>
                        <td>{{ $t->nama }}</td>
                        <td>{{ $t->alamat }}</td>
                        <td>{{ $t->no_telepon }}</td>
                        <td>{{ $t->jenis_kelamin }}</td>
                        <td>{{ $t->keahlian }}</td>
                        <td>
                            <div class="d-flex justify-content-center gap-2">
                                <a href="{{ route('admin.teknisi.edit', $t->id) }}" 
                                   class="btn btn-sm btn-edit">
                                    <i class="bi bi-pencil-square"></i> Edit
                                </a>
                                <form action="{{ route('admin.teknisi.destroy', $t->id) }}" 
                                      method="POST" onsubmit="return confirm('Yakin mau hapus?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-delete">
                                        <i class="bi bi-trash"></i> Hapus
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7">Tidak ada data</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <!-- Pagination -->
        <div class="mt-3">
            {{ $teknisi->links() }}
        </div>
    </div>
</div>
@endsection
