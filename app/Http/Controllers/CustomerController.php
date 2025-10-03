<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $customers = Customer::when($search, function($query, $search) {
            return $query->where('nama', 'like', "%{$search}%")
                         ->orWhere('email', 'like', "%{$search}%")
                         ->orWhere('no_telepon', 'like', "%{$search}%");
        })->paginate(10);

        return view('admin.customers.index', compact('customers'));
    }

    public function create()
    {
        return view('admin.customers.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string',
            'no_telepon' => 'required|string|max:15',
            'jenis_kelamin' => 'required',
            'email' => 'required|email|unique:customers,email',
        ]);

        Customer::create($request->only([
            'nama', 'alamat', 'no_telepon', 'jenis_kelamin', 'email'
        ]));

        return redirect()->route('admin.customers.index')->with('success', 'Customer berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $customer = Customer::findOrFail($id);
        return view('admin.customers.edit', compact('customer'));
    }

    public function update(Request $request, $id)
    {
        $customer = Customer::findOrFail($id);

        $request->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string',
            'no_telepon' => 'required|string|max:15',
            'jenis_kelamin' => 'required',
            'email' => 'required|email|unique:customers,email,' . $customer->id,
        ]);

        $customer->update($request->only([
            'nama', 'alamat', 'no_telepon', 'jenis_kelamin', 'email'
        ]));

        return redirect()->route('admin.customers.index')->with('success', 'Customer berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $customer = Customer::findOrFail($id);
        $customer->delete();

        return redirect()->route('admin.customers.index')->with('success', 'Customer berhasil dihapus!');
    }
}
