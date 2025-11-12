<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\StatusLayanan;

class ApiPemesananController extends Controller
{
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'layanan_id' => 'required',
                'jadwal_service' => 'required|date',
                'total_harga' => 'required|numeric',
                'metode_pembayaran' => 'required|string',
            ]);

            // Ambil data user login dari token
            $user = $request->user();

            // Simpan ke tabel status_layanan
            $status = StatusLayanan::create([
                'customer_name' => $user->nama ?? 'Tidak diketahui',
                'customer_phone' => $user->no_hp ?? '-',
                'service_name' => 'Service ID ' . $validated['layanan_id'],
                'technician_name' => null,
                'status' => 'Diproses',
                'total_amount' => $validated['total_harga'],
                'created_at' => now(),
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Pemesanan berhasil disimpan',
                'data' => $status
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
    }
}
