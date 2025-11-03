<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Midtrans\Snap;
use Midtrans\Config;

class MidtransController extends Controller
{
    public function getSnapToken(Request $request)
{
            \Midtrans\Config::$serverKey = config('midtrans.server_key');
            \Midtrans\Config::$isProduction = false;
            \Midtrans\Config::$isSanitized = true;
            \Midtrans\Config::$is3ds = true;

            if (!$request->has('total_harga')) {
                return response()->json([
                    'success' => false,
                    'message' => 'Total harga tidak ditemukan.',
                ], 400);
            }

            // Buat order ID unik
            $orderId = uniqid();

            // ✅ URL redirect (ubah sesuai yang kamu mau)
            $baseUrl = config('app.url');

            $params = [
                'transaction_details' => [
                    'order_id' => $orderId,
                    'gross_amount' => (int) $request->total_harga,
                ],
                'customer_details' => [
                    'first_name' => $request->nama ?? 'Customer',
                    'email' => $request->email ?? 'no-email@example.com',
                    'phone' => $request->no_hp ?? '0000000000',
                ],
                // ✅ Tambahkan URL redirect
                'callbacks' => [
                    'finish' => 'myapp://riwayat-pemesanan',
                    'error' => $baseUrl . '/midtrans/error',
                    'unfinish' => $baseUrl . '/midtrans/unfinish',
                ],
            ];

            try {
                $snapToken = \Midtrans\Snap::getSnapToken($params);

                return response()->json([
                    'success' => true,
                    'token' => $snapToken,
                ]);
            } catch (\Exception $e) {
                return response()->json([
                    'success' => false,
                    'message' => 'Gagal membuat Snap Token: ' . $e->getMessage(),
                ], 500);
            }
        }

}
