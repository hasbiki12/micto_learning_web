<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        //mengembalikan semua kolom di tabel users
        // return parent::toArray($request);
        
        //Mengembalikan tabel tertentu ke controller 
        return [

            'id'=>$this->id,
            'name'=> $this->name,
            'nis'=> $this->nis,
            'nuptk'=> $this->nuptk,
            'role'=>$this->role,
        ];
    }
}
