<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dosen;

class DosenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('IndexDosen', ['dosens' => Dosen::all()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('CreateDosen');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nip'                       => 'required|unique:table_dosen',
            'nama'                      => 'required',
            'jurusan'                   => 'required',
            'pendidikanTerakhir'        => 'required',
        ]);

        \App\Models\Dosen::create($request->all());

        return redirect('/dosen')->with('success', 'Dosen Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $dosen = Mahasiswa::findOrFail($id);
        return view('CreateDosen', compact('dosen'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $dosen = Dosen::findOrFail($id);
        $request->validate([
            'nip'                           => 'required|unique:table_dosen,nip,' . $id,
            'nama'                          => 'required',
            'jurusan'                       => 'required',
            'pendidikanTerakhir'            => 'required',
        ]);

        $dosen->update($request->all());
        return redirect('/dosen')->with('success','Data Dosen berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $dosen = Dosen::findOrFail($id);
        $dosen->delete();

        return redirect('/dosen')->with('success','Data Dosen berhasil dihapus.');
    }
}
