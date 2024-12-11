<?php

namespace App\Http\Controllers\Api;

use App\Models\Kuis;
use App\Models\Materi;
use App\Models\Pertanyaan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class KuisController extends Controller
{   

    public function index()
    {
        // $kuis = Kuis::all(); 
        $kuis = Kuis::with(['creator','pertanyaan'])->get();
        return response()->json([
            'kuis' => $kuis->map(function ($k) {
                return [
                    'id' => $k->id,
                    'judul_kuis' => $k->judul_kuis,
                    'materi_id' => $k->materi_id,
                    'created_by' => $k->creator->name, // Menampilkan nama pembuat kuis
                    'durasi' => $k->durasi,
                    'created_at' => $k->created_at,
                    'updated_at' => $k->updated_at,
                    'pertanyaan' => $k->pertanyaan->map(function ($p) {
                    return [
                        'id' => $p->id,
                        'pertanyaan' => $p->pertanyaan,
                        'jawaban_a' => $p->jawaban_a,
                        'jawaban_b' => $p->jawaban_b,
                        'jawaban_c' => $p->jawaban_c,
                        'jawaban_d' => $p->jawaban_d,
                        'jawaban_e' => $p->jawaban_e,
                        'kunci_jawaban' => $p->kunci_jawaban,
                    ];
                }),
                ];
            }),
        ]);
    }

    public function show($id)
    {
        $kuis = Kuis::with(['creator', 'pertanyaan'])
            ->findOrFail($id);

        return response()->json([
            'kuis' => [
                'id' => $kuis->id,
                'judul_kuis' => $kuis->judul_kuis,
                'materi_id' => $kuis->materi_id,
                'created_by' => $kuis->creator->name,
                'durasi' => $kuis->durasi,
                'created_at' => $kuis->created_at,
                'updated_at' => $kuis->updated_at,
                'pertanyaan' => $kuis->pertanyaan->map(function ($p) {
                    return [
                        'id' => $p->id,
                        'pertanyaan' => $p->pertanyaan,
                        'jawaban_a' => $p->jawaban_a,
                        'jawaban_b' => $p->jawaban_b,
                        'jawaban_c' => $p->jawaban_c,
                        'jawaban_d' => $p->jawaban_d,
                        'jawaban_e' => $p->jawaban_e,
                        'kunci_jawaban' => $p->kunci_jawaban,
                    ];
                }),
            ],
        ]);
    }

    //mengambil daftar judul materi dari tabel materi.
    public function getMateriTitles() {
        $materi = Kuis::select('id', 'judul')->get();
        return response()->json($materi);
    }

    //add kuis fungsi
    public function addKuis(Request $request) {
        $validated = $request->validate([
            'judul_kuis' => 'required|string',
            'materi_id' => 'required|exists:materi,id',
            'durasi' => 'required|date_format:H:i:s',
        ]);

        $user = Auth::user();
        if ($user->role !== 'guru') {
            return response()->json(['message' => 'Hanya pengguna dengan role guru yang dapat menambahkan Kuis.'], 403);
        }

        
        $kuis = Kuis::create([
            'judul_kuis' => $validated['judul_kuis'],
            'materi_id' => $validated['materi_id'],
            'durasi' => $validated['durasi'],
            'created_by' => $user->id,
        ]);
        return response()->json(['message' => 'Kuis berhasil dibuat!', 'data' => $kuis]);
    }
    
    
    //fungsi edit kuis
    public function editKuis(Request $request, $id)
    {
        $validated = $request->validate([
            'judul_kuis' => 'string|max:55',
            'materi_id' => 'nullable|exists:materi,id',
            'durasi' => 'date_format:H:i:s',
        ]);
        
        $kuis = Kuis::findOrFail($id);
        
        $kuis->update([
            'judul_kuis' => $validated['judul_kuis'],
            'materi_id' => $validated['materi_id'],
            'durasi' => $validated['durasi'],
        ]);
        
        return response()->json(['message' => 'Kuis berhasil diubah!', 'data' => $kuis]);
    }
    
    //fungsi delete kuis
    public function deleteKuis($id)
    {
        $kuis = Kuis::findOrFail($id);

        $kuis->delete();
        
        return response()->json(['message' => 'Kuis berhasil dihapus!']);
    }
    
    //add pertanyaan
    public function addPertanyaan(Request $request) {
        $validated = $request->validate([
            'kuis_id' => 'required|exists:tbl_kuis,id',
            'pertanyaan' => 'required|string',
            'jawaban_a' => 'required|string',
            'jawaban_b' => 'required|string',
            'jawaban_c' => 'required|string',
            'jawaban_d' => 'required|string',
            'jawaban_e' => 'required|string',
            'kunci_jawaban' => 'required|string|in:A,B,C,D,E',
        ]);
    
        $pertanyaan = Pertanyaan::create($validated);
        return response()->json([
            'message' => 'Pertanyaan berhasil ditambahkan!', 
            'data' => $pertanyaan,
        ]);
    }

    public function getSoalGrouped()
    {
        $soal = DB::table('tbl_pertanyaan_kuis')
            ->select('id', 'kuis_id', 'pertanyaan', 'jawaban_a', 'jawaban_b', 'jawaban_c', 'jawaban_d', 'jawaban_e', 'kunci_jawaban', )
            ->get();

        $grouped = $soal->groupBy('kuis_id')->map(function ($items, $kuis_id) {
            return [
                'kuis_id' => $kuis_id,
                'soal' => $items->map(function ($item) {
                    return [
                        'id' => $item->id,
                        'pertanyaan' => $item->pertanyaan,
                        'jawaban_a' => $item->jawaban_a,
                        'jawaban_b' => $item->jawaban_b,
                        'jawaban_c' => $item->jawaban_c,
                        'jawaban_d' => $item->jawaban_d,
                        'jawaban_e' => $item->jawaban_e,
                        'kunci_jawaban' => $item->kunci_jawaban,
                    ];
                })->values(),
            ];
        })->values();

        return response()->json(['soal' => $grouped]);
    }
    
}
