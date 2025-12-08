<?php

namespace App\Http\Controllers;

use App\Models\Pendapatan;
use Illuminate\Http\Request;
use Carbon\Carbon;


class ApiPendapatanController extends Controller
{
    // Total pendapatan bulan ini
    // Total pendapatan bulan tertentu
public function total(Request $request, $teknisiId)
{
    $month = $request->query('month'); // contoh: "09"
    $year = $request->query('year');   // contoh: "2025"

    $total = Pendapatan::where('teknisi_id', $teknisiId)
        ->when($month && $year, function ($q) use ($month, $year) {
            $q->whereMonth('tanggal', $month)
              ->whereYear('tanggal', $year);
        })
        ->sum('jumlah');

    return response()->json([
        'total_pendapatan' => $total,
    ]);
}

// Riwayat pendapatan bulan tertentu
public function riwayat(Request $request, $teknisiId)
{
    $month = $request->query('month');
    $year = $request->query('year');

    $riwayat = Pendapatan::where('teknisi_id', $teknisiId)
        ->when($month && $year, function ($q) use ($month, $year) {
            $q->whereMonth('tanggal', $month)
              ->whereYear('tanggal', $year);
        })
        ->orderBy('tanggal', 'desc')
        ->get();

    return response()->json($riwayat);
}

}
