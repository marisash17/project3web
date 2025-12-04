<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Layanan;
use App\Models\Teknisi;
use App\Models\Pemesanan;
use App\Models\Notifikasi;
use App\Models\Pendapatan;
use Illuminate\Http\Request;


class DashboardController extends Controller
{
    public function index()
    {
        // Ambil hanya user dengan role 'customer'
        $totalCustomers  = User::where('role', 'customer')->count();
        $totalTeknisi    = Teknisi::count();
        $totalLayanan    = Layanan::count();
        $totalPendapatan = Pendapatan::sum('jumlah'); // ganti kolom sesuai nama field di tabel pendapatan

        // Ambil 5 pemesanan terbaru
$recentOrders = Pemesanan::with(['user', 'layanan', 'teknisi'])
    ->orderBy('created_at', 'desc')
    ->take(5)
    ->get()
    ->map(function ($p) {
        return (object)[
            'order_number'    => $p->id,
            'status'          => $p->status ?? '-',
            'customer_name'   => $p->user->name ?? '-',
            'customer_phone'  => $p->user->phone ?? '-',
            'service_name'    => $p->layanan->jenis_layanan ?? '-',
            'technician_name' => $p->teknisi->nama ?? 'Belum Ditugaskan',
            'total_amount'    => $p->total_harga ?? 0,
            'created_at'      => $p->created_at,
        ];
    });

       return view('admin.dashboard', compact(
            'totalCustomers',
            'totalTeknisi',
            'totalLayanan',
            'totalPendapatan',
            'recentOrders' // tambahkan ini
        ));

        $notifikasis = Notifikasi::orderBy('created_at', 'desc')
        ->limit(7)
        ->get();

return view('admin.dashboard', [
    'totalCustomers' => $totalCustomers,
    'totalTeknisi' => $totalTeknisi,
    'totalPendapatan' => $totalPendapatan,
    'totalLayanan' => $totalLayanan,
    'recentOrders' => $recentOrders,
    'notifikasis' => $notifikasis,
]);

    }
}
