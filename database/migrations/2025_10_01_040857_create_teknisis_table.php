<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('teknisis', function (Blueprint $table) {
            $table->id();

            // 🔗 Relasi ke tabel users
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');

            // 📋 Data teknisi lengkap
            $table->string('nama');
            $table->string('alamat');
            $table->string('jenis_kelamin', 20);
            $table->string('telepon');
            $table->string('keahlian');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('teknisis');
    }
};
