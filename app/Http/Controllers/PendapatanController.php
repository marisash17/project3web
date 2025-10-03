<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pendapatan;
use Carbon\Carbon;

class PendapatanController extends Controller
{
    /**
     * Menampilkan daftar pendapatan
     */
    public function index(Request $request)
    {
        // Ambil input bulan (format: YYYY-MM)
        $bulan = $request->input('bulan');

        // Query data pendapatan
        $query = Pendapatan::query();

        // Jika ada filter bulan
        if ($bulan) {
            $query->whereMonth('tanggal', Carbon::parse($bulan)->month)
                  ->whereYear('tanggal', Carbon::parse($bulan)->year);
        }

        // Ambil data dengan relasi customer & layanan
        $pendapatans = $query->with(['customer', 'layanan'])->get();

        // Hitung total pendapatan
        $totalPendapatan = $pendapatans->sum('jumlah');

        // Kirim data ke view
        return view('admin.pendapatan.index', [
            'pendapatans'     => $pendapatans,
            'totalPendapatan' => $totalPendapatan,
            'bulan'           => $bulan
        ]);
    }
}
