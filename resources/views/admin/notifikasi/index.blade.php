@extends('layouts.app')

@section('title', 'Kelola Notifikasi')

@section('content')
<style>
    .card-custom {
        background: white;
        padding: 30px 40px;
        border-radius: 8px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.15);
    }
    .text-custom-blue {
        color: #3120CD !important;
    }
    .btn-add {
        background-color: #3120CD;
        border: none;
        color: white;
        font-weight: bold;
        padding: 8px 16px;
        border-radius: 5px;
    }
    .btn-add:hover {
        background-color: #201090;
        color: white;
    }
    .btn-edit, .btn-delete {
        font-size: 0.8rem;
        padding: 4px 10px;
        border-radius: 6px;
    }
    .btn-edit {
        background-color: #3120CD;
        color: white;
    }
    .btn-edit:hover {
        background-color: #201090;
        color: white;
    }
    .btn-delete {
        background-color: #cc0000;
        color: white;
    }
    .btn-delete:hover {
        background-color: #990000;
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
    .search-form {
        display: flex;
        align-items: center;
        gap: 8px;
        max-width: 250px;
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

        <!-- Judul -->
        <div class="text-center mb-4">
            <i class="bi bi-bell-fill fs-1 d-block text-custom-blue"></i>
            <h3 class="fw-bold text-custom-blue">Kelola Notifikasi</h3>
        </div>

        <!-- Tombol tambah + pencarian -->
        <div class="d-flex justify-content-between align-items-center mb-3">
            <a href="{{ route('admin.notifikasi.create') }}" class="btn btn-add">
                <i class="bi bi-plus-circle"></i> Tambah Notifikasi
            </a>
            <form action="{{ route('admin.notifikasi.index') }}" method="GET" class="search-form">
                <input type="text" name="search" value="{{ request('search') }}" 
                       class="form-control form-control-sm" placeholder="Cari notifikasi...">
                <button class="btn btn-sm btn-outline-secondary">
                    <i class="bi bi-search"></i>
                </button>
            </form>
        </div>

        <!-- Notifikasi sukses -->
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <!-- Tabel notifikasi -->
        <table class="table-custom">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Judul</th>
                    <th>Pesan</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($notifikasis as $index => $notif)
                    <tr>
                        <td>{{ ($notifikasis->currentPage()-1)*$notifikasis->perPage()+$loop->iteration }}</td>
                        <td>{{ $notif->judul }}</td>
                        <td>{{ $notif->pesan }}</td>
                        <td>
                            <span class="badge {{ $notif->status == 'Belum Dibaca' ? 'bg-warning text-dark' : 'bg-success' }}">
                                {{ $notif->status }}
                            </span>
                        </td>
                        <td>
                            <div class="d-flex justify-content-center gap-2">
                                <a href="{{ route('admin.notifikasi.edit', $notif->id) }}" class="btn btn-sm btn-edit">
                                    <i class="bi bi-pencil-square"></i> Edit
                                </a>
                                <form action="{{ route('admin.notifikasi.destroy', $notif->id) }}" 
                                      method="POST" onsubmit="return confirm('Yakin hapus notifikasi ini?')">
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
                    <tr><td colspan="5">Belum ada notifikasi</td></tr>
                @endforelse
            </tbody>
        </table>

        <!-- Pagination -->
        <div class="mt-3">
            {{ $notifikasis->links() }}
        </div>
    </div>
</div>
@endsection
