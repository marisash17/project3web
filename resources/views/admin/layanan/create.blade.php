@extends('layouts.app')

@section('title', 'Tambah Layanan')

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
        font-size: 32px;
        background: linear-gradient(135deg, var(--primary-dark) 0%, var(--primary-light) 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        margin-bottom: 8px;
    }

    .page-subtitle {
        color: #666;
        font-size: 16px;
        font-weight: 500;
    }

    .form-container { margin-top: 20px; }
    .form-row { display: grid; grid-template-columns: 1fr; gap: 25px; margin-bottom: 25px; }
    .form-group { position: relative; }
    .form-group.full-width { grid-column: 1 / -1; }
    .form-label { font-weight: 600; color: #333; margin-bottom: 8px; display: block; font-size: 14px; }

    .form-control-custom {
        background-color: rgba(255, 255, 255, 0.9);
        border: 1px solid rgba(49, 32, 205, 0.2);
        border-radius: 12px;
        padding: 14px 16px;
        font-size: 14px;
        width: 100%;
        transition: all 0.3s ease;
        color: #333;
    }

    .form-control-custom:focus {
        outline: none;
        border-color: var(--primary);
        box-shadow: 0 0 0 3px rgba(49, 32, 205, 0.1);
    }

    textarea.form-control-custom { resize: vertical; min-height: 120px; }

    .button-group {
        display: flex;
        justify-content: center;
        gap: 20px;
        margin-top: 40px;
    }

    .btn-cancel {
        background: #dc3545;
        color: white;
        padding: 14px 30px;
        border-radius: 12px;
        font-weight: 500;
        text-decoration: none;
    }

    .btn-submit {
        background: var(--gradient);
        color: white;
        padding: 14px 30px;
        border-radius: 12px;
        font-weight: 500;
    }

    .error-message { color: #dc3545; font-size: 12px; margin-top: 5px; display: flex; align-items: center; gap: 5px; }
    .error-message i { font-size: 14px; }
</style>

<div class="layanan-container">
    <div class="glass-card">
        <div class="page-header">
            <div class="page-icon"><i class="bi bi-plus-circle"></i></div>
            <h1 class="page-title">Tambah Layanan</h1>
        </div>

        @if(session('success'))
            <div class="alert alert-success">
                <i class="bi bi-check-circle-fill"></i> {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('admin.layanan.store') }}" method="POST" enctype="multipart/form-data" class="form-container">
            @csrf

            <div class="form-row">
                <div class="form-group full-width">
                    <label class="form-label">Jenis Layanan</label>

                    {{-- ====== PERBAIKAN KAMU ADA DI SINI ====== --}}
                    <select name="jenis_layanan" class="form-control-custom" required>
                        <option value="">-- Pilih Jenis Layanan --</option>
                        <option value="Service AC">Service AC</option>
                        <option value="Service Kulkas">Service Kulkas</option>
                        <option value="Service Mesin Cuci">Service Mesin Cuci</option>
                        <option value="Service TV">Service TV</option>
                        <option value="Service Kipas">Service Kipas</option>
                        <option value="Instalasi Listrik">Instalasi Listrik</option>
                        <option value="Cleaning Service Harian">Cleaning Service Harian</option>
                    </select>

                    @error('jenis_layanan')
                        <div class="error-message">
                            <i class="bi bi-exclamation-circle"></i>
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>

            <div class="form-row">
                <div class="form-group full-width">
                    <label class="form-label">Deskripsi Layanan</label>
                    <textarea name="deskripsi" class="form-control-custom" rows="4" required></textarea>
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label fw-bold">Harga Layanan (Rp):</label>
                <input type="number" name="harga" class="form-control form-control-custom" min="0" required>
            </div>

            <div class="mb-3">
                <label class="form-label fw-bold">Pilih Gambar Layanan:</label>
                <input type="file" name="gambar" class="form-control form-control-custom">
            </div>

            <div class="button-group">
                <a href="{{ route('admin.layanan.index') }}" class="btn-cancel">Batal</a>
                <button type="submit" class="btn-submit">Simpan Layanan</button>
            </div>
        </form>
    </div>
</div>
@endsection
