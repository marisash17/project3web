@extends('layouts.app')

@section('title', 'Kelola Teknisi')

@section('content')
<style>
    :root {
        --primary: #3120CD;
        --primary-light: #4430E7;
        --primary-dark: #2B1FC0;
        --gradient: linear-gradient(135deg, #2B1FC0 0%, #4430E7 50%, #5A46FF 100%);
        --card-shadow: 0 8px 32px rgba(49, 32, 205, 0.15);
    }

    .teknisi-container {
        min-height: 100vh;
        padding: 40px 20px;
        display: flex;
        justify-content: center;
        align-items: flex-start;
        background: #f8f9ff;
    }

    .glass-card {
        background: linear-gradient(135deg, rgba(255,255,255,0.97) 0%, rgba(255,255,255,0.92) 100%);
        backdrop-filter: blur(18px);
        border-radius: 20px;
        padding: 30px 40px;
        box-shadow: var(--card-shadow);
        border: 1px solid rgba(255,255,255,0.6);
        width: 98%;
        max-width: 1650px;
        transition: all 0.3s ease;
        animation: fadeInUp 0.6s ease-out;
    }

    .page-header { text-align: center; margin-bottom: 25px; }
    .page-icon {
        width: 80px; height: 80px; border-radius: 20px;
        background: var(--gradient);
        display: flex; align-items: center; justify-content: center;
        color: white; font-size: 32px; margin: 0 auto 15px;
        box-shadow: 0 6px 20px rgba(49, 32, 205, 0.3);
    }
    .page-title {
        font-weight: 700; font-size: 30px;
        background: linear-gradient(135deg, var(--primary-dark) 0%, var(--primary-light) 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }
    .top-bar { display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; margin-bottom: 25px; gap: 10px; }
    .back-btn {
        background: var(--gradient); color: white; border: none; padding: 12px 20px; border-radius: 12px;
        font-weight: 500; text-decoration: none; display: inline-flex; align-items: center; gap: 8px;
        transition: all 0.3s ease; box-shadow: 0 4px 15px rgba(49, 32, 205, 0.2);
    }
    .back-btn:hover { transform: translateY(-2px); box-shadow: 0 6px 20px rgba(49, 32, 205, 0.3); color: white; }
    .search-form { display: flex; gap: 10px; align-items: center; max-width: 350px; width: 100%; justify-content: flex-end; }
    .search-input {
        background: rgba(255, 255, 255, 0.9); border: 1px solid rgba(49, 32, 205, 0.2); border-radius: 12px;
        padding: 12px 16px; font-size: 14px; width: 100%; transition: all 0.3s ease;
    }
    .search-input:focus { outline: none; border-color: var(--primary); box-shadow: 0 0 0 3px rgba(49, 32, 205, 0.1); }
    .search-btn { background: var(--gradient); color: white; border: none; padding: 12px 16px; border-radius: 12px; transition: all 0.3s ease; box-shadow: 0 4px 15px rgba(49, 32, 205, 0.2); }
    .table-container { background: rgba(255, 255, 255, 0.9); border-radius: 16px; overflow: hidden; box-shadow: 0 4px 20px rgba(0,0,0,0.05); }
    .custom-table { width: 100%; border-collapse: collapse; table-layout: fixed; font-size: 14px; }
    .custom-table thead { background: var(--gradient); color: white; }
    .custom-table th { padding: 14px 12px; font-weight: 600; text-transform: uppercase; text-align: center; }
    .custom-table td { padding: 12px 12px; border-bottom: 1px solid #eee; text-align: center; vertical-align: middle; }
    .action-buttons { display: flex; justify-content: center; gap: 10px; }
    .btn-edit {
        background: var(--primary); color: white; border: none; padding: 8px 12px; border-radius: 8px;
        font-size: 12px; font-weight: 500; display: flex; align-items: center; gap: 4px; text-decoration: none;
    }
    .btn-delete { background: #dc3545; color: white; border: none; padding: 8px 12px; border-radius: 8px; font-size: 12px; }
</style>

<div class="teknisi-container">
    <div class="glass-card">

        <div class="top-bar">
            <a href="{{ route('admin.dashboard') }}" class="back-btn">
                <i class="bi bi-arrow-left"></i> Kembali ke Dashboard
            </a>

            <form action="{{ route('admin.teknisi.index') }}" method="GET" class="search-form">
                <input type="text" name="search" class="search-input" placeholder="Cari teknisi..." value="{{ request('search') }}">
                <button type="submit" class="search-btn"><i class="bi bi-search"></i></button>
            </form>
        </div>

        <div class="page-header">
            <div class="page-icon">
                <i class="bi bi-person-gear"></i>
            </div>
            <h1 class="page-title">Data Teknisi</h1>
        </div>

        <div class="table-container">
            <table class="custom-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Alamat</th>
                        <th>No HP</th>
                        <th>Keahlian</th>
                        <th>Pengalaman</th>
                        <th>Sertifikat</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($teknisi as $t)
                        <tr>
                            <td>{{ ($teknisi->currentPage() - 1) * $teknisi->perPage() + $loop->iteration }}</td>
                            <td>{{ $t->user->name ?? '-' }}</td>
                            <td>{{ $t->user->alamat ?? '-' }}</td>
                            <td>{{ $t->user->no_hp ?? '-' }}</td>
                            <td>{{ $t->keahlian }}</td>
                            <td>{{ $t->pengalaman }}</td>
                            <td>
                                @if($t->sertifikat)
                                    <a href="{{ asset('storage/'.$t->sertifikat) }}" target="_blank">Lihat</a>
                                @else
                                    -
                                @endif
                            </td>
                            <td>
                                <div class="action-buttons">
                                    <a href="{{ route('admin.teknisi.show', $t->id) }}" class="btn-edit">
                                        <i class="bi bi-eye"></i> Lihat
                                    </a>

                                    <form action="{{ route('admin.teknisi.destroy', $t->id) }}" onsubmit="return confirm('Yakin mau hapus?')" method="POST">
                                        @csrf @method('DELETE')
                                        <button class="btn-delete"><i class="bi bi-trash"></i> Hapus</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center py-4 text-muted">Tidak ada data</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if ($teknisi->hasPages())
            <div class="pagination-container mt-3">
                {{ $teknisi->links() }}
            </div>
        @endif
    </div>
</div>

@endsection
