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
    $query->where(function ($q) use ($search) {
        $q->whereHas('user', function ($q1) use ($search) {
            $q1->where('name', 'like', "%$search%");
        })
        ->orWhereHas('layanan', function ($q2) use ($search) {
            $q2->where('jenis_layanan', 'like', "%$search%");
        });
    });
}


        $pemesanans = $query->orderBy('created_at', 'desc')->paginate(10);

        return view('admin.statuslayanan.index', compact('pemesanans'));
    }

    public function getPekerjaanBaru()
{
    $user = auth()->user();

    // Pastikan user punya data teknisi
    if (!$user->teknisi) {
        return response()->json([
            'success' => false,
            'message' => 'Data teknisi tidak ditemukan untuk user ini'
        ]);
    }

    $teknisi = $user->teknisi; // AMBIL teknisi.id BUKAN user.id

    $orders = Pemesanan::with(['user', 'layanan'])
        ->where('teknisi_id', $teknisi->id)   // INI ID TEKNISIS
        ->where('status', 'Ditugaskan')
        ->latest()
        ->get();

    return response()->json([
        'success' => true,
        'data' => $orders
    ]);
}





public function terimaPekerjaan($id)
{
    $p = Pemesanan::findOrFail($id);
    $p->status = 'Dikerjakan';
    $p->save();

    return response()->json(['success' => true]);
}

public function selesaiPekerjaan($id)
{
    $p = Pemesanan::findOrFail($id);
    $p->status = 'Selesai';
    $p->save();

    return response()->json(['success' => true]);
}

}