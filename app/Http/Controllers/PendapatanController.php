<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PendapatanController extends Controller
{
    public function index(Request $request)
    {
        $bulan = $request->get('bulan'); // format: YYYY-MM (optional)

        // =======================================
        // 1. QUERY DATA PENDAPATAN PER TEKNISI
        // =======================================
        $query = DB::table('teknisis')
            ->join('users', 'users.id', '=', 'teknisis.user_id')
            ->leftJoin('pemesanans', function ($join) {
                $join->on('pemesanans.teknisi_id', '=', 'teknisis.id')
                     ->where('pemesanans.status', 'Selesai');
            });

        // Filter berdasarkan bulan
        $query->when($bulan, function ($q, $bulan) {
            if (strpos($bulan, '-') !== false) {
                [$tahun, $bulanAngka] = explode('-', $bulan);
                $q->whereYear('pemesanans.created_at', $tahun)
                  ->whereMonth('pemesanans.created_at', $bulanAngka);
            }
        });

        $pendapatanPerTeknisi = $query->selectRaw('
                teknisis.id,
                users.name AS nama,
                teknisis.keahlian,
                COUNT(pemesanans.id) AS total_transaksi,
                COALESCE(SUM(pemesanans.total_harga), 0) AS total_pendapatan
            ')
            ->groupBy('teknisis.id', 'users.name', 'teknisis.keahlian')
            ->get();

        // =======================================
        // 2. TOTAL PENDAPATAN SEMUA TEKNISI
        // (WAJIB JOIN TEKNISIS AGAR DATA SINKRON)
        // =======================================
        $totalPendapatan = DB::table('pemesanans')
            ->join('teknisis', 'teknisis.id', '=', 'pemesanans.teknisi_id')
            ->join('users', 'users.id', '=', 'teknisis.user_id')
            ->where('pemesanans.status', 'Selesai')
            ->when($bulan, function ($q, $bulan) {
                if (strpos($bulan, '-') !== false) {
                    [$tahun, $bulanAngka] = explode('-', $bulan);
                    $q->whereYear('pemesanans.created_at', $tahun)
                      ->whereMonth('pemesanans.created_at', $bulanAngka);
                }
            })
            ->sum('pemesanans.total_harga');

        return view('admin.pendapatan.index', [
            'pendapatanPerTeknisi' => $pendapatanPerTeknisi,
            'totalPendapatan'      => $totalPendapatan,
        ]);
    }
}
