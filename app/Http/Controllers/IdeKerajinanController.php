<?php

namespace App\Http\Controllers;

use App\Models\IdeKerajinan;
use Illuminate\Http\Request;

class IdeKerajinanController extends Controller
{
    public function index()
    {
        $ideKerajinan = IdeKerajinan::all();
        return response()->json($ideKerajinan);
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string',
            'deskripsi' => 'required|string',
            'kategori' => 'required|string',
            'tingkat_kesulitan' => 'required|string'
        ]);

        $ideKerajinan = IdeKerajinan::create($request->all());
        return response()->json($ideKerajinan, 201);
    }

    public function show($id)
    {
        $ideKerajinan = IdeKerajinan::findOrFail($id);
        return response()->json($ideKerajinan);
    }

    public function update(Request $request, $id)
    {
        $ideKerajinan = IdeKerajinan::findOrFail($id);
        $ideKerajinan->update($request->all());
        return response()->json($ideKerajinan);
    }

    public function destroy($id)
    {
        $ideKerajinan = IdeKerajinan::findOrFail($id);
        $ideKerajinan->delete();
        return response()->json(null, 204);
    }
}