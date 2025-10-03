<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::table('teknisis', function (Blueprint $table) {
        // kosongkan, karena sudah ada
    });
}

public function down()
{
    Schema::table('teknisis', function (Blueprint $table) {
        // kalau mau rollback, bisa drop kolom
        // $table->dropColumn('no_telepon');
    });
}


};
