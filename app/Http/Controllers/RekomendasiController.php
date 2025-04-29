<?php

namespace App\Http\Controllers;

use App\Models\Rekomendasi;
use Illuminate\Http\Request;

class RekomendasiController extends Controller
{
    public function index()
    {
        $rekomendasis = Rekomendasi::with(['ide', 'analisis'])->get();
        return response()->json($rekomendasis);
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_ide' => 'required|exists:ides,id',
            'id_analisis' => 'required|exists:analisis,id',
            'skor_relavansi' => 'required|numeric'
        ]);

        $rekomendasi = Rekomendasi::create($request->all());
        return response()->json($rekomendasi, 201);
    }

    public function show($id)
    {
        $rekomendasi = Rekomendasi::with(['ide', 'analisis'])->findOrFail($id);
        return response()->json($rekomendasi);
    }

    public function update(Request $request, $id)
    {
        $rekomendasi = Rekomendasi::findOrFail($id);
        
        $request->validate([
            'id_ide' => 'exists:ides,id',
            'id_analisis' => 'exists:analisis,id',
            'skor_relavansi' => 'numeric'
        ]);

        $rekomendasi->update($request->all());
        return response()->json($rekomendasi);
    }

    public function destroy($id)
    {
        $rekomendasi = Rekomendasi::findOrFail($id);
        $rekomendasi->delete();
        return response()->json(null, 204);
    }
}