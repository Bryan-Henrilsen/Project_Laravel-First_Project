<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dosen extends Model
{
    public $timestamps = false; // Eloquent Laravel secara otomatis menambahkan kolom created_at dan updated_at setiap kali melakukan insert atau update.

    protected $fillable = [
        'nip',
        'nama',
        'jurusan',
        'pendidikanTerakhir'
    ];

    protected $table = 'table_dosen';

    public function mataKuliah() {
        return $this->hasMany(MataKuliah::class, 'dosenPengampu');
    }
}
