<?php

namespace App\Http\Controllers\Api;

use App\Models\Materi;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\MateriDetailResource;

class MateriController extends Controller
{
    public function index()
    {
        // Mengambil semua materi
        $materi = Materi::with(['user','bab:id,judul_bab'])->get();

        return response()->json($materi->map(function ($item) {
            return [
                'id' => $item->id,
                'judul' => $item->judul,
                'deskripsi' => $item->deskripsi,
                'file_path' => $item->file_path,
                'user_name' => $item->user->name, // Menampilkan nama pengguna
                'judul_bab' => $item->bab ? $item->bab->judul_bab : null,
                'created_at' => $item->created_at,
                'updated_at' => $item->updated_at,
            ];
        }));
    }

    public function show($id)
    {
        // Mengambil detail materi berdasarkan ID dari MateriResource.php
        $materi = Materi::with('user')->find($id);

        if (!$materi) {
            return response()->json(['message' => 'Materi tidak ditemukan'], 404);
        }
    
        return new MateriDetailResource($materi);
    }

    public function store(Request $request)
    {
        // Validasi dan simpan data baru
        $validated = $request->validate([
            'judul' => 'required|string|max:50',
            'bab_id' => 'required|exists:bab,id',
            'file'  => 'nullable|file|mimes:pdf,docx,zip,png,jpg,jpeg|max:10240', // Validasi ukuran file
        ]);

        //validasi role yang sedang akses adalah guru
        $user = Auth::user();
        if ($user->role !== 'guru') {
            return response()->json(['message' => 'Hanya pengguna dengan role guru yang dapat menambahkan materi.'], 403);
        }
        
        $filePath = null;
        if ($request->hasFile('file')) {
            $filePath = $request->file('file')->store('materi_files', 'public');
        }

        $materi = Materi::create([
            'judul' => $validated['judul'],
            'deskripsi' => $request->input('deskripsi', ''), 
            'file_path' => $filePath,
            'bab_id' => $validated['bab_id'],
            'user_id' => $user->id, // Ambil ID user dari autentikasi
        ]);
        
        return response()->json(['message' => 'Materi berhasil dibuat', 'materi' => $materi]);
    }

    public function update(Request $request, $id)
    {
        // Validasi input
        $validated = $request->validate([
            'judul' => 'sometimes|string|max:50',
            'deskripsi'=>'nullable',
            'file' => 'nullable|file|mimes:pdf,docx,zip|max:10240', // Validasi ukuran file
        ]);
        
        // Ambil materi berdasarkan ID
        $materi = Materi::findOrFail($id);

        // validasi edit hanya oleh user yang buat dan dengan role guru
        $user = Auth::user();
        if ($materi->user_id !== $user->id || $user->role !== 'guru') { 
            return response()->json(['message' => 'Anda tidak berhak memperbarui materi ini.'], 403);
        }

        // Update materi
        $materi->update($validated);

        return new MateriDetailResource($materi);
    }
    
    public function destroy($id)
    {
        // Ambil materi berdasarkan ID
        $materi = Materi::findOrFail($id);

        // validasi hapus hanya boleh oleg guru yang membuat materi
        $user = Auth::user();
        if ($materi->user_id !== $user->id || $user->role !== 'guru') { 
            return response()->json(['message' => 'Anda tidak berhak menghapus materi ini.'], 403);
        }

        // Hapus materi
        $materi->delete();

        return response()->json(['message' => 'Materi berhasil dihapus.']);
    }

    //TODO BUAT API CRUD DATA PENGGUNA DI FLUTTER 
}