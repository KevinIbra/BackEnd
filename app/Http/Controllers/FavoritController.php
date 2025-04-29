<?php

namespace App\Http\Controllers;

use App\Models\Favorit;
use Illuminate\Http\Request;

class FavoritController extends Controller
{
    public function index()
    {
        $favorits = Favorit::with(['user', 'ideKerajinan'])->get();
        return response()->json($favorits);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_favorit' => 'required|integer',
            'id_pengguna' => 'required|integer|exists:users,id',
            'id_ide' => 'required|integer|exists:ide_kerajinan,id'
        ]);

        $validated['waktu_simpan'] = now();

        $favorit = Favorit::create($validated);
        return response()->json($favorit, 201);
    }

    public function show($id)
    {
        try {
            $favorit = Favorit::with(['user', 'ideKerajinan'])->findOrFail($id);
            return response()->json($favorit);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Favorit not found'], 404);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $favorit = Favorit::findOrFail($id);
            
            $validated = $request->validate([
                'id_favorit' => 'sometimes|required|integer',
                'id_pengguna' => 'sometimes|required|integer|exists:users,id',
                'id_ide' => 'sometimes|required|integer|exists:ide_kerajinan,id'
            ]);

            $favorit->update($validated);
            return response()->json($favorit);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Update failed'], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $favorit = Favorit::findOrFail($id);
            $favorit->delete();
            return response()->json(null, 204);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Delete failed'], 500);
        }
    }
}