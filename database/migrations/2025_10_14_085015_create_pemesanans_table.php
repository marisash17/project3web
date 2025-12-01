<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pemesanans', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('teknisi_id')->nullable()->constrained('teknisis')->onDelete('set null');

            $table->dateTime('tanggal_pemesanan')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->dateTime('jadwal_service')->nullable();

            $table->decimal('total_harga', 12, 2)->default(0);

            $table->enum('status', ['Diproses', 'Dikerjakan', 'Selesai', 'Ditugaskan'])
                ->default('Diproses');

            $table->text('catatan')->nullable(); 
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pemesanans');
    }
};