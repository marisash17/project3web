<?php

namespace App\Http\Controllers;

use App\Models\Teknisi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApiTeknisiController extends Controller
{
    // 🔸 Daftar sebagai teknisi (khusus user yang login dari Flutter)
    public function register(Request $request)
{
    $request->validate([
        'nama' => 'required|string|max:255',
        'alamat' => 'required|string|max:255',
        'jenis_kelamin' => 'required|string|max:20',
        'telepon' => 'required|string',
        'keahlian' => 'required|string',
    ]);

    $user = Auth::user();

    // Cek apakah sudah terdaftar
    if (Teknisi::where('user_id', $user->id)->exists()) {
        return response()->json([
            'message' => 'Anda sudah terdaftar sebagai teknisi'
        ], 400);
    }

    $teknisi = Teknisi::create([
        'user_id' => $user->id,
        'nama' => $request->nama,
        'alamat' => $request->alamat,
        'jenis_kelamin' => $request->jenis_kelamin,
        'telepon' => $request->telepon,
        'keahlian' => $request->keahlian,
    ]);

    return response()->json([
        'message' => 'Pendaftaran teknisi berhasil',
        'teknisi' => $teknisi,
    ], 201);
}

    // 🔸 Ambil profil lengkap user + teknisi
    public function profile()
    {
        $user = Auth::user();
        $teknisi = Teknisi::where('user_id', $user->id)->first();

        return response()->json([
            'user' => $user,
            'teknisi' => $teknisi,
        ]);
    }
}
