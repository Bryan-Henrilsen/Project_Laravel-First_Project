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
        'sks',
        'dosenPengampu'
    ];

    protected $table = 'table_matakuliah';

    public function dosen() {
        return $this->belongsTo(Dosen::class, 'dosenPengampu');
    }

    public function mahasiswa() {
        return $this->belongsToMany(Mahasiswa::class, 'mahasiswa_matakuliah', 'matakuliah_id', 'mahasiswa_id');
    }

    // belongsToMany(TargetModel::class, 'pivot_table', 'foreign_key_this_model', 'foreign_key_other_model')
}
