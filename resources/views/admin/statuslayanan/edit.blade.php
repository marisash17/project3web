@extends('layouts.app')

@section('title', 'Tetapkan Teknisi')

@section('content')
<style>
    :root {
        --primary: #3120CD;
        --primary-light: #4430E7;
        --primary-dark: #2B1FC0;
        --gradient: linear-gradient(135deg, #2B1FC0 0%, #4430E7 50%, #5A46FF 100%);
        --card-shadow: 0 8px 32px rgba(49, 32, 205, 0.15);
    }

    body {
        background: #f8f9ff;
    }

    .pemesanan-container {
        width: 100%;
        min-height: 100vh;
        display: flex;
        justify-content: center;
        align-items: flex-start;
        padding: 80px 20px;
        background: #f8f9ff;
    }

    .glass-card {
        background: linear-gradient(135deg, rgba(255,255,255,0.95) 0%, rgba(255,255,255,0.88) 100%);
        backdrop-filter: blur(20px);
        border-radius: 20px;
        padding: 50px;
        box-shadow: var(--card-shadow);
        border: 1px solid rgba(255, 255, 255, 0.6);
        transition: all 0.3s ease;
        width: 100%;
        max-width: 800px;
        animation: fadeInUp 0.6s ease-out;
    }

    .glass-card:hover {
        box-shadow: 0 12px 40px rgba(49, 32, 205, 0.2);
    }

    .page-header {
        text-align: center;
        margin-bottom: 40px;
    }

    .page-icon {
        width: 80px;
        height: 80px;
        border-radius: 20px;
        background: var(--gradient);
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 20px;
        color: white;
        font-size: 32px;
        box-shadow: 0 6px 20px rgba(49, 32, 205, 0.3);
    }

    .page-title {
        font-weight: 700;
        font-size: 30px;
        background: linear-gradient(135deg, var(--primary-dark) 0%, var(--primary-light) 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        margin-bottom: 8px;
    }

    .info-box {
        background: rgba(255,255,255,0.7);
        border: 1px solid rgba(49,32,205,0.1);
        border-radius: 12px;
        padding: 18px 24px;
        margin-bottom: 25px;
        box-shadow: 0 4px 12px rgba(49,32,205,0.05);
    }

    .info-box strong {
        color: var(--primary-dark);
    }

    .form-label {
        font-weight: 600;
        color: #333;
        margin-bottom: 8px;
        display: block;
        font-size: 14px;
    }

    .form-select {
        background-color: rgba(255,255,255,0.9);
        border: 1px solid rgba(49, 32, 205, 0.2);
        border-radius: 12px;
        padding: 14px 16px;
        font-size: 14px;
        width: 100%;
        transition: all 0.3s ease;
        color: #333;
    }

    .form-select:focus {
        outline: none;
        border-color: var(--primary);
        box-shadow: 0 0 0 3px rgba(49,32,205,0.1);
        background-color: rgba(255,255,255,0.95);
    }

    .button-group {
        display: flex;
        justify-content: center;
        gap: 20px;
        margin-top: 40px;
        flex-wrap: wrap;
    }

    .btn-cancel {
        background: #dc3545;
        color: white;
        border: none;
        padding: 14px 30px;
        border-radius: 12px;
        font-weight: 500;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(220,53,69,0.2);
    }

    .btn-submit {
        background: var(--gradient);
        color: white;
        border: none;
        padding: 14px 30px;
        border-radius: 12px;
        font-weight: 500;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(49,32,205,0.2);
    }

    .btn-cancel:hover { background: #c82333; transform: translateY(-2px); }
    .btn-submit:hover { transform: translateY(-2px); }

    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(30px); }
        to { opacity: 1; transform: translateY(0); }
    }
</style>

<div class="pemesanan-container">
    <div class="glass-card">
        <div class="page-header">
            <div class="page-icon"><i class="bi bi-person-badge"></i></div>
            <h1 class="page-title">Tentukan Teknisi</h1>
            <p class="page-subtitle text-muted">Pilih teknisi yang akan menangani layanan pelanggan</p>
        </div>

        <div class="info-box">
            <p><strong>Customer:</strong> {{ $pemesanan->user->name ?? 'Tidak diketahui' }}</p>
            <p><strong>Layanan:</strong> {{ $pemesanan->layanan->jenis_layanan ?? '-' }}</p>
            <p><strong>Jadwal:</strong> {{ \Carbon\Carbon::parse($pemesanan->jadwal_service)->format('d M Y, H:i') }}</p>
        </div>

        <form action="{{ route('admin.statuslayanan.assign', $pemesanan->id) }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="teknisi_id" class="form-label">Pilih Teknisi</label>
                <select name="teknisi_id" id="teknisi_id" class="form-select" required>
                    <option value="">-- Pilih Teknisi --</option>
                    @foreach($teknisis as $t)
                        <option value="{{ $t->id }}" {{ $pemesanan->teknisi_id == $t->id ? 'selected' : '' }}>
                            {{ $t->nama }} ({{ $t->keahlian }})
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="button-group">
                <a href="{{ route('admin.statuslayanan.index') }}" class="btn-cancel">
                    <i class="bi bi-x-circle"></i> Batal
                </a>
                <button type="submit" class="btn-submit">
                    <i class="bi bi-check-circle"></i> Simpan Teknisi
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
