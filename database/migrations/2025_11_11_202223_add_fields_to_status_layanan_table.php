<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('status_layanan', function (Blueprint $table) {
            $table->string('customer_name')->nullable()->after('customer_id');
            $table->string('customer_phone')->nullable()->after('customer_name');
            $table->string('service_name')->nullable()->after('customer_phone');
            $table->string('technician_name')->nullable()->after('teknisi_id');
            $table->integer('total_amount')->nullable()->after('status');
            $table->timestamp('jadwal_service')->nullable()->after('tanggal_pemesanan');
        });
    }

    public function down(): void
    {
        Schema::table('status_layanan', function (Blueprint $table) {
            $table->dropColumn([
                'customer_name',
                'customer_phone',
                'service_name',
                'technician_name',
                'total_amount',
                'jadwal_service',
            ]);
        });
    }
};
