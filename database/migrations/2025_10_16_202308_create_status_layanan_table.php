<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('status_layanan', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customer_id')->nullable();
            $table->unsignedBigInteger('teknisi_id')->nullable();
            $table->string('status')->default('menunggu');
            $table->date('tanggal_pemesanan')->nullable();
            $table->text('catatan')->nullable();
            $table->timestamps();

            // Optional: foreign key
            // $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');
            // $table->foreign('teknisi_id')->references('id')->on('teknisis')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('status_layanan');
    }
};
