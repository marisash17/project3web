<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Teknisi;
use App\Models\Layanan;
use App\Models\Notifikasi;
use App\Models\Pendapatan;

class DashboardController extends Controller
{
    public function index()
    {
        $totalCustomers  = Customer::count();
        $totalTeknisi    = Teknisi::count();
        $totalLayanan    = Layanan::count();
        $totalNotifikasi = Notifikasi::count();
        $totalPendapatan = Pendapatan::sum('jumlah'); // ganti "jumlah" sesuai kolom pendapatan di database

        return view('admin.dashboard', compact(
            'totalCustomers',
            'totalTeknisi',
            'totalLayanan',
            'totalNotifikasi',
            'totalPendapatan'
        ));
    }
}


