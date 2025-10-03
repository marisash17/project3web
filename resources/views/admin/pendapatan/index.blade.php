@extends('layouts.app')

@section('title', 'Kelola Pendapatan')

@section('content')
<style>
    .card-custom {
        background: white;
        padding: 30px 40px;
        border-radius: 8px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.15);
        margin: auto;
    }
    .total-box {
        background-color: #3120CD;
        color: white;
        font-size: 1.5rem;
        font-weight: bold;
        text-align: center;
        padding: 20px;
        border-radius: 6px;
        margin: 20px auto;
        max-width: 300px;
    }
    .btn-filter {
        background-color: #3120CD;
        color: white;
        border: none;
        padding: 6px 15px;
        font-weight: bold;
    }
    .btn-filter:hover {
        background-color: #201090;
        color: white;
    }
    .form-control-custom {
        border: 1px solid #aaa;
        border-radius: 4px;
        padding: 6px;
    }
    .table-custom th {
        background-color: #CFCCE3;
        text-align: center;
        vertical-align: middle;
    }
    .table-custom td {
        text-align: center;
        vertical-align: middle;
    }
    .text-custom-blue {
        color: #3120CD !important;
    }
</style>

<div class="container my-4">
    <div class="card-custom">
        <!-- Judul -->
        <div class="text-center mb-4">
            <i class="bi bi-cash-coin fs-1 d-block text-custom-blue"></i>
            <h3 class="fw-bold text-custom-blue">Kelola Pendapatan</h3>
        </div>

        <!-- Total Pendapatan -->
        <div class="total-box">
            Total Pendapatan <br>
            Rp. {{ number_format($totalPendapatan, 0, ',', '.') }}
        </div>

        <!-- Filter Bulan -->
        <form action="{{ route('admin.pendapatan.index') }}" method="GET" class="d-flex justify-content-center gap-2 mb-3">
            <input type="month" name="bulan" class="form-control-custom">
            <button type="submit" class="btn btn-filter">Tampilkan</button>
        </form>

        <!-- Tabel Data -->
        <table class="table table-bordered table-custom">
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
                        <td>{{ $index + 1 }}</td>
                        <td>{{ \Carbon\Carbon::parse($p->tanggal)->translatedFormat('d F Y') }}</td>
                        <td>{{ $p->customer->nama ?? '-' }}</td>
                        <td>{{ $p->layanan->jenis_layanan ?? '-' }}</td>
                        <td>Rp. {{ number_format($p->jumlah, 0, ',', '.') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5">Belum ada data pendapatan</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
