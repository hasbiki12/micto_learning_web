<?php

namespace App\Http\Controllers\Api;

use App\Models\Bab;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class BabController extends Controller
{
    public function index()
    {
        $bab = Bab::with('materi')->get(); // Mengambil semua bab beserta materi terkait
        return response()->json([
        'bab' => $bab
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
