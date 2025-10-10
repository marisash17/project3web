<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('teknisis', function (Blueprint $table) {
            // ✅ relasi ke user
            if (!Schema::hasColumn('teknisis', 'user_id')) {
                $table->foreignId('user_id')->after('id')->constrained('users')->onDelete('cascade');
            }

            // ✅ keahlian teknisi
            if (!Schema::hasColumn('teknisis', 'keahlian')) {
                $table->string('keahlian')->nullable()->after('no_telepon');
            }
        });
    }

    public function down(): void
    {
        Schema::table('teknisis', function (Blueprint $table) {
            if (Schema::hasColumn('teknisis', 'user_id')) {
                $table->dropForeign(['user_id']);
                $table->dropColumn('user_id');
            }

            if (Schema::hasColumn('teknisis', 'keahlian')) {
                $table->dropColumn('keahlian');
            }
        });
    }
};
