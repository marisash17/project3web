<?php

namespace App\Http\Controllers;

use App\Models\Layanan;
use Illuminate\Http\Request;

class LayananController extends Controller
{
    // ✅ Menampilkan daftar layanan (dengan fitur pencarian)
    public function index(Request $request)
    {
        $search = $request->input('search');
        $layanans = Layanan::when($search, function ($query, $search) {
            return $query->where('jenis_layanan', 'like', "%$search%")
                        ->orWhere('deskripsi', 'like', "%$search%");
        })->paginate(10);

        return view('admin.layanan.index', compact('layanans'));
    }

    // ✅ Halaman tambah layanan
    public function create()
    {
        return view('admin.layanan.create');
    }

    // ✅ Simpan layanan baru
    public function store(Request $request)
    {
        $request->validate([
            'jenis_layanan' => 'required|string|max:255',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'deskripsi' => 'required|string',
            'harga' => 'required|integer|min:0',
        ]);

        $data = $request->only(['jenis_layanan', 'deskripsi', 'harga']);

        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('layanan', 'public');
        }

        Layanan::create($data);

        return redirect()
            ->route('admin.layanan.index')
            ->with('success', 'Layanan berhasil ditambahkan.');
    }

    // ✅ Halaman edit layanan
    public function edit(Layanan $layanan)
    {
        return view('admin.layanan.edit', compact('layanan'));
    }

    // ✅ Update layanan
    public function update(Request $request, Layanan $layanan)
    {
        $request->validate([
            'jenis_layanan' => 'required|string|max:255',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'deskripsi' => 'required|string',
            'harga' => 'required|integer|min:0',
        ]);

        $data = $request->only(['jenis_layanan', 'deskripsi', 'harga']);

        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('layanan', 'public');
        }

        $layanan->update($data);

        return redirect()
            ->route('admin.layanan.index')
            ->with('success', 'Layanan berhasil diperbarui.');
    }

    // ✅ Hapus layanan
    public function destroy(Layanan $layanan)
    {
        $layanan->delete();

        return redirect()
            ->route('admin.layanan.index')
            ->with('success', 'Layanan berhasil dihapus.');
    }
}
