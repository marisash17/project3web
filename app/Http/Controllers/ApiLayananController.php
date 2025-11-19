<?php

namespace App\Http\Controllers;

use App\Models\Layanan;
use Illuminate\Http\Request;

class ApiLayananController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->query('search');

        $query = Layanan::query();

        if ($search) {
            $query->where('jenis_layanan', 'like', "%$search%")
                  ->orWhere('deskripsi', 'like', "%$search%");
        }

        $layanans = $query->get()->map(function($layanan){
            return [
                'id' => $layanan->id,
                'jenis_layanan' => $layanan->jenis_layanan,
                'deskripsi' => $layanan->deskripsi,
                'harga' => (int) $layanan->harga, // ✅ hanya ini yang ditambah, biar harga dibaca integer
                'gambar' => $layanan->gambar ? asset('storage/' . $layanan->gambar) : null,
            ];
        });

        return response()->json([
            'success' => true,
            'data' => $layanans,
        ]);
    }

    public function show($id)
    {
        $layanan = Layanan::find($id);
        if (!$layanan) {
            return response()->json(['success' => false, 'message' => 'Layanan tidak ditemukan'], 404);
        }

        return response()->json([
            'success' => true,
            'data' => [
                'id' => $layanan->id,
                'jenis_layanan' => $layanan->jenis_layanan,
                'deskripsi' => $layanan->deskripsi,
                'harga' => (int) $layanan->harga, // ✅ cuma tambahin casting di sini juga
                'gambar' => $layanan->gambar ? asset('storage/' . $layanan->gambar) : null,
            ]
        ]);
    }
}
