<?php

namespace App\Http\Controllers;

use App\Models\Tutorial;
use Illuminate\Http\Request;

/**
 * @OA\Get(
 *      path="/api/v1/tutorial",
 *      operationId="getTutorialList",
 *      tags={"Tutorial"},
 *      summary="Get list of Tutorials",
 *      description="Returns list of Tutorials",
 *      @OA\Response(
 *          response=200,
 *          description="Successful operation"
 *      )
 * )
 */
class TutorialController extends Controller
{
    public function index(Request $request)
    {
        $query = Tutorial::query();

        if ($request->has('sort_by')) {
            $query->orderBy($request->sort_by, $request->get('order', 'asc'));
        }

        return response()->json($query->paginate(10));
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