<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Teknisi;
use App\Models\Pendapatan;
use Illuminate\Http\Request;

class PendapatanController extends Controller
{
    /**
     * Menampilkan daftar pendapatan
     */
    public function index(Request $request)
{
    $bulan = $request->bulan; // format: 2024-11

    $query = Teknisi::leftJoin('users', 'users.id', '=', 'teknisis.user_id')
        ->leftJoin('pendapatans', 'pendapatans.teknisi_id', '=', 'teknisis.id');

    // Jika admin memilih bulan tertentu
    if ($bulan) {
        [$tahun, $bulanAngka] = explode('-', $bulan);

        $query->whereYear('pendapatans.created_at', $tahun)
              ->whereMonth('pendapatans.created_at', $bulanAngka);
    }

    $pendapatanPerTeknisi = $query->selectRaw('
            teknisis.id,
            users.name as nama,
            teknisis.keahlian,
            COUNT(pendapatans.id) as total_transaksi,
            COALESCE(SUM(pendapatans.jumlah), 0) as total_pendapatan
        ')
        ->groupBy('teknisis.id', 'users.name', 'teknisis.keahlian')
        ->get();

    // Filter total pendapatan seluruh teknisi berdasarkan bulan juga
    if ($bulan) {
        $totalPendapatan = Pendapatan::whereYear('created_at', $tahun)
            ->whereMonth('created_at', $bulanAngka)
            ->sum('jumlah');
    } else {
        $totalPendapatan = Pendapatan::sum('jumlah');
    }

    return view('admin.pendapatan.index', [
        'pendapatanPerTeknisi' => $pendapatanPerTeknisi,
        'totalPendapatan' => $totalPendapatan
    ]);
}

}
