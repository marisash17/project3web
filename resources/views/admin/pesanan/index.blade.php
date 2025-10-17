@extends('layouts.app')

@section('title', 'Riwayat Pesanan')

@section('content')
<style>
    body {
        background-color: #f7f7fb;
    }

    .riwayat-container {
        background: #fff;
        border-radius: 10px;
        padding: 40px;
        margin: 30px auto;
        width: 95%;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
    }

    .riwayat-header {
        text-align: center;
        color: #2E1F8F;
        font-size: 24px;
        font-weight: 700;
        margin-bottom: 25px;
    }

    .riwayat-header i {
        margin-right: 8px;
    }

    .table-custom {
        width: 100%;
        border-collapse: collapse;
        margin-top: 100px;
    }

    .table-custom thead {
        background-color: #d9d6f3;
        color: #1e1e1e;
    }

    .table-custom th,
    .table-custom td {
        text-align: center;
        padding: 14px;
        border: 1px solid #e2e2e2;
        vertical-align: middle;
    }

    .table-custom tbody tr:nth-child(even) {
        background-color: #f8f7fc;
    }

    .table-custom tbody tr:hover {
        background-color: #efecfa;
        transition: 0.3s;
    }

    .no-data {
        text-align: center;
        padding: 20px;
        color: #777;
        font-style: italic;
        background-color: #fff;
    }
</style>

<div class="riwayat-container">
    <h4 class="riwayat-header">
        <i class="bi bi-clock-history"></i> Riwayat Pesanan
    </h4>

    <table class="table-custom">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Pelanggan</th>
                <th>Layanan</th>
                <th>Total Harga</th>
                <th>Status</th>
                <th>Tanggal Pesanan</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($pesanan as $index => $item)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $item->pelanggan->nama ?? '-' }}</td>
                    <td>{{ $item->layanan->nama ?? '-' }}</td>
                    <td>Rp {{ number_format($item->total_harga, 0, ',', '.') }}</td>
                    <td>{{ ucfirst($item->status) }}</td>
                    <td>{{ \Carbon\Carbon::parse($item->created_at)->format('d M Y') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="no-data">Belum ada data pesanan.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
