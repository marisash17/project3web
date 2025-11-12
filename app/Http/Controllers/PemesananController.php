<?php

namespace App\Http\Controllers;

use App\Models\Teknisi;
use App\Models\Pemesanan;
use Illuminate\Http\Request;
use App\Models\StatusLayanan;

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

        // 🔹 Simpan ke tabel "pemesanan"
        $pemesanan = Pemesanan::create([
            'user_id' => $user->id,
            'layanan_id' => $request->layanan_id,
            'tanggal_pemesanan' => now(),
            'jadwal_service' => $request->jadwal_service,
            'total_harga' => $request->total_harga,
            'metode_pembayaran' => $request->metode_pembayaran,
            'status' => 'Diproses',
        ]);

        // 🔹 Simpan juga ke tabel "status_layanan"
        $statusLayanan = new StatusLayanan();
        $statusLayanan->customer_id = $user->id;
        $statusLayanan->status = 'Menunggu Konfirmasi';
        $statusLayanan->tanggal_pemesanan = now();
        $statusLayanan->catatan = 'Pesanan baru dibuat';
        $statusLayanan->metode = strtolower($request->metode_pembayaran); // 🟢 "cash" / "transfer"
        $statusLayanan->save();

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

        // 🔹 Update juga status layanan
        $statusLayanan = StatusLayanan::where('customer_id', $pemesanan->user_id)->latest()->first();
        if ($statusLayanan) {
            $statusLayanan->status = $request->status;
            $statusLayanan->save();
        }

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

    public function edit($id)
        {
            $pemesanan = Pemesanan::with(['layanan', 'user', 'teknisi'])->findOrFail($id);
            $teknisis = Teknisi::all(); // ambil semua teknisi dari tabel teknisis
            return view('admin.statuslayanan.edit', compact('pemesanan', 'teknisis'));
        }

        public function assignTeknisi(Request $request, $id)
        {
            $request->validate([
                'teknisi_id' => 'required|exists:teknisis,id',
            ]);

            $pemesanan = Pemesanan::findOrFail($id);
            $pemesanan->teknisi_id = $request->teknisi_id;
            $pemesanan->status = 'Dikerjakan'; // ubah status otomatis jika perlu
            $pemesanan->save();

            return redirect()->route('admin.statuslayanan.index')->with('success', 'Teknisi berhasil ditugaskan!');
        }

}
