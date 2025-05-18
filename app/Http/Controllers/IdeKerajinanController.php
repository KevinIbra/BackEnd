<?php

namespace App\Http\Controllers;

use App\Models\IdeKerajinan;
use Illuminate\Http\Request;

/**
 * @OA\Get(
 *      path="/api/v1/ide-kerajinan",
 *      operationId="getIdeKerajinanList",
 *      tags={"Ide Kerajinan"},
 *      summary="Get list of Ide Kerajinan",
 *      description="Returns list of Ide Kerajinan",
 *      @OA\Response(
 *          response=200,
 *          description="Successful operation"
 *      )
 * )
 */
class IdeKerajinanController extends Controller
{
    public function index(Request $request)
    {
        $query = IdeKerajinan::query();

        if ($request->has('search')) {
            $query->where('judul', 'like', '%' . $request->search . '%');
        }

        if ($request->has('kategori')) {
            $query->where('kategori', $request->kategori);
        }

        return response()->json($query->paginate(10));
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