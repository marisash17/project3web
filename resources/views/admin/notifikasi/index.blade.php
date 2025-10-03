@extends('layouts.app')

@section('title', 'Kelola Notifikasi')

@section('content')
<style>
    .table-custom thead {
        background-color: #3120CD;
        color: white;
    }
    .btn-add {
        background-color: #3120CD;
        border: none;
        color: white;
    }
    .btn-add:hover {
        background-color: #1f149c;
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
    .btn-delete {
        background-color: #cc0000;
        color: white;
    }
</style>

<div class="container my-4">
    <div class="card p-4 shadow-sm">
        <div class="text-center mb-4">
            <i class="bi bi-bell-fill fs-1 text-primary"></i>
            <h3 class="fw-bold text-primary">Kelola Notifikasi</h3>
        </div>

        <div class="d-flex justify-content-between mb-3">
            <a href="{{ route('admin.notifikasi.create') }}" class="btn btn-add">
                <i class="bi bi-plus-circle"></i> Tambah Notifikasi
            </a>
            <form action="{{ route('admin.notifikasi.index') }}" method="GET" class="d-flex">
                <input type="text" name="search" value="{{ request('search') }}" 
                       class="form-control form-control-sm me-2" placeholder="Cari notifikasi...">
                <button class="btn btn-sm btn-outline-secondary">
                    <i class="bi bi-search"></i>
                </button>
            </form>
        </div>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table class="table table-bordered text-center table-custom">
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
                            <a href="{{ route('admin.notifikasi.edit', $notif->id) }}" class="btn btn-sm btn-edit">
                                <i class="bi bi-pencil-square"></i> Edit
                            </a>
                            <form action="{{ route('admin.notifikasi.destroy', $notif->id) }}" 
                                  method="POST" style="display:inline;" 
                                  onsubmit="return confirm('Yakin hapus notifikasi ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-delete">
                                    <i class="bi bi-trash"></i> Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="5">Belum ada notifikasi</td></tr>
                @endforelse
            </tbody>
        </table>

        <div class="mt-3">
            {{ $notifikasis->links() }}
        </div>
    </div>
</div>
@endsection
