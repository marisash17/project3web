@extends('layouts.app')

@section('title', 'Tambah Layanan')

@section('content')
<style>
    .card-custom {
        background: white;
        padding: 30px 40px;
        border-radius: 8px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.15);
        max-width: 600px;
        margin: auto;
    }
    .form-control-custom {
        background-color: #CFCCE3; 
        border: 1px solid #aaa;
        border-radius: 4px;
    }
    .form-control-custom:focus {
        border-color: #3120CD;
        box-shadow: none;
        background-color: #ffffff; 
    }
    .btn-cancel {
        background-color: #cc0000;
        color: white;
        border: none;
        padding: 8px 20px;
        font-weight: bold;
    }
    .btn-cancel:hover {
        background-color: #990000;
        color: white;
    }
    .btn-submit {
        background-color: #3120CD;
        color: white;
        border: none;
        padding: 8px 20px;
        font-weight: bold;
    }
    .btn-submit:hover {
        background-color: #201090;
        color: white;
    }
    .text-custom-blue {
        color: #3120CD !important;
    }
    body {
        background-color: #F5F5F5;
    }
</style>

<div class="container my-4">
    <div class="card-custom">
        <!-- Judul dengan ikon -->
        <div class="text-center mb-4">
            <i class="bi bi-plus-circle fs-1 d-block text-custom-blue"></i>
            <h3 class="fw-bold text-custom-blue">Tambah Layanan</h3>
        </div>

        <form action="{{ route('admin.layanan.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label class="form-label fw-bold">Jenis Layanan:</label>
                <input type="text" name="jenis_layanan" class="form-control form-control-custom" required>
            </div>

            <div class="mb-3">
                <label class="form-label fw-bold">Deskripsi Layanan:</label>
                <textarea name="deskripsi" class="form-control form-control-custom" rows="4" required></textarea>
            </div>

            <div class="mb-3">
                <label class="form-label fw-bold">Harga Layanan (Rp):</label>
                <input type="number" name="harga" class="form-control form-control-custom" min="0" required>
            </div>

            <div class="mb-3">
                <label class="form-label fw-bold">Pilih Gambar Layanan:</label>
                <input type="file" name="gambar" class="form-control form-control-custom">
            </div>

            <!-- Tombol rata tengah -->
            <div class="d-flex justify-content-center gap-3 mt-4">
                <a href="{{ route('admin.layanan.index') }}" class="btn btn-cancel">
                    <i class="bi bi-x-circle"></i> Batal
                </a>
                <button type="submit" class="btn btn-submit">
                    <i class="bi bi-save"></i> Simpan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
