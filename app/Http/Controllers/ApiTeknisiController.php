<?php

namespace App\Http\Controllers;

use App\Models\Teknisi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApiTeknisiController extends Controller
{
    // =====================================================
    // REGISTER TEKNISI
    // =====================================================
    public function register(Request $request)
    {
        $request->validate([
            'keahlian'    => 'required|string',
            'pengalaman'  => 'required|string',
            'sertifikat'  => 'nullable|file|mimes:jpg,png,pdf|max:10240', // 10MB
        ]);

        $user = Auth::user();

        // Cek apakah user sudah pernah daftar teknisi
        if (Teknisi::where('user_id', $user->id)->exists()) {
            return response()->json([
                'status'  => 'registered',
                'message' => 'Anda sudah terdaftar sebagai teknisi'
            ], 400);
        }

        // Upload sertifikat jika ada
        $sertifikatPath = null;
        if ($request->hasFile('sertifikat')) {
            $sertifikatPath = $request->file('sertifikat')->store('sertifikat', 'public');
        }

        // Simpan data teknisi
        $teknisi = Teknisi::create([
            'user_id'    => $user->id,
            'keahlian'   => $request->keahlian,
            'pengalaman' => $request->pengalaman,
            'sertifikat' => $sertifikatPath,
        ]);

        return response()->json([
            'status'  => 'registered',
            'message' => 'Pendaftaran teknisi berhasil',
            'data'    => $teknisi
        ], 201);
    }

    // =====================================================
    // CEK STATUS TEKNISI
    // =====================================================
    public function status()
    {
        $user = Auth::user();

        $teknisi = Teknisi::where('user_id', $user->id)->first();

        if ($teknisi) {
            return response()->json([
                'status' => 'registered',
                'data'   => $teknisi,
            ], 200);
        }

        return response()->json([
            'status' => 'not_registered',
        ], 200);
    }


    public function profile(Request $request)
    {
        $user = $request->user();
        $teknisi = $user->teknisi;

        if (!$teknisi) {
            return response()->json([
                'success' => false,
                'message' => 'Profil teknisi tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => [
                'id' => $teknisi->id,
                'nama' => $user->name,
                'alamat' => $user->alamat,
                'no_hp' => $user->no_hp,
                'keahlian' => $teknisi->keahlian,
                'pengalaman' => $teknisi->pengalaman,
                'sertifikat' => $teknisi->sertifikat 
                    ? asset('storage/' . $teknisi->sertifikat)
                    : null,
            ]
        ], 200);
    }


    public function updateProfile(Request $request)
    {
        $request->validate([
            'keahlian' => 'required|string',
            'pengalaman' => 'required|string',
            'sertifikat' => 'nullable|image|max:2048',
        ]);

        $teknisi = auth()->user()->teknisi;

        $teknisi->keahlian = $request->keahlian;
        $teknisi->pengalaman = $request->pengalaman;

        if ($request->hasFile('sertifikat')) {
            $path = $request->file('sertifikat')->store('sertifikat', 'public');
            $teknisi->sertifikat = $path;
        }

        $teknisi->save();

        return response()->json([
            'success' => true,
            'message' => 'Profil teknisi berhasil diperbarui',
        ]);
    }
}
