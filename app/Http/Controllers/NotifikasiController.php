<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Notifikasi;
use Illuminate\Http\Request;

class NotifikasiController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $notifikasis = Notifikasi::when($search, function($query, $search){
            return $query->where('judul', 'like', "%$search%")
                         ->orWhere('pesan', 'like', "%$search%");
        })->paginate(10);

        return view('admin.notifikasi.index', compact('notifikasis'));
    }

    public function create()
    {
        return view('admin.notifikasi.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'pesan' => 'required|string',
            'status' => 'required|in:Belum Dibaca,Sudah Dibaca',
        ]);

        Notifikasi::create($request->all());
        return redirect()->route('admin.notifikasi.index')->with('success', 'Notifikasi berhasil ditambahkan');
    }

    public function edit(Notifikasi $notifikasi)
    {
        return view('admin.notifikasi.edit', compact('notifikasi'));
    }

    public function update(Request $request, Notifikasi $notifikasi)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'pesan' => 'required|string',
            'status' => 'required|in:Belum Dibaca,Sudah Dibaca',
        ]);

        $notifikasi->update($request->all());
        return redirect()->route('admin.notifikasi.index')->with('success', 'Notifikasi berhasil diperbarui');
    }

    public function destroy(Notifikasi $notifikasi)
    {
        $notifikasi->delete();
        return redirect()->route('admin.notifikasi.index')->with('success', 'Notifikasi berhasil dihapus');
    }
}
