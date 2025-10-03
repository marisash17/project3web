<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pendapatans', function (Blueprint $table) {
            $table->id();
            $table->string('keterangan')->nullable(); // contoh: "service AC"
            $table->decimal('jumlah', 15, 2); // kolom jumlah uang
            $table->date('tanggal')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pendapatans');
    }
};
