<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LayananController;
use App\Http\Controllers\TeknisiController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PemesananController;
use App\Http\Controllers\NotifikasiController;
use App\Http\Controllers\PendapatanController;
use App\Http\Controllers\StatusLayananController;


Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.process');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/', function () {
    return redirect()->route('login');
});

// Group admin (harus login dulu)
Route::prefix('admin')->middleware('auth')->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

    // CRUD Customer
    Route::resource('customers', CustomerController::class);
    Route::get('/customers', [CustomerController::class, 'index'])->name('admin.customers.index');
    Route::get('/customers/create', [CustomerController::class, 'create'])->name('admin.customers.create');
    Route::post('/customers', [CustomerController::class, 'store'])->name('admin.customers.store');
    Route::get('/customers/{id}/edit', [CustomerController::class, 'edit'])->name('admin.customers.edit');
    Route::put('/customers/{id}', [CustomerController::class, 'update'])->name('admin.customers.update');
    Route::delete('/customers/{id}', [CustomerController::class, 'destroy'])->name('admin.customers.destroy');
});

    Route::prefix('admin')->name('admin.')->group(function () {
    Route::resource('teknisi', TeknisiController::class)->names('admin.teknisi');
    Route::resource('teknisi', TeknisiController::class);
    Route::resource('layanan', LayananController::class);
    Route::resource('notifikasi', NotifikasiController::class);
    
     Route::get('/pesanan', [StatusLayananController::class, 'index'])
        ->name('statuslayanan.index');


    Route::resource('pendapatan', PendapatanController::class);
});

 
Route::get('/midtrans/finish', function () {
    // bisa redirect ke halaman Flutter dengan deep link
    return redirect('myapp://riwayat-pemesanan');
});

Route::get('/midtrans/error', function () {
    return redirect('myapp://pembayaran-gagal');
});

Route::get('/midtrans/unfinish', function () {
    return redirect('myapp://pembayaran-batal');
});

Route::get('/admin/statuslayanan/{id}/edit', [PemesananController::class, 'edit'])->name('admin.statuslayanan.edit');
Route::post('/admin/statuslayanan/{id}/assign-teknisi', [PemesananController::class, 'assignTeknisi'])->name('admin.statuslayanan.assign');

