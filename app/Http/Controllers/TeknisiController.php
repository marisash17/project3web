<?php

namespace App\Http\Controllers;

use App\Models\Teknisi;
use App\Models\User;
use Illuminate\Http\Request;

class TeknisiController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $teknisi = Teknisi::with('user')
            ->when($search, function ($query, $search) {
                return $query->whereHas('user', function ($q) use ($search) {
                    $q->where('name', 'like', "%$search%")
                      ->orWhere('email', 'like', "%$search%");
                })
                ->orWhere('keahlian', 'like', "%$search%")
                ->orWhere('pengalaman', 'like', "%$search%");
            })
            ->paginate(10);

        return view('admin.teknisi.index', compact('teknisi'));
    }


    public function create()
    {
        // Ambil user yang BELUM daftar teknisi
        $users = User::doesntHave('teknisi')->get();

        return view('admin.teknisi.create', compact('users'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'keahlian' => 'required',
            'pengalaman' => 'required',
            'sertifikat' => 'nullable|file|mimes:jpg,png,pdf'
        ]);

        $path = null;
        if ($request->hasFile('sertifikat')) {
            $path = $request->file('sertifikat')->store('sertifikat', 'public');
        }

        Teknisi::create([
            'user_id' => $request->user_id,
            'keahlian' => $request->keahlian,
            'pengalaman' => $request->pengalaman,
            'sertifikat' => $path,
        ]);

        return redirect()
            ->route('admin.teknisi.index')
            ->with('success', 'Teknisi berhasil ditambahkan!');
    }


    public function edit(Teknisi $teknisi)
    {
        return view('admin.teknisi.edit', compact('teknisi'));
    }


    public function update(Request $request, Teknisi $teknisi)
    {
        $request->validate([
            'keahlian' => 'required',
            'pengalaman' => 'required',
            'sertifikat' => 'nullable|file|mimes:jpg,png,pdf'
        ]);

        if ($request->hasFile('sertifikat')) {
            $path = $request->file('sertifikat')->store('sertifikat', 'public');
            $teknisi->sertifikat = $path;
        }

        $teknisi->keahlian = $request->keahlian;
        $teknisi->pengalaman = $request->pengalaman;
        $teknisi->save();

        return redirect()
            ->route('admin.teknisi.index')
            ->with('success', 'Data teknisi berhasil diperbarui!');
    }


    public function destroy(Teknisi $teknisi)
    {
        $teknisi->delete();

        return redirect()
            ->route('admin.teknisi.index')
            ->with('success', 'Teknisi berhasil dihapus!');
    }

    public function show(Teknisi $teknisi)
    {
        return view('admin.teknisi.show', compact('teknisi'));
    }

}
