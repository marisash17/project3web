@extends('layouts.app')

@section('title', 'Kelola Pendapatan')

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

    /* ====== Total Card ====== */
    .total-card {
        background: var(--gradient);
        color: white;
        padding: 25px;
        border-radius: 16px;
        text-align: center;
        margin: 25px auto;
        max-width: 400px;
        box-shadow: 0 8px 25px rgba(49, 32, 205, 0.3);
        position: relative;
        overflow: hidden;
        animation: pulse 3s ease-in-out infinite;
    }

    .total-card::before {
        content: '';
        position: absolute;
        top: -50%;
        left: -50%;
        width: 200%;
        height: 200%;
        background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
    }

    .total-label {
        font-size: 16px;
        opacity: 0.9;
        margin-bottom: 8px;
        font-weight: 500;
    }

    .total-amount {
        font-size: 2rem;
        font-weight: 700;
        margin: 0;
        text-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }

    /* ====== Filter Section ====== */
    .filter-section {
        background: rgba(255, 255, 255, 0.6);
        border-radius: 16px;
        padding: 20px;
        margin-bottom: 25px;
        border: 1px solid rgba(49, 32, 205, 0.1);
        backdrop-filter: blur(10px);
        max-width: 500px;
        margin-left: auto;
        margin-right: auto;
    }

    .form-control-custom {
        background: white;
        border: 2px solid rgba(49, 32, 205, 0.2);
        border-radius: 12px;
        padding: 12px 16px;
        font-size: 14px;
        transition: all 0.3s ease;
        color: #333;
    }

    .form-control-custom:focus {
        outline: none;
        border-color: var(--primary);
        box-shadow: 0 0 0 3px rgba(49, 32, 205, 0.1);
        background: white;
    }

    .btn-filter {
        background: var(--gradient);
        color: white;
        border: none;
        border-radius: 12px;
        padding: 12px 24px;
        font-weight: 600;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(49, 32, 205, 0.2);
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }

    .btn-filter:hover {
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

    /* Tentukan lebar kolom untuk Pendapatan */
    .custom-table th:nth-child(1),
    .custom-table td:nth-child(1) { width: 80px; } /* No */

    .custom-table th:nth-child(2),
    .custom-table td:nth-child(2) { width: 150px; } /* Tanggal */

    .custom-table th:nth-child(3),
    .custom-table td:nth-child(3) { width: 200px; } /* Nama Customer */

    .custom-table th:nth-child(4),
    .custom-table td:nth-child(4) { width: 250px; } /* Booking Layanan */

    .custom-table th:nth-child(5),
    .custom-table td:nth-child(5) { width: 180px; } /* Total */

    .custom-table tbody tr:nth-child(even) { background: #f9f9ff; }
    .custom-table tbody tr:nth-child(odd) { background: #ffffff; }

    .custom-table tbody tr:hover {
        background: rgba(49, 32, 205, 0.06);
        transition: 0.3s;
    }

    /* Ikon dalam tabel */
    .table-icon {
        margin-right: 6px;
        opacity: 0.8;
    }

    .text-success {
        color: #28a745 !important;
        font-weight: 600;
    }

    /* Empty State */
    .empty-state {
        text-align: center;
        padding: 60px 20px;
        color: #666;
    }

    .empty-state i {
        font-size: 48px;
        margin-bottom: 16px;
        opacity: 0.5;
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

    /* Animations */
    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(30px); }
        to { opacity: 1; transform: translateY(0); }
    }

    @keyframes pulse {
        0% { transform: scale(1); }
        50% { transform: scale(1.02); }
        100% { transform: scale(1); }
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
        
        .filter-section {
            padding: 15px;
            max-width: 90%;
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
        
        .total-card {
            padding: 20px;
            margin: 20px auto;
        }
        
        .total-amount {
            font-size: 1.6rem;
        }
    }

    @media (max-width: 576px) {
        .glass-card {
            padding: 20px 15px;
        }
        
        .page-title {
            font-size: 24px;
        }
        
        .page-icon {
            width: 60px;
            height: 60px;
            font-size: 24px;
        }
        
        .total-card {
            padding: 15px;
        }
        
        .total-amount {
            font-size: 1.4rem;
        }
        
        .btn-filter {
            width: 100%;
            margin-top: 10px;
        }
    }
</style>

<div class="layanan-container">
    <div class="glass-card">
        <div class="top-bar">
            <a href="{{ route('admin.dashboard') }}" class="back-btn">
                <i class="bi bi-arrow-left"></i> Kembali ke Dashboard
            </a>
        </div>

        <div class="page-header">
            <div class="page-icon">
                <i class="bi bi-cash-coin"></i>
            </div>
            <h1 class="page-title">Kelola Transaksi</h1>
        </div>

        <!-- Success Message -->
        @if(session('success'))
            <div class="alert alert-success">
                <i class="bi bi-check-circle-fill"></i>
                {{ session('success') }}
            </div>
        @endif

        <!-- Total Pendapatan Card -->
        <div class="total-card">
            <div class="total-label">Total Transaksi</div>
            <div class="total-amount">Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</div>
        </div>

        <!-- Filter Section -->
        <div class="filter-section">
            <form action="{{ route('admin.pendapatan.index') }}" method="GET" class="row g-3 align-items-center justify-content-center">
                <div class="col-md-8 col-12">
                    <input type="month" 
                           name="bulan" 
                           class="form-control form-control-custom"
                           value="{{ request('bulan') }}"
                           onchange="this.form.submit()">
                </div>
                <div class="col-md-4 col-12">
                    <button type="submit" class="btn btn-filter w-100">
                        <i class="bi bi-funnel"></i> Tampilkan
                    </button>
                </div>
            </form>
        </div>

        <!-- Table Container -->
        <div class="table-container">
            <table class="custom-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Tanggal</th>
                        <th>Nama Customer</th>
                        <th>Booking Layanan</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pendapatans as $index => $p)
                        <tr>
                            <td class="fw-bold">{{ $index + 1 }}</td>
                            <td>
                                <i class="bi bi-calendar3 table-icon"></i>
                                {{ \Carbon\Carbon::parse($p->tanggal)->translatedFormat('d F Y') }}
                            </td>
                            <td>
                                <i class="bi bi-person table-icon"></i>
                                {{ $p->customer->nama ?? '-' }}
                            </td>
                            <td>
                                <i class="bi bi-bag table-icon"></i>
                                {{ $p->layanan->jenis_layanan ?? '-' }}
                            </td>
                            <td class="text-success">
                                <i class="bi bi-currency-dollar table-icon"></i>
                                Rp {{ number_format($p->jumlah, 0, ',', '.') }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5">
                                <div class="empty-state">
                                    <i class="bi bi-receipt"></i>
                                    <h5>Belum ada data transaksi</h5>
                                    <p class="text-muted">Transaksi akan muncul di sini ketika sudah ada data</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
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

        // Auto-submit form when month changes on desktop
        const monthInput = document.querySelector('input[type="month"]');
        if (window.innerWidth > 768) {
            monthInput.addEventListener('change', function() {
                this.form.submit();
            });
        }
    });
</script>
@endsection