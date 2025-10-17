<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Teknisi;
use App\Models\Layanan;
use App\Models\Notifikasi;
use App\Models\Pendapatan;

class DashboardController extends Controller
{
    public function index()
    {
        // Ambil hanya user dengan role 'customer'
        $totalCustomers  = User::where('role', 'customer')->count();
        $totalTeknisi    = Teknisi::count();
        $totalLayanan    = Layanan::count();
        $totalNotifikasi = Notifikasi::count();
        $totalPendapatan = Pendapatan::sum('jumlah'); // ganti kolom sesuai nama field di tabel pendapatan

        return view('admin.dashboard', compact(
            'totalCustomers',
            'totalTeknisi',
            'totalLayanan',
            'totalNotifikasi',
            'totalPendapatan'
        ));
    }
}
