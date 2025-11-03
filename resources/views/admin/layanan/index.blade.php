@extends('layouts.app')

@section('title', 'Kelola Layanan')

@section('content')
<style>
    :root {
        --primary: #3120CD;
        --primary-light: #4430E7;
        --primary-dark: #2B1FC0;
        --gradient: linear-gradient(135deg, #2B1FC0 0%, #4430E7 50%, #5A46FF 100%);
        --card-shadow: 0 8px 32px rgba(49, 32, 205, 0.15);
    }

    .layanan-container {
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

    .page-header {
        text-align: center;
        margin-bottom: 25px;
    }

    .page-icon {
        width: 80px;
        height: 80px;
        border-radius: 20px;
        background: var(--gradient);
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 32px;
        margin: 0 auto 15px;
        box-shadow: 0 6px 20px rgba(49, 32, 205, 0.3);
    }

    .page-title {
        font-weight: 700;
        font-size: 30px;
        background: linear-gradient(135deg, var(--primary-dark) 0%, var(--primary-light) 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    .top-bar {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        margin-bottom: 25px;
        gap: 10px;
    }

    .back-btn {
        background: var(--gradient);
        color: white;
        border: none;
        padding: 12px 20px;
        border-radius: 12px;
        font-weight: 500;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(49, 32, 205, 0.2);
    }

    .back-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(49, 32, 205, 0.3);
        color: white;
    }

    .search-form {
        display: flex;
        gap: 10px;
        align-items: center;
        max-width: 350px;
        width: 100%;
        justify-content: flex-end;
    }

    .search-input {
        background: rgba(255, 255, 255, 0.9);
        border: 1px solid rgba(49, 32, 205, 0.2);
        border-radius: 12px;
        padding: 12px 16px;
        font-size: 14px;
        width: 100%;
        transition: all 0.3s ease;
    }

    .search-input:focus {
        outline: none;
        border-color: var(--primary);
        box-shadow: 0 0 0 3px rgba(49, 32, 205, 0.1);
    }

    .search-btn {
        background: var(--gradient);
        color: white;
        border: none;
        padding: 12px 16px;
        border-radius: 12px;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(49, 32, 205, 0.2);
    }

    .search-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(49, 32, 205, 0.3);
    }

    /* ====== Action Bar di Atas Tabel ====== */
    .action-bar {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
        padding: 0 10px;
    }

    .btn-add {
        background: var(--gradient);
        color: white;
        border: none;
        padding: 12px 20px;
        border-radius: 12px;
        font-weight: 500;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(49, 32, 205, 0.2);
    }

    .btn-add:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(49, 32, 205, 0.3);
        color: white;
    }

    /* ====== Tabel ====== */
    .table-container {
        background: rgba(255, 255, 255, 0.9);
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
    }

    .custom-table {
        width: 100%;
        border-collapse: collapse;
        table-layout: fixed;
        font-size: 14px;
    }

    .custom-table thead {
        background: var(--gradient);
        color: white;
    }

    .custom-table th {
        padding: 14px 12px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.3px;
        text-align: center;
    }

    .custom-table td {
        padding: 12px 12px;
        border-bottom: 1px solid #eee;
        text-align: center;
        vertical-align: middle;
        word-break: break-word;
    }

    /* Tentukan lebar kolom untuk Layanan */
    .custom-table th:nth-child(1),
    .custom-table td:nth-child(1) { width: 60px; } /* No */

    .custom-table th:nth-child(2),
    .custom-table td:nth-child(2) { width: 200px; } /* Jenis Layanan */

    .custom-table th:nth-child(3),
    .custom-table td:nth-child(3) { width: 150px; } /* Gambar */

    .custom-table th:nth-child(4),
    .custom-table td:nth-child(4) { width: 400px; } /* Deskripsi */

    .custom-table th:nth-child(5),
    .custom-table td:nth-child(5) { width: 180px; } /* Aksi */

    .custom-table tbody tr:nth-child(even) { background: #f9f9ff; }
    .custom-table tbody tr:nth-child(odd) { background: #ffffff; }

    .custom-table tbody tr:hover {
        background: rgba(49, 32, 205, 0.06);
        transition: 0.3s;
    }

    /* Gambar Styles */
    .gambar-layanan {
        width: 80px;
        height: 80px;
        object-fit: cover;
        border-radius: 8px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    }

    .no-image {
        color: #999;
        font-style: italic;
    }

    /* Deskripsi Styles */
    .deskripsi-text {
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
        text-overflow: ellipsis;
        line-height: 1.4;
        max-height: 4.2em;
    }

    .action-buttons {
        display: flex;
        justify-content: center;
        gap: 10px;
    }

    .btn-edit, .btn-delete {
        border: none;
        padding: 8px 12px;
        border-radius: 8px;
        font-size: 12px;
        font-weight: 500;
        display: inline-flex;
        align-items: center;
        gap: 4px;
        transition: all 0.3s ease;
        text-decoration: none;
        white-space: nowrap;
    }

    .btn-edit {
        background: var(--primary);
        color: white;
    }

    .btn-edit:hover {
        background: var(--primary-dark);
    }

    .btn-delete {
        background: #dc3545;
        color: white;
    }

    .btn-delete:hover {
        background: #c82333;
    }

    /* Alert Success */
    .alert-success {
        background: linear-gradient(135deg, #d4edda 0%, #c3e6cb 100%);
        border: 1px solid rgba(40, 167, 69, 0.2);
        border-radius: 12px;
        color: #155724;
        padding: 16px 20px;
        margin-bottom: 25px;
        box-shadow: 0 4px 15px rgba(40, 167, 69, 0.1);
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .pagination-container {
        display: flex;
        justify-content: center;
        margin-top: 20px;
    }

    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(30px); }
        to { opacity: 1; transform: translateY(0); }
    }

    /* Responsive */
    @media (max-width: 768px) {
        .top-bar {
            flex-direction: column;
            align-items: stretch;
        }
        
        .search-form {
            max-width: 100%;
            justify-content: stretch;
        }
        
        .action-bar {
            flex-direction: column;
            gap: 15px;
            align-items: stretch;
        }
        
        .custom-table {
            table-layout: auto;
        }
        
        .custom-table th:nth-child(1),
        .custom-table td:nth-child(1),
        .custom-table th:nth-child(2),
        .custom-table td:nth-child(2),
        .custom-table th:nth-child(3),
        .custom-table td:nth-child(3),
        .custom-table th:nth-child(4),
        .custom-table td:nth-child(4),
        .custom-table th:nth-child(5),
        .custom-table td:nth-child(5) {
            width: auto;
        }
        
        .gambar-layanan {
            width: 60px;
            height: 60px;
        }
        
        .action-buttons {
            flex-direction: column;
            gap: 5px;
        }
        
        .btn-edit,
        .btn-delete {
            padding: 6px 10px;
            font-size: 11px;
        }
    }
</style>

<div class="layanan-container">
    <div class="glass-card">
        <div class="top-bar">
            <a href="{{ route('admin.dashboard') }}" class="back-btn">
                <i class="bi bi-arrow-left"></i> Kembali ke Dashboard
            </a>

            <form action="{{ route('admin.layanan.index') }}" method="GET" class="search-form">
                <input type="text" name="search" value="{{ request('search') }}"
                       class="search-input" placeholder="Cari layanan...">
                <button type="submit" class="search-btn">
                    <i class="bi bi-search"></i>
                </button>
            </form>
        </div>

        <div class="page-header">
            <div class="page-icon">
                <i class="bi bi-gear-fill"></i>
            </div>
            <h1 class="page-title">Data Layanan</h1>
        </div>

        <!-- Success Message -->
        @if(session('success'))
            <div class="alert alert-success">
                <i class="bi bi-check-circle-fill"></i>
                {{ session('success') }}
            </div>
        @endif

        <!-- Action Bar dengan Tombol Tambah di Atas Tabel -->
        <div class="action-bar">
            <a href="{{ route('admin.layanan.create') }}" class="btn-add">
                <i class="bi bi-plus-circle"></i> Tambah Layanan
            </a>
        </div>

        <div class="table-container">
            <table class="custom-table">
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
                                    <img src="{{ asset('storage/' . $layanan->gambar) }}" 
                                         alt="{{ $layanan->jenis_layanan }}" 
                                         class="gambar-layanan">
                                @else
                                    <span class="no-image">-</span>
                                @endif
                            </td>
                            <td>
                                <div class="deskripsi-text">{{ $layanan->deskripsi }}</div>
                            </td>
                            <td>
                                <div class="action-buttons">
                                    <a href="{{ route('admin.layanan.edit', $layanan->id) }}" class="btn-edit">
                                        <i class="bi bi-pencil-square"></i> Edit
                                    </a>
                                    <form action="{{ route('admin.layanan.destroy', $layanan->id) }}" method="POST"
                                          onsubmit="return confirm('Yakin mau hapus?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-delete">
                                            <i class="bi bi-trash"></i> Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-4 text-muted">Tidak ada layanan</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($layanans->hasPages())
            <div class="pagination-container">
                {{ $layanans->links() }}
            </div>
        @endif
    </div>
</div>

<script>
    // Add interactive effects
    document.addEventListener('DOMContentLoaded', function() {
        const tableRows = document.querySelectorAll('.custom-table tbody tr');
        
        tableRows.forEach(row => {
            row.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-1px)';
            });
            
            row.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(0)';
            });
        });

        // Add focus effect to search input
        const searchInput = document.querySelector('.search-input');
        searchInput.addEventListener('focus', function() {
            this.style.transform = 'translateY(-1px)';
            this.style.boxShadow = '0 4px 15px rgba(49, 32, 205, 0.1)';
        });

        searchInput.addEventListener('blur', function() {
            this.style.transform = 'translateY(0)';
            this.style.boxShadow = 'none';
        });
    });
</script>
@endsection