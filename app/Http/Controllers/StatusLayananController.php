<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StatusLayanan;

class StatusLayananController extends Controller
{
    /**
     * Menampilkan daftar status layanan.
     */
    public function index(Request $request)
    {
        // Ambil semua data status layanan beserta relasi customer & teknisi
        // dan tambahkan pencarian sederhana
        $query = StatusLayanan::with(['customer', 'teknisi']);

        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->whereHas('customer', function ($q) use ($search) {
                $q->where('nama', 'like', "%$search%");
            })->orWhere('layanan', 'like', "%$search%");
        }

        $pemesanans = $query->latest()->paginate(10);

        // Kirim data ke view
        return view('admin.statuslayanan.index', compact('pemesanans'));
    }
}
