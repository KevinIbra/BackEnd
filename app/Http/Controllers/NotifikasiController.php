<?php

namespace App\Http\Controllers;

use App\Models\Notifikasi;
use Illuminate\Http\Request;

class NotifikasiController extends Controller
{
    public function index()
    {
        $notifikasi = Notifikasi::all();
        return response()->json($notifikasi);
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_pengguna' => 'required|exists:users,id',
            'pesan' => 'required|string',
            'waktu_kirim' => 'required|date'
        ]);

        $notifikasi = Notifikasi::create([
            'id_pengguna' => $request->id_pengguna,
            'pesan' => $request->pesan,
            'waktu_kirim' => $request->waktu_kirim,
            'sudah_dibaca' => false
        ]);

        return response()->json($notifikasi, 201);
    }

    public function show($id)
    {
        $notifikasi = Notifikasi::findOrFail($id);
        return response()->json($notifikasi);
    }

    public function update(Request $request, $id)
    {
        $notifikasi = Notifikasi::findOrFail($id);
        
        $request->validate([
            'sudah_dibaca' => 'boolean'
        ]);

        $notifikasi->update($request->all());
        return response()->json($notifikasi);
    }

    public function destroy($id)
    {
        $notifikasi = Notifikasi::findOrFail($id);
        $notifikasi->delete();
        return response()->json(null, 204);
    }
}