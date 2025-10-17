<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pesanan;

class PesananController extends Controller
{
    /**
     * Tampilkan riwayat semua pesanan (hanya lihat).
     */
    public function index()
    {
        // Ambil semua pesanan urut dari terbaru
        $pesanan = Pesanan::latest()->get();

        return view('admin.pesanan.index', compact('pesanan'));
    }
}
