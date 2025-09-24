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
        return view('IndexMahasiswa', ['mahasiswas' => Mahasiswa::all()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('CreateMahasiswa');
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
            'angkatan'       => 'required',
        ]);

        \App\Models\Mahasiswa::create($request->all());

        return redirect('/mahasiswa')->with('success', 'Mahasiswa Berhasil Ditambahkan');
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
        $mahasiswa = Mahasiswa::findOrFail($id);
        return view('CreateMahasiswa', compact('mahasiswa'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $mahasiswa = Mahasiswa::findOrFail($id);
        $request->validate([
            'NIM'           => 'required|unique:table_mahasiswa,NIM,' . $id,
            'name'          => 'required',
            'tempat_lahir'  => 'required',
            'tanggal_lahir' => 'required',
            'jurusan'       => 'required',
            'angkatan'      => 'required',
        ]);

        $mahasiswa->update($request->all());
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
