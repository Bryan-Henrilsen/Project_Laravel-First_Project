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
        Schema::create('table_mataKuliah', function (Blueprint $table) {
            $table->increments('id');
            $table->string('kode_mk')->unique();
            $table->string('nama_mk');
            $table->enum('jurusan', ['Bisnis Digital', 'Sistem dan Teknologi Informasi', 'Kewirausahaan']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('table_mataKuliah');
    }
};
