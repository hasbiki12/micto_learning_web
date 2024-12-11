<?php

namespace App\Http\Controllers\Api;

use App\Models\Bab;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\BabDetailResouce;
use App\Http\Resources\MateriDetailResource;

class BabController extends Controller
{
    public function index()
{
    $bab = Bab::with(['materi' => function($query) {
        $query->with('kuis'); // Pastikan memuat relasi kuis jika diperlukan
    }])->get();

    return response()->json([
        'bab' => $bab->map(function($b) {
            return [
                'id' => $b->id,
                'judul_bab' => $b->judul_bab,
                'materi' => MateriDetailResource::collection($b->materi)
            ];
        })
    ]);
}
    public function store(Request $request){
        $validated = $request->validate([
            'judul_bab' => 'required|string|max:50',
        ]);

        $user = Auth::user();
        if ($user->role !== 'guru') {
            return response()->json(['message' => 'Hanya pengguna dengan role guru yang dapat menambahkan materi.'], 403);
        }
        
        $bab = Bab::create([
            'user_id' => $user->id, // Ambil ID user dari autentikasi
            'judul_bab' => $validated['judul_bab'],
        ]);

        return response()->json(['message' => 'Bab berhasil dibuat', 'Bab' => $bab]);
    }

    public function update(Request $request, $id)
    {
        // Validasi input
        $validated = $request->validate([
            'judul_bab' => 'sometimes|string|max:50',
        ]);
        
        // Ambil materi berdasarkan ID
        $bab = Bab::findOrFail($id);

        // validasi edit hanya oleh user yang buat dan dengan role guru
        $user = Auth::user();
        if ($bab->user_id !== $user->id || $user->role !== 'guru') { 
            return response()->json(['message' => 'Anda tidak berhak memperbarui materi ini.'], 403);
        }

        // Update materi
        $bab->update($validated);

        return new BabDetailResouce($bab);
    }

    public function destroy($id)
    {
        // Ambil materi berdasarkan ID
        $bab = Bab::findOrFail($id);

        // validasi hapus hanya boleh oleg guru yang membuat materi
        $user = Auth::user();
        if ($bab->user_id !== $user->id || $user->role !== 'guru') { 
            return response()->json(['message' => 'Anda tidak berhak menghapus Bab ini.'], 403);
        }
        
        // Hapus materi
        $bab->delete();

        return response()->json(['message' => 'Bab berhasil dihapus.']);
    }
}
