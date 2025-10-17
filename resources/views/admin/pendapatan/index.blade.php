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

    .btn-secondary {
        background-color: white;
        color: #3120CD;
        border: 1px solid #3120CD;
        transition: 0.25s ease;
    }

    .btn-secondary:hover,
    .btn-secondary:active,
    .btn-secondary:focus {
        background-color: #3120CD;
        color: white;
        border: 1px solid #3120CD;
    }

    /* Atur jarak konten dari sidebar */
.container {
    margin-left: 330px; /* kasih jarak biar ga mepet ke sidebar */
    max-width: calc(100% - 350px); /* biar kontennya tetep proporsional */
}

/* Biar halaman tetap keliatan clean */
body {
    background-color: #F5F5F5;
}

/* Responsif untuk layar kecil */
@media (max-width: 992px) {
    .container {
        margin-left: 0;
        max-width: 100%;
        padding: 20px;
    }
}

</style>

<div class="container my-4">
    <div class="card-custom">

        <!-- 🔙 Tombol Back ke Dashboard -->
        <div class="mb-3">
            <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">
                <i class="bi bi-arrow-left"></i>
            </a>
        </div>

        <!-- Judul -->
        <div class="text-center mb-4">
            <i class="bi bi-cash-coin fs-1 d-block text-custom-blue"></i>
            <h3 class="fw-bold text-custom-blue">Kelola Transaksi</h3>
        </div>

        <!-- Total Pendapatan -->
        <div class="total-box">
            Total Transaksi <br>
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
