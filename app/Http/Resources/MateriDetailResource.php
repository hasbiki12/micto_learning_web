<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Resources\Json\JsonResource;

class MateriDetailResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        {
            return [
                'id' => $this->id,
                'judul' => $this->judul,
                'deskripsi' => $this->deskripsi,
                'file_path' => asset('storage/' . $this->file_path),
                'user_name' => $this->user ? $this->user->name : null,
                'judul_bab' => $this->bab ? $this->bab->judul_bab : null,
                'kuis' => $this->kuis->map(function ($kuis) {
                return [
                    'id' => $kuis->id,
                    'judul_kuis' => $kuis->judul_kuis,
                    'durasi' => $kuis->durasi,
                    'created_by' => $kuis->created_by,
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
                ];
            }),
            ];
        }
    }
}
