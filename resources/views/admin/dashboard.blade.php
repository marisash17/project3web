@extends('layouts.app')

@section('title', 'Dashboard Admin')
@section('page-title', 'Dashboard')

@section('content')
<style>
    .dashboard-container {
        padding: 30px;
        max-width: 1400px;
        margin: 0 auto;
    }

    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 25px;
        margin-bottom: 40px;
    }

    .stat-card {
        background: linear-gradient(135deg, rgba(255,255,255,0.9) 0%, rgba(255,255,255,0.7) 100%);
        backdrop-filter: blur(20px);
        border-radius: 20px;
        padding: 30px 25px;
        box-shadow: var(--card-shadow);
        border: 1px solid rgba(255, 255, 255, 0.5);
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        position: relative;
        overflow: hidden;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        text-align: center;
        min-height: 200px;
    }

    .stat-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: var(--gradient);
    }

    .stat-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 15px 40px rgba(49, 32, 205, 0.2);
    }

    .stat-icon {
        width: 70px;
        height: 70px;
        border-radius: 18px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 20px;
        font-size: 28px;
        background: var(--gradient);
        color: white;
        box-shadow: 0 6px 20px rgba(49, 32, 205, 0.25);
    }

    .stat-content {
        width: 100%;
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 8px;
    }

    .stat-content h3 {
        font-size: 14px;
        font-weight: 600;
        color: #666;
        margin: 0;
        text-transform: uppercase;
        letter-spacing: 1px;
        line-height: 1.4;
    }

    .stat-value {
        font-size: 36px;
        font-weight: 800;
        margin: 0;
        background: linear-gradient(135deg, var(--primary-dark) 0%, var(--primary-light) 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        line-height: 1.2;
        letter-spacing: -0.5px;
    }

    /* Riwayat Pesanan Styles */
    .history-section {
        margin-bottom: 40px;
    }

    .history-card {
        background: linear-gradient(135deg, rgba(255,255,255,0.95) 0%, rgba(255,255,255,0.85) 100%);
        backdrop-filter: blur(20px);
        border-radius: 20px;
        padding: 30px;
        box-shadow: var(--card-shadow);
        border: 1px solid rgba(255, 255, 255, 0.6);
        transition: all 0.3s ease;
    }

    .history-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 12px 35px rgba(49, 32, 205, 0.15);
    }

    .section-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 25px;
    }

    .section-title {
        font-size: 22px;
        font-weight: 700;
        color: #1f2937;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .section-title i {
        color: var(--primary);
        font-size: 24px;
    }

    .view-all-btn {
        background: var(--gradient);
        color: white;
        border: none;
        padding: 10px 20px;
        border-radius: 12px;
        font-weight: 500;
        text-decoration: none;
        display: flex;
        align-items: center;
        gap: 8px;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(49, 32, 205, 0.2);
    }

    .view-all-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(49, 32, 205, 0.3);
        color: white;
    }

    .orders-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 20px;
        margin-bottom: 20px;
    }

    .order-card {
        background: white;
        border-radius: 16px;
        padding: 20px;
        box-shadow: 0 2px 12px rgba(0, 0, 0, 0.08);
        border: 1px solid rgba(0, 0, 0, 0.05);
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }

    .order-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 4px;
        height: 100%;
        background: var(--gradient);
    }

    .order-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.12);
    }

    .order-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        margin-bottom: 15px;
    }

    .order-id {
        font-weight: 600;
        color: #374151;
        font-size: 15px;
    }

    .order-status {
        padding: 4px 12px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .status-completed {
        background: #d1fae5;
        color: #065f46;
    }

    .status-pending {
        background: #fef3c7;
        color: #92400e;
    }

    .status-processing {
        background: #dbeafe;
        color: #1e40af;
    }

    .status-cancelled {
        background: #fee2e2;
        color: #991b1b;
    }

    .order-customer {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 12px;
    }

    .customer-avatar {
        width: 36px;
        height: 36px;
        border-radius: 50%;
        background: var(--gradient);
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 14px;
        font-weight: 600;
    }

    .customer-info h4 {
        font-size: 14px;
        font-weight: 600;
        color: #1f2937;
        margin: 0;
    }

    .customer-info p {
        font-size: 12px;
        color: #6b7280;
        margin: 2px 0 0;
    }

    .order-details {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 10px;
        margin-bottom: 15px;
    }

    .detail-item {
        display: flex;
        flex-direction: column;
        gap: 4px;
    }

    .detail-label {
        font-size: 11px;
        color: #6b7280;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        font-weight: 600;
    }

    .detail-value {
        font-size: 13px;
        font-weight: 600;
        color: #374151;
    }

    .order-footer {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding-top: 15px;
        border-top: 1px solid #f3f4f6;
    }

    .order-amount {
        font-weight: 700;
        font-size: 16px;
        color: var(--primary);
    }

    .order-date {
        font-size: 12px;
        color: #9ca3af;
    }

    .no-orders {
        text-align: center;
        padding: 40px 20px;
        color: #6b7280;
    }

    .no-orders i {
        font-size: 48px;
        margin-bottom: 15px;
        opacity: 0.5;
    }

    .no-orders p {
        margin: 0;
        font-size: 16px;
    }

    /* Quick Actions Styles */
    .quick-actions {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 20px;
    }

    .action-btn {
        background: linear-gradient(135deg, rgba(255,255,255,0.9) 0%, rgba(255,255,255,0.7) 100%);
        backdrop-filter: blur(20px);
        border: 1px solid rgba(255, 255, 255, 0.5);
        border-radius: 16px;
        padding: 25px 20px;
        text-align: center;
        text-decoration: none;
        color: inherit;
        transition: all 0.3s ease;
        box-shadow: var(--card-shadow);
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        min-height: 140px;
    }

    .action-btn:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 30px rgba(49, 32, 205, 0.15);
        color: inherit;
    }

    .action-icon {
        width: 50px;
        height: 50px;
        border-radius: 12px;
        background: var(--gradient);
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 15px;
        color: white;
        font-size: 20px;
        transition: all 0.3s ease;
    }

    .action-btn:hover .action-icon {
        transform: scale(1.1);
        box-shadow: 0 6px 15px rgba(49, 32, 205, 0.3);
    }

    .action-text {
        font-weight: 600;
        color: #374151;
        font-size: 14px;
        line-height: 1.4;
    }

    /* Untuk memastikan link juga menengah */
    .stat-card-link {
        text-decoration: none;
        color: inherit;
        display: block;
        width: 100%;
    }

    /* Animations */
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .stat-card, .history-card, .action-btn {
        animation: fadeInUp 0.6s ease-out;
    }

    .stat-card:nth-child(1) { animation-delay: 0.1s; }
    .stat-card:nth-child(2) { animation-delay: 0.2s; }
    .stat-card:nth-child(3) { animation-delay: 0.3s; }
    .stat-card:nth-child(4) { animation-delay: 0.4s; }
    .stat-card:nth-child(5) { animation-delay: 0.5s; }

    /* Responsive */
    @media (max-width: 768px) {
        .dashboard-container {
            padding: 20px 15px;
        }
        
        .stats-grid {
            grid-template-columns: 1fr;
            gap: 20px;
        }
        
        .stat-card {
            padding: 25px 20px;
            min-height: 180px;
        }
        
        .stat-icon {
            width: 60px;
            height: 60px;
            font-size: 24px;
            margin-bottom: 15px;
        }
        
        .stat-value {
            font-size: 32px;
        }
        
        .stat-content h3 {
            font-size: 13px;
        }
        
        .section-header {
            flex-direction: column;
            gap: 15px;
            align-items: flex-start;
        }
        
        .orders-grid {
            grid-template-columns: 1fr;
        }
        
        .order-details {
            grid-template-columns: 1fr;
        }
        
        .quick-actions {
            grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            gap: 15px;
        }
        
        .action-btn {
            padding: 20px 15px;
            min-height: 120px;
        }
        
        .action-icon {
            width: 45px;
            height: 45px;
            font-size: 18px;
            margin-bottom: 12px;
        }
        
        .action-text {
            font-size: 13px;
        }
    }

    @media (max-width: 480px) {
        .quick-actions {
            grid-template-columns: 1fr 1fr;
        }
    }
</style>

<div class="dashboard-container">
    <!-- Stats Grid -->
    <div class="stats-grid">
        <a href="{{ route('admin.customers.index') }}" class="stat-card-link">
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="bi bi-people-fill"></i>
                </div>
                <div class="stat-content">
                    <h3>Total Customer</h3>
                    <div class="stat-value">{{ $totalCustomers ?? 0 }}</div>
                </div>
            </div>
        </a>

        <a href="{{ route('admin.teknisi.index') }}" class="stat-card-link">
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="bi bi-person-gear"></i>
                </div>
                <div class="stat-content">
                    <h3>Total Teknisi</h3>
                    <div class="stat-value">{{ $totalTeknisi ?? 0 }}</div>
                </div>
            </div>
        </a>

        <a href="{{ route('admin.pendapatan.index') }}" class="stat-card-link">
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="bi bi-cash-coin"></i>
                </div>
                <div class="stat-content">
                    <h3>Total Pendapatan</h3>
                    <div class="stat-value">Rp {{ number_format($totalPendapatan ?? 0,0,',','.') }}</div>
                </div>
            </div>
        </a>

        <a href="{{ route('admin.layanan.index') }}" class="stat-card-link">
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="bi bi-gear-fill"></i>
                </div>
                <div class="stat-content">
                    <h3>Total Layanan</h3>
                    <div class="stat-value">{{ $totalLayanan ?? 0 }}</div>
                </div>
            </div>
        </a>
    </div>

    <!-- Riwayat Pesanan Section -->
    <div class="history-section">
        <div class="history-card">
            <div class="section-header">
                <h2 class="section-title">
                    <i class="bi bi-list-check"></i>
                    Status Layanan Terbaru
                </h2>
                <a href="{{ route('admin.statuslayanan.index') }}" class="view-all-btn">
                    <i class="bi bi-arrow-right"></i>
                    Lihat Semua
                </a>
            </div>

            @if(isset($recentOrders) && count($recentOrders) > 0)
            <div class="orders-grid">
                @foreach($recentOrders as $order)
                <div class="order-card">
                    <div class="order-header">
                        <div class="order-id">#{{ $order->order_number ?? 'ORD-' . $loop->iteration }}</div>
                        <div class="order-status status-{{ $order->status ?? 'pending' }}">
                            {{ $order->status ?? 'Pending' }}
                        </div>
                    </div>

                    <div class="order-customer">
                        <div class="customer-avatar">
                            {{ substr($order->customer_name ?? 'Customer', 0, 1) }}
                        </div>
                        <div class="customer-info">
                            <h4>{{ $order->customer_name ?? 'Nama Customer' }}</h4>
                            <p>{{ $order->customer_phone ?? 'No Telepon' }}</p>
                        </div>
                    </div>

                    <div class="order-details">
                        <div class="detail-item">
                            <span class="detail-label">Layanan</span>
                            <span class="detail-value">{{ $order->service_name ?? 'Service Name' }}</span>
                        </div>
                        <div class="detail-item">
                            <span class="detail-label">Teknisi</span>
                            <span class="detail-value">{{ $order->technician_name ?? 'Belum Ditugaskan' }}</span>
                        </div>
                    </div>

                    <div class="order-footer">
                        <div class="order-amount">
                            Rp {{ number_format($order->total_amount ?? 0, 0, ',', '.') }}
                        </div>
                        <div class="order-date">
                            {{ $order->created_at ? \Carbon\Carbon::parse($order->created_at)->format('d M Y') : 'Tanggal' }}
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            @else
            <div class="no-orders">
                <i class="bi bi-list-check"></i>
                <p>Belum ada status layanan terbaru</p>
            </div>
            @endif
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="section-header">
        <h2 class="section-title">Quick Actions</h2>
    </div>
    
    <div class="quick-actions">
        <a href="{{ route('admin.customers.index') }}" class="action-btn">
            <div class="action-icon">
                <i class="bi bi-people"></i>
            </div>
            <div class="action-text">Kelola Customer</div>
        </a>
        
        <a href="{{ route('admin.teknisi.index') }}" class="action-btn">
            <div class="action-icon">
                <i class="bi bi-person-plus"></i>
            </div>
            <div class="action-text">Tambah Teknisi</div>
        </a>
        
        <a href="{{ route('admin.layanan.index') }}" class="action-btn">
            <div class="action-icon">
                <i class="bi bi-plus-circle"></i>
            </div>
            <div class="action-text">Tambah Layanan</div>
        </a>
        
        <a href="{{ route('admin.statuslayanan.index') }}" class="action-btn">
            <div class="action-icon">
                <i class="bi bi-list-check"></i>
            </div>
            <div class="action-text">Status Layanan</div>
        </a>

        <!-- Tambahan Transaksi -->
        <a href="{{ route('admin.pendapatan.index') }}" class="action-btn">
            <div class="action-icon">
                <i class="bi bi-cash-stack"></i>
            </div>
            <div class="action-text">Kelola Transaksi</div>
        </a>
    </div>
</div>

<script>
    // Add hover effects
    document.addEventListener('DOMContentLoaded', function() {
        const cards = document.querySelectorAll('.stat-card, .order-card, .action-btn');
        
        cards.forEach(card => {
            card.addEventListener('mouseenter', function() {
                if (this.classList.contains('action-btn')) {
                    this.style.transform = 'translateY(-5px)';
                } else {
                    this.style.transform = 'translateY(-8px) scale(1.02)';
                }
            });
            
            card.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(0) scale(1)';
            });
        });

        // Status color coding
        const statusElements = document.querySelectorAll('.order-status');
        statusElements.forEach(status => {
            const statusText = status.textContent.toLowerCase();
            if (statusText.includes('selesai') || statusText.includes('completed')) {
                status.className = 'order-status status-completed';
            } else if (statusText.includes('pending') || statusText.includes('menunggu')) {
                status.className = 'order-status status-pending';
            } else if (statusText.includes('proses') || statusText.includes('processing')) {
                status.className = 'order-status status-processing';
            } else if (statusText.includes('batal') || statusText.includes('cancelled')) {
                status.className = 'order-status status-cancelled';
            }
        });
    });
</script>
@endsection