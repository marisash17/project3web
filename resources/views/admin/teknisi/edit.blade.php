@extends('layouts.app')

@section('title', 'Edit Teknisi')

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
        background-color: #1f149c;
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
            <i class="bi bi-person-gear fs-1 d-block text-custom-blue"></i>
            <h3 class="fw-bold text-custom-blue">Edit Teknisi</h3>
        </div>

        <form action="{{ route('admin.teknisi.update', $teknisi->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label fw-bold">Nama Teknisi:</label>
                <input type="text" name="nama" value="{{ $teknisi->nama }}" class="form-control form-control-custom" required>
            </div>
            <div class="mb-3">
                <label class="form-label fw-bold">Alamat:</label>
                <input type="text" name="alamat" value="{{ $teknisi->alamat }}" class="form-control form-control-custom" required>
            </div>
            <div class="mb-3">
                <label class="form-label fw-bold">No. Handphone:</label>
                <input type="text" name="no_telepon" value="{{ $teknisi->no_telepon }}" class="form-control form-control-custom" required>
            </div>
            <div class="mb-3">
                <label class="form-label fw-bold">Jenis Kelamin:</label>
                <select name="jenis_kelamin" class="form-control form-control-custom" required>
                    <option value="Laki-laki" {{ $teknisi->jenis_kelamin == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                    <option value="Perempuan" {{ $teknisi->jenis_kelamin == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label fw-bold">Keahlian:</label>
                <select name="keahlian" class="form-control form-control-custom" required>
                    <option value="" disabled>-- Pilih Keahlian --</option>
                    <option value="Service AC" {{ $teknisi->keahlian == 'Service AC' ? 'selected' : '' }}>Service AC</option>
                    <option value="Service Kulkas" {{ $teknisi->keahlian == 'Service Kulkas' ? 'selected' : '' }}>Service Kulkas</option>
                    <option value="Service Mesin Cuci" {{ $teknisi->keahlian == 'Service Mesin Cuci' ? 'selected' : '' }}>Service Mesin Cuci</option>
                    <option value="Service TV" {{ $teknisi->keahlian == 'Service TV' ? 'selected' : '' }}>Service TV</option>
                    <option value="Service Kipas" {{ $teknisi->keahlian == 'Service Kipas' ? 'selected' : '' }}>Service Kipas</option>
                    <option value="Instalasi Listrik" {{ $teknisi->keahlian == 'Instalasi Listrik' ? 'selected' : '' }}>Instalasi Listrik</option>
                    <option value="Cleaning Service Harian" {{ $teknisi->keahlian == 'Cleaning Service Harian' ? 'selected' : '' }}>Cleaning Service Harian</option>
                </select>
            </div>

            <!-- Tombol rata tengah -->
            <div class="d-flex justify-content-center gap-3 mt-4">
                <a href="{{ route('admin.teknisi.index') }}" class="btn btn-cancel">
                    <i class="bi bi-x-circle"></i> Batal
                </a>
                <button type="submit" class="btn btn-submit">
                    <i class="bi bi-check-circle"></i> Simpan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
