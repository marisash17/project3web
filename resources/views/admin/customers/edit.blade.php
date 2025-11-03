@extends('layouts.app')

@section('title', 'Edit Customer')

@section('content')
<style>
    :root {
        --primary: #3120CD;
        --primary-light: #4430E7;
        --primary-dark: #2B1FC0;
        --gradient: linear-gradient(135deg, #2B1FC0 0%, #4430E7 50%, #5A46FF 100%);
        --card-shadow: 0 8px 32px rgba(49, 32, 205, 0.15);
    }

    /* ====== Card dinaikkan ke atas ====== */
    .edit-container {
        width: 100%;
        min-height: 100vh;
        display: flex;
        justify-content: center;
        align-items: flex-start; /* dari center -> flex-start */
        padding: 80px 20px; /* tambahkan padding atas agar card naik */
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

    /* Form */
    .form-container { margin-top: 20px; }

    .form-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 25px;
        margin-bottom: 25px;
    }

    .form-group { position: relative; }

    .form-group.full-width { grid-column: 1 / -1; }

    .form-label {
        font-weight: 600;
        color: #333;
        margin-bottom: 8px;
        display: block;
        font-size: 14px;
    }

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
        background-color: rgba(255, 255, 255, 0.95);
    }

    select.form-control-custom {
        appearance: none;
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%233120CD' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='m6 8 4 4 4-4'/%3e%3c/svg%3e");
        background-position: right 16px center;
        background-repeat: no-repeat;
        background-size: 16px;
        padding-right: 40px;
    }

    /* Tombol */
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
        box-shadow: 0 4px 15px rgba(220, 53, 69, 0.2);
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
        box-shadow: 0 4px 15px rgba(49, 32, 205, 0.2);
    }

    .btn-cancel:hover { background: #c82333; transform: translateY(-2px); }
    .btn-submit:hover { transform: translateY(-2px); }

    /* Animasi */
    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(30px); }
        to { opacity: 1; transform: translateY(0); }
    }

</style>

<div class="edit-container">
    <div class="glass-card">
        <div class="page-header">
            <div class="page-icon"><i class="bi bi-person-circle"></i></div>
            <h1 class="page-title">Edit Akun Customer</h1>
        </div>

        @if(session('success'))
            <div class="alert alert-success">
                <i class="bi bi-check-circle-fill"></i> {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('admin.customers.update', $customer->id) }}" method="POST" class="form-container">
            @csrf
            @method('PUT')

            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">Nama Customer</label>
                    <input type="text" name="name" class="form-control-custom" value="{{ old('name', $customer->name) }}" required>
                </div>

                <div class="form-group">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-control-custom" value="{{ old('email', $customer->email) }}" required>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">No. Handphone</label>
                    <input type="text" name="no_hp" class="form-control-custom" value="{{ old('no_hp', $customer->no_hp) }}" required>
                </div>

                <div class="form-group">
                    <label class="form-label">Jenis Kelamin</label>
                    <select name="gender" class="form-control-custom" required>
                        <option value="Laki-laki" {{ old('gender', $customer->gender) == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                        <option value="Perempuan" {{ old('gender', $customer->gender) == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                    </select>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group full-width">
                    <label class="form-label">Alamat</label>
                    <input type="text" name="alamat" class="form-control-custom" value="{{ old('alamat', $customer->alamat) }}" required>
                </div>
            </div>

            <div class="button-group">
                <a href="{{ route('admin.customers.index') }}" class="btn-cancel">
                    <i class="bi bi-x-circle"></i> Batal
                </a>
                <button type="submit" class="btn-submit">
                    <i class="bi bi-save"></i> Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
