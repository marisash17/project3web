<?php

namespace App\Http\Controllers;

use App\Models\Notifikasi;

class AdminNotifikasiController extends Controller
{
    public function index()
    {
        // Ambil notifikasi terbaru
        $notifikasis = Notifikasi::latest()->get();

        return view('admin.notifikasi.index', compact('notifikasis'));
    }

    public function read($id)
    {
        $notifikasis = Notifikasi::findOrFail($id);
        $notifikasis->update(['is_read' => true]);

        return redirect()->back()->with('success', 'Notifikasi telah ditandai sebagai dibaca.');
    }

    public function destroy($id)
{
    Notifikasi::findOrFail($id)->delete();

    return redirect()->back()->with('success', 'Notifikasi berhasil dihapus!');
}

}
