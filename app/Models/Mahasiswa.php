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
        'angkatan'
    ];

    protected $table = 'table_mahasiswa';
}
