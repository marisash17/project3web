<?php

namespace App\Http\Controllers;

use App\Models\Layanan;
use Illuminate\Http\Request;

class StatusLayananController extends Controller
{
    public function index()
    {
        // Ambil semua data layanan dengan relasi customer & teknisi
        $layanans = Layanan::with(['customer', 'teknisi'])->get();

        return view('admin.statuslayanan.index', compact('layanans'));
    }
}
