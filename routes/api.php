<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiAuthController;
use App\Http\Controllers\PemesananController;
use App\Http\Controllers\ApiLayananController;
use App\Http\Controllers\ApiTeknisiController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

Route::post('/register', [ApiAuthController::class, 'register']);
Route::post('/login', [ApiAuthController::class, 'login']);

// Tanpa login: user bisa lihat layanan
Route::get('/layanans', [ApiLayananController::class, 'index']);
Route::get('/layanans/{id}', [ApiLayananController::class, 'show']);


// 🔒 Semua route di bawah ini butuh token Sanctum
Route::middleware('auth:sanctum')->group(function () {

    // 🔹 Get data user login
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    // 🔹 Customer
    Route::post('/pemesanan', [PemesananController::class, 'store']);
    Route::get('/riwayat-pemesanan', [PemesananController::class, 'myOrders']);

    // 🔹 Teknisi
    Route::put('/pemesanan/{id}/status', [PemesananController::class, 'updateStatus']);

    // 🔹 Admin
    Route::get('/admin/pemesanan', [PemesananController::class, 'index']);

    // 🔹 Auth-related routes
    Route::get('/profile', [ApiAuthController::class, 'profile']);
    Route::post('/logout', [ApiAuthController::class, 'logout']);

    // 🔹 Teknisi tambahan
    Route::post('/teknisi/register', [ApiTeknisiController::class, 'register']);
    Route::get('/profile-teknisi', [ApiTeknisiController::class, 'profile']);
});
