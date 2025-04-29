<?php

namespace App\Http\Controllers;

use App\Models\Analisis_Ai;
use App\Models\AnalisisAi;
use Illuminate\Http\Request;

class AnalisisController extends Controller
{
    public function index()
    {
        $analisisAi = Analisis_Ai::with('ideKerajinan')->get();
        return response()->json($analisisAi);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_analisis' => 'required|integer',
            'id_barang' => 'required|integer|exists:ide_kerajinan,id',
            'jenis_barang' => 'required|string',
            'skor_akurasi' => 'required|numeric|between:0,1'
        ]);

        $analisisAi = Analisis_Ai::create($validated);
        return response()->json($analisisAi, 201);
    }

    public function show($id)
    {
        try {
            $analisisAi = Analisis_Ai::with('ideKerajinan')->findOrFail($id);
            return response()->json($analisisAi);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Analisis AI not found'], 404);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $analisisAi = Analisis_Ai::findOrFail($id);
            
            $validated = $request->validate([
                'id_analisis' => 'sometimes|required|integer',
                'id_barang' => 'sometimes|required|integer|exists:ide_kerajinan,id',
                'jenis_barang' => 'sometimes|required|string',
                'skor_akurasi' => 'sometimes|required|numeric|between:0,1'
            ]);

            $analisisAi->update($validated);
            return response()->json($analisisAi);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Update failed'], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $analisisAi = Analisis_Ai::findOrFail($id);
            $analisisAi->delete();
            return response()->json(null, 204);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Delete failed'], 500);
        }
    }
}