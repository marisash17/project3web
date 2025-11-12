<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pemesanan;

class StatusLayananController extends Controller
{
    public function index(Request $request)
    {
        $query = Pemesanan::with(['user', 'layanan', 'teknisi']);

        if ($request->filled('search')) {
            $search = $request->search;
            $query->whereHas('user', function ($q) use ($search) {
                $q->where('name', 'like', "%$search%");
            })->orWhereHas('layanan', function ($q) use ($search) {
                $q->where('jenis_layanan', 'like', "%$search%");
            });
        }

        $pemesanans = $query->orderBy('created_at', 'desc')->paginate(10);

        return view('admin.statuslayanan.index', compact('pemesanans'));
    }
}
