<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{

    public $timestamps = false; // Eloquent Laravel secara otomatis menambahkan kolom created_at dan updated_at setiap kali melakukan insert atau update.

    protected $fillable = [
        'NIM',
        'name',
        'tempat_lahir',
        'tanggal_lahir',
        'jurusan',
        'max_sks',
        'angkatan'
    ];

    protected $table = 'table_mahasiswa';

    public function mataKuliah() {
        return $this->belongsToMany(Mahasiswa::class, 'mahasiswa_matakuliah', 'mahasiswa_id', 'matakuliah_id');
    }
}
