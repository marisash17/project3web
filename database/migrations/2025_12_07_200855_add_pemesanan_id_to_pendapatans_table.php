<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('pendapatans', function (Blueprint $table) {

            // Tambah hanya kolom yang belum ada
            if (!Schema::hasColumn('pendapatans', 'pemesanan_id')) {
                $table->unsignedBigInteger('pemesanan_id')->nullable()->after('customer_id');
                $table->foreign('pemesanan_id')->references('id')->on('pemesanans')->onDelete('cascade');
            }
        });
    }

    public function down(): void
    {
        Schema::table('pendapatans', function (Blueprint $table) {
            if (Schema::hasColumn('pendapatans', 'pemesanan_id')) {
                $table->dropForeign(['pemesanan_id']);
                $table->dropColumn('pemesanan_id');
            }
        });
    }
};
