<?php

namespace App\Http\Controllers;

use App\Models\Tutorial;
use Illuminate\Http\Request;

class TutorialController extends Controller
{
    public function index()
    {
        $tutorials = Tutorial::with('ideKerajinan')->get();
        return response()->json($tutorials);
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_ide' => 'required|exists:ides,id',
            'langkah_langkah' => 'required|string',
            'url_video' => 'required|url'
        ]);

        $tutorial = Tutorial::create($request->all());
        return response()->json($tutorial, 201);
    }

    public function show($id)
    {
        $tutorial = Tutorial::with('ideKerajinan')->findOrFail($id);
        return response()->json($tutorial);
    }

    public function update(Request $request, $id)
    {
        $tutorial = Tutorial::findOrFail($id);
        
        $request->validate([
            'id_ide' => 'exists:ides,id',
            'langkah_langkah' => 'string',
            'url_video' => 'url'
        ]);

        $tutorial->update($request->all());
        return response()->json($tutorial);
    }

    public function destroy($id)
    {
        $tutorial = Tutorial::findOrFail($id);
        $tutorial->delete();
        return response()->json(null, 204);
    }
}