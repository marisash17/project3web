<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
   public function up(): void
        {
            Schema::table('status_layanan', function (Blueprint $table) {
                $table->string('metode')->default('cash')->after('catatan');
            });
        }

        public function down(): void
        {
            Schema::table('status_layanan', function (Blueprint $table) {
                $table->dropColumn('metode');
            });
        }

};
