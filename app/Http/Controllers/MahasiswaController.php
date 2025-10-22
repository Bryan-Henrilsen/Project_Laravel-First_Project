<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use Illuminate\Http\Request;

class MahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $mahasiswas = \App\Models\Mahasiswa::with('matakuliah')->get();
        return view('IndexMahasiswa', compact('mahasiswas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $matakuliah = \App\Models\MataKuliah::all();
        return view('CreateMahasiswa', compact('matakuliah'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'NIM'           => 'required|unique:table_mahasiswa',
            'name'          => 'required',
            'tempat_lahir'  => 'required',
            'tanggal_lahir' => 'required',
            'jurusan'       => 'required',
            'angkatan'      => 'required',
            'max_sks'       => 'required|numeric|min:1',
            'matakuliah_id' => 'array', 
        ]);

        // Menghitung total SKS dari mata kuliah yang dipilih
        $totalSks = 0;
        if($request->has('matakuliah_id')) {
            $totalSks = \App\Models\MataKuliah::whereIn('id', $request->matakuliah_id)->sum('sks');
        }
        
        // Validasi apakah total sks melebih max sks
        if($totalSks > $request->max_sks) {
            return back()
            ->withErrors(['matakuliah_id' => 'Total SKS yang diambil (' . $totalSks . ') melebihi batas maksimum (' . $request->max_sks . ')'])
            ->withInput();
        }

        // Simpan Data Mahasiswa tanpa mata kuliah
        $mahasiswa = \App\Models\Mahasiswa::create($request->except('matakuliah_id'));

        // Simpan relasi many-to-many
        if($request->has('matakuliah_id')) {
            $mahasiswa->matakuliah()->attach($request->matakuliah_id);
        }

        return redirect('/mahasiswa')->with('success', 'Mahasiswa dan Mata Kuliah Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Mahasiswa $mahasiswa)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $mahasiswa = \App\Models\Mahasiswa::findOrFail($id);
        $matakuliah = \App\Models\MataKuliah::all();

        return view('CreateMahasiswa', compact('mahasiswa', 'matakuliah'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $mahasiswa = \App\Models\Mahasiswa::findOrFail($id);

        $request->validate([
            'NIM'           => 'required|unique:table_mahasiswa,NIM,' . $id,
            'name'          => 'required',
            'tempat_lahir'  => 'required',
            'tanggal_lahir' => 'required',
            'jurusan'       => 'required',
            'angkatan'      => 'required',
            'max_sks'       => 'required|integer|min:1',
            'matakuliah_id' => 'required|array',
        ]);

        // Hitung total sks berdasarkan mata kuliah yang dipilih
        $totalSks = 0;
        if($request->has('matakuliah_id')) {
            $totalSks = \App\Models\MataKuliah::whereIn('id', $request->matakuliah_id)->sum('sks');
        }
        
        // Validasi apakah total sks melebihi max sks
        if($totalSks > $request->max_sks) {
            return back()
            ->withErrors(['matakuliah_id' => 'Total SKS yang diambil (' . $totalSks . ') melebihi batas maksimum (' . $request->max_sks . ')'])
            ->withInput();
        }

        $mahasiswa->update([
            'NIM'           => $request->NIM,
            'name'          => $request->name,
            'tempat_lahir'  => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'jurusan'       => $request->jurusan,
            'angkatan'      => $request->angkatan,
            'max_sks'       => $request->max_sks,
        ]);
        
        // Update relasi many-to-many (sinkronisasi matakuliah)
        if($request->has('matakuliah_id')) {
            $mahasiswa->matakuliah()->sync($request->matakuliah_id);
        } else {
            $mahasiswa->matakuliah()->detach();
        }

        return redirect('/mahasiswa')->with('success','Data Mahasiswa berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $mahasiswa = Mahasiswa::findOrFail($id);
        $mahasiswa->delete();

        return redirect('/mahasiswa')->with('success','Data Mahasiswa berhasil dihapus.');
    }
}
