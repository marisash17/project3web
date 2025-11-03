<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Jalankan migration.
     */
    public function up(): void
    {
        Schema::table('pemesanans', function (Blueprint $table) {
            // ✅ Tambah kolom metode_pembayaran setelah total_harga
            $table->string('metode_pembayaran')->nullable()->after('total_harga');
        });
    }

    /**
     * Rollback migration.
     */
    public function down(): void
    {
        Schema::table('pemesanans', function (Blueprint $table) {
            $table->dropColumn('metode_pembayaran');
        });
    }
};
