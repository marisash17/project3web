<?php

namespace App\Http\Controllers;

use App\Models\Pemesanan;
use Illuminate\Http\Request;

class PemesananController extends Controller
{
    // 1️⃣ CUSTOMER: BUAT PESANAN
    public function store(Request $request)
    {
        $request->validate([
            'jadwal_service' => 'required|date',
            'total_harga' => 'required|numeric',
            'layanan_id' => 'required|exists:layanans,id',
            'metode_pembayaran' => 'required|in:Cash,Transfer',
        ]);

        $user = auth()->user();
        if (!$user) {
            return response()->json(['success' => false, 'message' => 'User belum login.'], 401);
        }

        $pemesanan = Pemesanan::create([
            'user_id' => $user->id,
            'layanan_id' => $request->layanan_id,
            'tanggal_pemesanan' => now(),
            'jadwal_service' => $request->jadwal_service,
            'total_harga' => $request->total_harga,
            'metode_pembayaran' => $request->metode_pembayaran,
            'status' => 'Diproses',
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Pesanan berhasil dibuat pada tanggal ' . now()->format('d-m-Y'),
            'data' => $pemesanan->load(['layanan', 'teknisi']),
        ]);
    }

    // 2️⃣ CUSTOMER: LIHAT RIWAYAT
        public function myOrders()
        {
            $user = auth()->user();

            if (!$user) {
                return response()->json([
                    'success' => false,
                    'message' => 'User belum login.',
                ], 401);
            }

        $orders = Pemesanan::with([
            'layanan:id,jenis_layanan',
            'teknisi:id,nama',
        ])
            ->where('user_id', $user->id)
            ->orderByDesc('created_at')
            ->get();

        return response()->json([
            'success' => true,
            'data' => $orders,
        ]);
    }

    // 3️⃣ TEKNISI: UPDATE STATUS
    public function updateStatus(Request $request, $id)
    {
        $request->validate(['status' => 'required|in:Diproses,Dikerjakan,Selesai']);

        $user = auth()->user();
        if ($user->role !== 'teknisi') {
            return response()->json(['success' => false, 'message' => 'Unauthorized'], 403);
        }

        $pemesanan = Pemesanan::findOrFail($id);
        $pemesanan->update([
            'status' => $request->status,
            'teknisi_id' => $user->id,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Status berhasil diperbarui',
            'data' => $pemesanan->load(['layanan', 'teknisi']),
        ]);
    }

    // 4️⃣ ADMIN: LIHAT SEMUA PESANAN
    public function index()
    {
        $orders = Pemesanan::with(['user', 'teknisi', 'layanan'])
            ->orderByDesc('created_at')
            ->get();

        return response()->json(['success' => true, 'data' => $orders]);
    }
}
