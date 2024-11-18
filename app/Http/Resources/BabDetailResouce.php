<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BabDetailResouce extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return parent::toArray($request);
        return [
            'id' => $this->id,
            'judul_bab' => $this->judul_bab,
            'user_name' => $this->user ? $this->user->name : null,
            // 'created_at' => $this->created_at,
            // 'updated_at' => $this->updated_at,
            
        ];
    }
}
