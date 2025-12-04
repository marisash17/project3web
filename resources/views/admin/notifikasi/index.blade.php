@extends('layouts.app')

@section('title', 'Notifikasi Admin')
@section('page-title', 'Notifikasi')

@section('content')
<style>
    .notif-wrapper {
        max-width: 780px;
        margin: auto;
        animation: fadeIn 0.4s ease-in-out;
    }

    @keyframes fadeIn {
        0% { opacity: 0; transform: translateY(10px); }
        100% { opacity: 1; transform: translateY(0); }
    }

    .notif-card {
        background: rgba(255, 255, 255, 0.45);
        backdrop-filter: blur(18px);
        border-radius: 20px;
        padding: 22px;
        display: flex;
        gap: 18px;
        box-shadow: 0 10px 25px rgba(0,0,0,0.06);
        border: 1px solid rgba(255,255,255,0.6);
        margin-bottom: 18px;
        transition: all 0.3s ease;
        position: relative;
    }

    .notif-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 18px 35px rgba(82, 63, 255, 0.15);
    }

    .notif-icon {
        width: 48px;
        height: 48px;
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
        flex-shrink: 0;
        color: white;
    }

    .notif-content { flex: 1; }

    .notif-title {
        font-size: 17px;
        font-weight: 700;
        color: #1f2937;
        margin: 0 0 6px;
    }

    .notif-msg {
        font-size: 14px;
        color: #4b5563;
        margin-bottom: 10px;
        line-height: 1.5;
    }

    .notif-date {
        font-size: 12px;
        color: #9ca3af;
    }

    .notif-unread {
        border-left: 6px solid var(--primary);
    }

    .notif-badge {
        position: absolute;
        right: 18px;
        top: 18px;
        background: var(--primary);
        color: white;
        padding: 4px 10px;
        border-radius: 12px;
        font-size: 11px;
        font-weight: 600;
    }

    /* Tombol delete */
    .notif-delete {
        position: absolute;
        right: 18px;
        bottom: 18px;
        background: rgba(255, 71, 87, 0.12);
        border: none;
        color: #ef4444;
        padding: 6px 8px;
        border-radius: 10px;
        font-size: 14px;
        cursor: pointer;
        transition: 0.2s;
    }

    .notif-delete:hover {
        background: rgba(239, 68, 68, 0.25);
        color: #dc2626;
    }

    .no-orders {
        text-align: center;
        color: #6b7280;
        padding: 50px;
        animation: fadeIn 0.5s ease;
    }

    .no-orders i {
        font-size: 40px;
        margin-bottom: 12px;
        color: #9ca3af;
    }
</style>

<div class="notif-wrapper">
    <h2 class="section-title mb-4">
       
    </h2>

    @if($notifikasis->count() > 0)
        @foreach($notifikasis as $n)

            @php
                $icon = 'bi-info-circle';
                $color = '#6366f1';

                if (Str::contains(strtolower($n->judul), 'pemesanan')) {
                    $icon = 'bi-receipt-cutoff';
                    $color = '#10b981';
                } elseif (Str::contains(strtolower($n->judul), 'teknisi')) {
                    $icon = 'bi-wrench-adjustable-circle';
                    $color = '#f59e0b';
                } elseif (Str::contains(strtolower($n->judul), 'warning')) {
                    $icon = 'bi-exclamation-triangle';
                    $color = '#ef4444';
                }
            @endphp

            <div class="notif-card {{ $n->is_read ? '' : 'notif-unread' }}">
                <div class="notif-icon" style="background: {{ $color }};">
                    <i class="bi {{ $icon }}"></i>
                </div>

                <div class="notif-content">
                    <div class="notif-title">{{ $n->judul }}</div>
                    <div class="notif-msg">{{ $n->pesan }}</div>
                    <div class="notif-date">
                        <i class="bi bi-clock"></i>
                        {{ $n->created_at->format('d M Y H:i') }}
                    </div>
                </div>

                {{-- Badge Baru --}}
                @if(!$n->is_read)
                    <div class="notif-badge">Baru</div>
                @endif

                {{-- Tombol Hapus --}}
                <form action="{{ route('admin.notifikasi.destroy', $n->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="notif-delete">
                        <i class="bi bi-trash"></i>
                    </button>
                </form>
            </div>
        @endforeach

    @else
        <div class="no-orders">
            <i class="bi bi-bell-slash"></i>
            <p>Tidak ada notifikasi</p>
        </div>
    @endif
</div>
@endsection
