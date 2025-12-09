<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PendapatanController extends Controller
{
    public function index(Request $request)
    {
        $bulan = $request->get('bulan'); // format optional: YYYY-MM

        $query = DB::table('teknisis')
            ->leftJoin('users', 'users.id', '=', 'teknisis.user_id')
            ->leftJoin('pemesanans', function ($join) {
                $join->on('pemesanans.teknisi_id', '=', 'teknisis.id')
                     ->where('pemesanans.status', 'Selesai');
            });

        // Jika ada filter bulan, lakukan di sini — parsing dilakukan DI DALAM closure
        $query->when($bulan, function ($q, $bulan) {
            // validasi sederhana: pastikan format YYYY-MM
            if (strpos($bulan, '-') !== false) {
                [$tahun, $bulanAngka] = explode('-', $bulan);
                $q->whereYear('pemesanans.created_at', $tahun)
                  ->whereMonth('pemesanans.created_at', $bulanAngka);
            }
        });

        // Data pendapatan per teknisi
        $pendapatanPerTeknisi = $query->selectRaw('
                teknisis.id,
                users.name AS nama,
                teknisis.keahlian,
                COUNT(pemesanans.id) AS total_transaksi,
                COALESCE(SUM(pemesanans.total_harga), 0) AS total_pendapatan
            ')
            ->groupBy('teknisis.id', 'users.name', 'teknisis.keahlian')
            ->get();

        // Total pendapatan semua teknisi (ditotal dari pemesanans.total_harga)
        $totalPendapatan = DB::table('pemesanans')
            ->where('status', 'Selesai')
            ->when($bulan, function ($q, $bulan) {
                if (strpos($bulan, '-') !== false) {
                    [$tahun, $bulanAngka] = explode('-', $bulan);
                    $q->whereYear('created_at', $tahun)
                      ->whereMonth('created_at', $bulanAngka);
                }
            })
            ->sum('total_harga');

        return view('admin.pendapatan.index', [
            'pendapatanPerTeknisi' => $pendapatanPerTeknisi,
            'totalPendapatan'      => $totalPendapatan,
        ]);
    }
}
