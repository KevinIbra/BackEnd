<?php

namespace App\Http\Controllers;

use App\Models\Barang_Unggahan;
use App\Models\BarangUnggahan;
use Illuminate\Http\Request;

/**
 * @OA\Info(
 *      version="1.0.0",
 *      title="Craft API Documentation",
 *      description="API documentation for Craft application"
 * )
 *
 * @OA\PathItem(
 *      path="/api/v1"
 * )
 */
class BarangUnggahanController extends Controller
{
    /**
     * @OA\Get(
     *      path="/api/v1/barang-unggahan",
     *      operationId="getBarangUnggahanList",
     *      tags={"Barang Unggahan"},
     *      summary="Get list of Barang Unggahan",
     *      description="Returns list of Barang Unggahan",
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation"
     *      )
     * )
     */
    public function index()
    {
        $barangUnggahan = BarangUnggahan::paginate(10); // 10 items per page
        return response()->json($barangUnggahan);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_barang' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'foto' => 'required|image',
        ]);

        $path = $request->file('foto')->store('uploads', 'public');
        $validated['foto'] = $path;

        $barangUnggahan = BarangUnggahan::create($validated);
        return response()->json($barangUnggahan, 201);
    }

    public function show($id)
    {
        $barangUnggahan = BarangUnggahan::with('ideKerajinan')->findOrFail($id);
        return response()->json($barangUnggahan);
    }

    public function update(Request $request, $id)
    {
        $barangUnggahan = BarangUnggahan::findOrFail($id);
        
        $request->validate([
            'id_pengguna' => 'exists:users,id',
            'id_ide' => 'exists:ide_kerajinans,id',
            'deskripsi' => 'string',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'tanggal_unggah' => 'date'
        ]);

        if ($request->hasFile('foto')) {
            // Delete old file
            if (file_exists(public_path($barangUnggahan->foto))) {
                unlink(public_path($barangUnggahan->foto));
            }

            // Upload new file
            $file = $request->file('foto');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/barang_unggahan'), $fileName);
            
            $request->merge(['foto' => 'uploads/barang_unggahan/' . $fileName]);
        }

        $barangUnggahan->update($request->all());
        return response()->json($barangUnggahan);
    }

    public function destroy($id)
    {
        $barangUnggahan = BarangUnggahan::findOrFail($id);
        
        // Delete file
        if (file_exists(public_path($barangUnggahan->foto))) {
            unlink(public_path($barangUnggahan->foto));
        }
        
        $barangUnggahan->delete();
        return response()->json(null, 204);
    }
}