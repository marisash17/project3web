<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('pemesanans', function (Blueprint $table) {
            $table->enum('status', [
                'Diproses',
                'Dikerjakan',
                'Selesai',
                'Ditugaskan',
                'Ditolak Teknisi'
            ])->default('Diproses')->change();
        });
    }

    public function down(): void
    {
        Schema::table('pemesanans', function (Blueprint $table) {
            $table->enum('status', [
                'Diproses',
                'Dikerjakan',
                'Selesai',
                'Ditugaskan'
            ])->default('Diproses')->change();
        });
    }
};
