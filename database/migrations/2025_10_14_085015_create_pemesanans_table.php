<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Jalankan migration.
     */
    public function up(): void
    {
        Schema::create('pemesanans', function (Blueprint $table) {
            $table->id();

            // Relasi ke tabel users (customer)
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');

            // Relasi ke tabel teknisis (kalau teknisi sudah ditentukan)
            $table->foreignId('teknisi_id')->nullable()->constrained('teknisis')->onDelete('set null');

            // Informasi pemesanan
            $table->dateTime('tanggal_pemesanan')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->dateTime('jadwal_service')->nullable(); // tanggal dan jam service
            $table->decimal('total_harga', 12, 2)->default(0);
            $table->enum('status', ['Diproses', 'Dikerjakan', 'Selesai'])->default('Diproses');

            $table->text('catatan')->nullable(); // opsional, jika customer isi catatan
            $table->timestamps();
        });
    }

    /**
     * Rollback migration.
     */
    public function down(): void
    {
        Schema::dropIfExists('pemesanans');
    }
};
