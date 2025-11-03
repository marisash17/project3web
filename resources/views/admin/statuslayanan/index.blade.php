@extends('layouts.app')

@section('title', 'Daftar Status Layanan')

@section('content')
<style>
    :root {
        --primary: #3120CD;
        --primary-light: #4430E7;
        --primary-dark: #2B1FC0;
        --gradient: linear-gradient(135deg, #2B1FC0 0%, #4430E7 50%, #5A46FF 100%);
        --card-shadow: 0 8px 32px rgba(49, 32, 205, 0.15);
    }

    .pemesanan-container {
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

    /* Tentukan lebar kolom */
    .custom-table th:nth-child(1),
    .custom-table td:nth-child(1) { width: 60px; }

    .custom-table th:nth-child(2),
    .custom-table td:nth-child(2) { width: 180px; }

    .custom-table th:nth-child(3),
    .custom-table td:nth-child(3) { width: 150px; }

    .custom-table th:nth-child(4),
    .custom-table td:nth-child(4) { width: 140px; }

    .custom-table th:nth-child(5),
    .custom-table td:nth-child(5) { width: 120px; }

    .custom-table th:nth-child(6),
    .custom-table td:nth-child(6) { width: 120px; }

    .custom-table th:nth-child(7),
    .custom-table td:nth-child(7) { width: 150px; }

    .custom-table th:nth-child(8),
    .custom-table td:nth-child(8) { width: 120px; }

    .custom-table th:nth-child(9),
    .custom-table td:nth-child(9) { width: 100px; }

    .custom-table tbody tr:nth-child(even) { background: #f9f9ff; }
    .custom-table tbody tr:nth-child(odd) { background: #ffffff; }

    .custom-table tbody tr:hover {
        background: rgba(49, 32, 205, 0.06);
        transition: 0.3s;
    }

    .customer-info {
        text-align: left;
    }

    .customer-name {
        font-weight: 600;
        margin-bottom: 4px;
    }

    .customer-phone {
        font-size: 12px;
        color: #666;
    }

    .status-badge {
        padding: 6px 10px;
        border-radius: 8px;
        color: white;
        font-weight: 500;
        display: inline-block;
        min-width: 80px;
    }

    .status-depress {
        background: #E74C3C;
    }

    .status-progress {
        background: #F1C40F;
    }

    .status-done {
        background: #2ECC71;
    }

    .status-unknown {
        background: #95A5A6;
    }

    .btn-detail {
        background: var(--primary);
        color: white;
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

    .btn-detail:hover {
        background: var(--primary-dark);
        color: white;
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
</style>

<div class="pemesanan-container">
    <div class="glass-card">
        <div class="top-bar">
            <a href="{{ route('admin.dashboard') }}" class="back-btn">
                <i class="bi bi-arrow-left"></i> Kembali ke Dashboard
            </a>

            <form action="{{ route('admin.statuslayanan.index') }}" method="GET" class="search-form">
                <input type="text" name="search" value="{{ request('search') }}" class="search-input" placeholder="Cari pemesanan...">
                <button type="submit" class="search-btn">
                    <i class="bi bi-search"></i>
                </button>
            </form>
        </div>

        <div class="page-header">
            <div class="page-icon">
                <i class="bi bi-list-check"></i>
            </div>
            <h1 class="page-title">Daftar Pemesanan Layanan</h1>
        </div>

        <div class="table-container">
            <table class="custom-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Customer</th>
                        <th>Layanan</th>
                        <th>Jadwal</th>
                        <th>Harga</th>
                        <th>Metode</th>
                        <th>Teknisi</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($pemesanans as $index => $pemesanan)
                        <tr>
                            <td>{{ ($pemesanans->currentPage() - 1) * $pemesanans->perPage() + $loop->iteration }}</td>

                            <td>
                                <div class="customer-info">
                                    <div class="customer-name">{{ $pemesanan->customer->nama ?? 'Tidak Ada Nama' }}</div>
                                    <div class="customer-phone">{{ $pemesanan->customer->telepon ?? '-' }}</div>
                                </div>
                            </td>

                            <td>{{ $pemesanan->layanan ?? '-' }}</td>
                            <td>{{ $pemesanan->jadwal ?? '-' }}</td>
                            <td>Rp {{ number_format($pemesanan->harga ?? 0, 0, ',', '.') }}</td>
                            <td>{{ $pemesanan->metode ?? '-' }}</td>
                            <td>{{ $pemesanan->teknisi->nama ?? '-' }}</td>

                            <td>
                                @if(($pemesanan->status ?? '') == 'depress')
                                    <span class="status-badge status-depress">Depress</span>
                                @elseif(($pemesanan->status ?? '') == 'progress')
                                    <span class="status-badge status-progress">Progress</span>
                                @elseif(($pemesanan->status ?? '') == 'done')
                                    <span class="status-badge status-done">Selesai</span>
                                @else
                                    <span class="status-badge status-unknown">Tidak Diketahui</span>
                                @endif
                            </td>

                            <td>
                                <a href="#" class="btn-detail">
                                    <i class="bi bi-eye"></i> Detail
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="text-center py-4 text-muted">Tidak ada data pemesanan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($pemesanans->hasPages())
            <div class="pagination-container">
                {{ $pemesanans->links() }}
            </div>
        @endif
    </div>
</div>
@endsection