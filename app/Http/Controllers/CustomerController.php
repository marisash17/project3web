<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $customers = User::where('role', 'customer')
            ->when($search, function ($query, $search) {
                return $query->where('name', 'like', "%{$search}%")
                             ->orWhere('email', 'like', "%{$search}%")
                             ->orWhere('no_hp', 'like', "%{$search}%")
                             ->orWhere('alamat', 'like', "%{$search}%");
            })
            ->paginate(10);

        return view('admin.customers.index', compact('customers'));
    }

    public function create()
    {
        // Tidak perlu buat dari sini karena customer daftar dari Flutter
        return redirect()->route('admin.customers.index');
    }

    public function store(Request $request)
    {
        // Tidak digunakan karena pendaftaran dilakukan dari Flutter
        return redirect()->route('admin.customers.index');
    }

    public function edit($id)
    {
        $customer = User::where('role', 'customer')->findOrFail($id);
        return view('admin.customers.edit', compact('customer'));
    }

    public function update(Request $request, $id)
    {
        $customer = User::where('role', 'customer')->findOrFail($id);

        $request->validate([
            'name'   => 'required|string|max:255',
            'alamat' => 'required|string',
            'no_hp'  => 'required|string|max:15',
            'gender' => 'required',
            'email'  => 'required|email|unique:users,email,' . $customer->id,
        ]);

        $customer->update($request->only([
            'name', 'alamat', 'no_hp', 'gender', 'email'
        ]));

        return redirect()->route('admin.customers.index')->with('success', 'Customer berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $customer = User::where('role', 'customer')->findOrFail($id);
        $customer->delete();

        return redirect()->route('admin.customers.index')->with('success', 'Customer berhasil dihapus!');
    }
}
