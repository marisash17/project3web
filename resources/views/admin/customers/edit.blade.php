@extends('layouts.app')

@section('title', 'Edit Customer')

@section('content')
<style>
    .card-custom {
        background: white;
        padding: 50px 40px;
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
        background-color: #3120CD;
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
            <i class="bi bi-person-circle fs-1 d-block text-custom-blue"></i>
            <h3 class="fw-bold text-custom-blue">Edit Akun Customer</h3>
        </div>

        <form action="{{ route('admin.customers.update', $customer->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label fw-bold">Nama Customer:</label>
                <input type="text" name="name" class="form-control form-control-custom" 
                       value="{{ old('name', $customer->name) }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label fw-bold">Alamat:</label>
                <input type="text" name="alamat" class="form-control form-control-custom" 
                       value="{{ old('alamat', $customer->alamat) }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label fw-bold">No. Handphone:</label>
                <input type="text" name="no_hp" class="form-control form-control-custom" 
                       value="{{ old('no_hp', $customer->no_hp) }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label fw-bold">Jenis Kelamin:</label>
                <select name="gender" class="form-control form-control-custom" required>
                    <option value="" disabled>-- Pilih Jenis Kelamin --</option>
                    <option value="Laki-laki" {{ old('gender', $customer->gender) == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                    <option value="Perempuan" {{ old('gender', $customer->gender) == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label fw-bold">Email:</label>
                <input type="email" name="email" class="form-control form-control-custom" 
                       value="{{ old('email', $customer->email) }}" required>
            </div>

            <!-- Tombol rata tengah -->
            <div class="d-flex justify-content-center gap-3 mt-4">
                <a href="{{ route('admin.customers.index') }}" class="btn btn-cancel">
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
