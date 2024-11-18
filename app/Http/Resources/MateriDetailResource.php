<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
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
                // 'file_path' => $this->file_path,
                // 'file_path' => $this->file_path ? url('storage/' . $this->file_path) : null,
                'file_path' => asset('storage/' . $this->file_path),

                'user_name' => $this->user ? $this->user->name : null,
                'judul_bab' => $this->bab ? $this->bab->judul_bab : null,
                // 'created_at' => $this->created_at,
                // 'updated_at' => $this->updated_at,
                
            ];
        }
    }
}
