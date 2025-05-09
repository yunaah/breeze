<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use Illuminate\Http\Request;

class MahasiswaController extends Controller
{
    public function index()
    {
        $mahasiswa = Mahasiswa::all();
        return view('dashboard', compact('mahasiswa'));
    }

    public function create()
    {
        return view('mahasiswa.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nim' => 'required|unique:mahasiswa',
            'nama' => 'required'
        ]);

        Mahasiswa::create($request->all());
        return redirect()->route('dashboard')->with('success', 'Data berhasil ditambahkan');
    }

    public function edit($id)
    {
        $mhs = Mahasiswa::findOrFail($id);
        return view('dashboard', compact('mhs'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nim' => 'required',
            'nama' => 'required'
        ]);

        $mhs = Mahasiswa::findOrFail($id);
        $mhs->update($request->all());

        return redirect()->route('dashboard')->with('success', 'Data berhasil diperbarui');
    }

    public function destroy($id)
    {
        $mhs = Mahasiswa::findOrFail($id);
        $mhs->delete();

        return redirect()->route('dashboard')->with('success', 'Data berhasil dihapus');
    }
}
