@extends('layouts.app')

@section('title', 'Kelola Status Layanan')

@section('content')
<style>
    .card-custom {
        background: white;
        padding: 40px;
        border-radius: 10px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.15);
    }
    .text-custom-blue {
        color: #3120CD !important;
    }
    .table-custom {
        border: 1px solid #000;
        border-collapse: collapse;
        width: 100%;
        text-align: center;
    }
    .table-custom thead {
        background-color: #CFCCE3;
    }
    .table-custom th, .table-custom td {
        border: 1px solid #000;
        padding: 8px;
        vertical-align: middle;
    }
    body {
        background-color: #F5F5F5;
    }
</style>

<div class="container my-4">
    <div class="card-custom">
        <!-- Judul -->
        <div class="text-center mb-4">
            <i class="bi bi-check2-square fs-1 d-block text-custom-blue"></i>
            <h3 class="fw-bold text-custom-blue">Status Layanan</h3>
        </div>

        <!-- Tabel -->
        <table class="table-custom">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Customer</th>
                    <th>Nama Teknisi</th>
                    <th>Jenis Layanan</th>
                    <th>Status</th>
                    <th>Tanggal Update</th>
                </tr>
            </thead>
            <tbody>
                @forelse($layanans as $index => $layanan)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $layanan->customer->nama ?? '-' }}</td>
                        <td>{{ $layanan->teknisi->nama ?? '-' }}</td>
                        <td>{{ $layanan->jenis_layanan ?? '-' }}</td>
                        <td>
                            @switch($layanan->status)
                                @case('menunggu')
                                    <span class="badge bg-secondary">Menunggu</span>
                                    @break
                                @case('diproses')
                                    <span class="badge bg-warning text-dark">Diproses</span>
                                    @break
                                @case('selesai')
                                    <span class="badge bg-success">Selesai</span>
                                    @break
                                @default
                                    <span class="badge bg-light text-dark">Tidak diketahui</span>
                            @endswitch
                        </td>
                        <td>{{ $layanan->updated_at->format('d-m-Y H:i') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6">Belum ada data layanan.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
