<?php

namespace App\Http\Controllers;

use App\Models\Barang_Unggahan;
use App\Models\BarangUnggahan;
use Illuminate\Http\Request;

class BarangUnggahanController extends Controller
{
    public function index()
    {
        $barangUnggahan = Barang_Unggahan::with(['user', 'ide'])->get();
        return response()->json($barangUnggahan);
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_pengguna' => 'required|exists:users,id',
            'id_ide' => 'required|exists:ide_kerajinans,id',
            'deskripsi' => 'required|string',
            'foto' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'tanggal_unggah' => 'required|date'
        ]);

        // Handle file upload
        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/barang_unggahan'), $fileName);
            
            $barangUnggahan = Barang_Unggahan::create([
                'id_pengguna' => $request->id_pengguna,
                'id_ide' => $request->id_ide,
                'deskripsi' => $request->deskripsi,
                'foto' => 'uploads/barang_unggahan/' . $fileName,
                'tanggal_unggah' => $request->tanggal_unggah
            ]);

            return response()->json($barangUnggahan, 201);
        }

        return response()->json(['message' => 'No file uploaded'], 400);
    }

    public function show($id)
    {
        $barangUnggahan = Barang_Unggahan::with(['user', 'ide'])->findOrFail($id);
        return response()->json($barangUnggahan);
    }

    public function update(Request $request, $id)
    {
        $barangUnggahan = Barang_Unggahan::findOrFail($id);
        
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
        $barangUnggahan = Barang_Unggahan::findOrFail($id);
        
        // Delete file
        if (file_exists(public_path($barangUnggahan->foto))) {
            unlink(public_path($barangUnggahan->foto));
        }
        
        $barangUnggahan->delete();
        return response()->json(null, 204);
    }
}