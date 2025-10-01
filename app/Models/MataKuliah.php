<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MataKuliah extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'kode_mk',
        'nama_mk',
        'jurusan',
        'dosenPengampu'
    ];

    protected $table = 'table_matakuliah';

    public function Dosen() {
        return $this->belongTo(Dosen::class, 'dosenPengampu');
    }
}
