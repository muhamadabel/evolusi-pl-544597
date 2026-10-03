<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Tugas;
use Illuminate\Http\Request;

class TugasApiController extends Controller
{
    /**
     * GET /api/tugas — daftar semua tugas dalam bentuk JSON.
     * Endpoint ini yang dipanggil frontend Vue lewat VITE_API_URL.
     */
    public function index()
    {
        return response()->json([
            'data' => Tugas::orderBy('created_at', 'desc')->get(),
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'selesai' => 'boolean',
        ]);

        $tugas = Tugas::create($validated);

        return response()->json(['data' => $tugas], 201);
    }

    public function show(Tugas $tuga)
    {
        return response()->json(['data' => $tuga]);
    }

    public function update(Request $request, Tugas $tuga)
    {
        $validated = $request->validate([
            'judul' => 'sometimes|required|string|max:255',
            'deskripsi' => 'nullable|string',
            'selesai' => 'boolean',
        ]);

        $tuga->update($validated);

        return response()->json(['data' => $tuga]);
    }

    public function destroy(Tugas $tuga)
    {
        $tuga->delete();

        return response()->json(null, 204);
    }
}
