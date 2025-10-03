<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Teknisi;
use Illuminate\Http\Request;

class TeknisiController extends Controller
{
    public function index(Request $request)
{
    $search = $request->input('search');
    $teknisi = Teknisi::when($search, function ($query, $search) {
        return $query->where('nama', 'like', "%{$search}%")
                     ->orWhere('alamat', 'like', "%{$search}%")
                     ->orWhere('no_telepon', 'like', "%{$search}%")
                     ->orWhere('keahlian', 'like', "%{$search}%");
    })->paginate(10);

    return view('admin.teknisi.index', compact('teknisi'));
}


    public function create()
    {
        return view('admin.teknisi.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'alamat' => 'required',
            'no_telepon' => 'required',
            'jenis_kelamin' => 'required',
            'keahlian' => 'required',
        ]);

        Teknisi::create($request->all());
        return redirect()->route('admin.teknisi.index')->with('success', 'Teknisi berhasil ditambahkan!');
    }

    public function edit(Teknisi $teknisi)
    {
        return view('admin.teknisi.edit', compact('teknisi'));
    }

    public function update(Request $request, Teknisi $teknisi)
    {
        $request->validate([
            'nama' => 'required',
            'alamat' => 'required',
            'no_telepon' => 'required',
            'jenis_kelamin' => 'required',
            'keahlian' => 'required',
        ]);

        $teknisi->update($request->all());
        return redirect()->route('admin.teknisi.index')->with('success', 'Data teknisi berhasil diperbarui!');
    }

    public function destroy(Teknisi $teknisi)
    {
        $teknisi->delete();
        return redirect()->route('admin.teknisi.index')->with('success', 'Teknisi berhasil dihapus!');
    }
}
