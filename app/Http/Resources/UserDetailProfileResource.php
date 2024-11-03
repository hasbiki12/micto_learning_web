<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserDetailProfileResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'=>$this->id,
            'nama'=>$this->name,
            'nis'=> $this->nis,
            'nuptk'=> $this->nuptk,
            'email'=> $this->email,
            'sandi'=>$this->password,
        ];
    }
}
