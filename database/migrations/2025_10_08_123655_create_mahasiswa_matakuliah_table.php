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
        Schema::create('mahasiswa_matakuliah', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('mahasiswa_id');
            $table->unsignedInteger('matakuliah_id');

            $table->foreign('mahasiswa_id')
                ->references('id')
                ->on('table_mahasiswa')
                ->onDelete('cascade');

            $table->foreign('matakuliah_id')
                ->references('id')
                ->on('table_matakuliah')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mahasiswa_matakuliah');
    }
};
