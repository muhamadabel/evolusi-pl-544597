<?php

namespace App\Http\Controllers;

use App\Models\Tugas;
use Illuminate\Http\Request;

class TugasController extends Controller
{
    public function index()
    {
        $tugas = Tugas::orderBy('created_at', 'desc')->get();

        return view('tugas.index', compact('tugas'));
    }

    public function create()
    {
        return view('tugas.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
        ]);

        Tugas::create($validated + ['selesai' => false]);

        return redirect()->route('tugas.index')->with('sukses', 'Tugas berhasil ditambahkan.');
    }

    public function show(Tugas $tuga)
    {
        return view('tugas.show', compact('tuga'));
    }

    public function edit(Tugas $tuga)
    {
        return view('tugas.edit', compact('tuga'));
    }

    public function update(Request $request, Tugas $tuga)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'selesai' => 'nullable|boolean',
        ]);

        $tuga->update([
            'judul' => $validated['judul'],
            'deskripsi' => $validated['deskripsi'] ?? null,
            'selesai' => $request->boolean('selesai'),
        ]);

        return redirect()->route('tugas.index')->with('sukses', 'Tugas berhasil diperbarui.');
    }

    public function destroy(Tugas $tuga)
    {
        $tuga->delete();

        return redirect()->route('tugas.index')->with('sukses', 'Tugas berhasil dihapus.');
    }
}
