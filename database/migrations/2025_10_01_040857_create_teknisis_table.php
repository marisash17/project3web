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

            // Relasi ke users
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');

            // Data teknisi sesuai Flutter
            $table->string('keahlian');
            $table->text('pengalaman');  // minimal 1 tahun dsb
            $table->string('sertifikat')->nullable(); // file path

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('teknisis');
    }
};
