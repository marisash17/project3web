@extends('layouts.app')

@section('title', 'Kelola Layanan')

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

    .btn-secondary {
        background-color: white;
        color: #3120CD;
        border: 1px solid #3120CD;
        transition: 0.25s ease;
    }

    .btn-secondary:hover,
    .btn-secondary:active,
    .btn-secondary:focus {
        background-color: #3120CD;
        color: white;
        border: 1px solid #3120CD;
    }

    /* Atur jarak konten dari sidebar */
.container {
    margin-left: 330px; /* kasih jarak biar ga mepet ke sidebar */
    max-width: calc(100% - 350px); /* biar kontennya tetep proporsional */
}

/* Biar halaman tetap keliatan clean */
body {
    background-color: #F5F5F5;
}

/* Responsif untuk layar kecil */
@media (max-width: 992px) {
    .container {
        margin-left: 0;
        max-width: 100%;
        padding: 20px;
    }
}


</style>

<div class="container my-4">
    <div class="card-custom">

        <!-- 🔙 Tombol Back ke Dashboard -->
        <div class="mb-3">
            <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">
                <i class="bi bi-arrow-left"></i>
            </a>
        </div>

        <!-- Judul di tengah dengan ikon -->
        <div class="text-center mb-4">
            <i class="bi bi-gear-fill fs-1 d-block text-custom-blue"></i>
            <h3 class="fw-bold text-custom-blue">Data Layanan</h3>
        </div>
        
        <!-- Tombol tambah & search -->
        <div class="d-flex justify-content-between align-items-center mb-3">
            <a href="{{ route('admin.layanan.create') }}" class="btn btn-sm btn-add">
                <i class="bi bi-plus-circle"></i> Tambah Layanan
            </a>
            <form action="{{ route('admin.layanan.index') }}" method="GET" class="d-flex">
                <input type="text" name="search" value="{{ request('search') }}" 
                       class="form-control form-control-sm me-2" placeholder="Cari...">
                <button class="btn btn-sm btn-outline-secondary">
                    <i class="bi bi-search"></i>
                </button>
            </form>
        </div>
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <!-- Tabel -->
        <table class="table-custom">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Jenis Layanan</th>
                    <th>Gambar</th>
                    <th>Deskripsi</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($layanans as $index => $layanan)
                    <tr>
                        <td>{{ ($layanans->currentPage() - 1) * $layanans->perPage() + $loop->iteration }}</td>
                        <td>{{ $layanan->jenis_layanan }}</td>
                        <td>
                            @if($layanan->gambar)
                                <img src="{{ asset('storage/' . $layanan->gambar) }}" width="80">
                            @else
                                -
                            @endif
                        </td>
                        <td>{{ $layanan->deskripsi }}</td>
                        <td>
                            <div class="d-flex justify-content-center gap-2">
                                <a href="{{ route('admin.layanan.edit', $layanan->id) }}" 
                                   class="btn btn-sm btn-edit">
                                    <i class="bi bi-pencil-square"></i> Edit
                                </a>
                                <form action="{{ route('admin.layanan.destroy', $layanan->id) }}" 
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
                        <td colspan="5">Tidak ada layanan</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <!-- Pagination -->
        <div class="mt-3">
            {{ $layanans->links() }}
        </div>
    </div>
</div>
@endsection
