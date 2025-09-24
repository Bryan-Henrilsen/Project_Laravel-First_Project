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
        Schema::create('table_mahasiswa', function (Blueprint $table) {
            $table->increments('id')->primary();
            $table->string('NIM')->unique();
            $table->string('name');
            $table->string('tempat_lahir');
            $table->string('tanggal_lahir');
            $table->enum('jurusan', ['Bisnis Digital', 'Sistem dan Teknologi Informasi', 'Kewirausahaan']);
            $table->integer('angkatan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::drop('table_mahasiswa');
    }
};
