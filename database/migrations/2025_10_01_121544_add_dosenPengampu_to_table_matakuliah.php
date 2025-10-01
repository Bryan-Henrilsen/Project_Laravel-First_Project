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
        Schema::table('table_matakuliah', function (Blueprint $table) {
            $table->unsignedInteger('dosenPengampu')->default(1)->after('jurusan');

            $table->foreign('dosenPengampu')
                  ->references('id')
                  ->on('table_dosen')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('table_matakuliah', function (Blueprint $table) {
            $table->dropForeign(['dosenPengampu']);
            $table->dropColumn('dosenPengampu');
        });
    }
};
