<?php

namespace App\Http\Controllers;

use App\Models\MataKuliah;
use Illuminate\Http\Request;

class MataKuliahController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('IndexMataKuliah', ['matakuliah' => MataKuliah::all()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('CreateMataKuliah');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'kode_mk' => 'required|unique:table_matakuliah',
            'nama_mk' => 'required',
            'jurusan' => 'required',
        ]);

        \App\Models\MataKuliah::create($request->all());
        return redirect('/matakuliah')->with('success', 'Mata Kuliah berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $matakuliah = MataKuliah::findOrFail($id);
        return view('CreateMataKuliah', compact('matakuliah'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $matakuliah = MataKuliah::findOrFail($id);
        $request->validate([
            'kode_mk'       => 'required|unique:table_matakuliah,kode_mk,' . $id,
            'nama_mk'       => 'required',
            'jurusan'       => 'required',
        ]);

        $matakuliah->update($request->all());
        return redirect('/matakuliah')->with('success','Data Mata Kuliah berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $matakuliah = MataKuliah::findOrFail($id);
        $matakuliah->delete();

        return redirect('/matakuliah')->with('success', 'Mata Kuliah berhasil dihapus');
    }
}
