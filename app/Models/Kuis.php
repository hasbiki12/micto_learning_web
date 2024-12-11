<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Kuis extends Model
{
    use HasFactory;

    protected $table = 'tbl_kuis'; // Nama tabel sesuai migrasi
    protected $fillable = [
        'judul_kuis',
        'materi_id',
        'created_by',
        'durasi',
    ];

     // Relasi dengan model Materi
     public function materi()
     {
         return $this->belongsTo(Materi::class, 'materi_id','id');
     }
 
     // Relasi dengan model User (pembuat kuis/guru)
     public function creator()
     {
         return $this->belongsTo(User::class, 'created_by');
     }
 
     // Relasi dengan model Pertanyaan
     public function pertanyaan()
     {
         return $this->hasMany(Pertanyaan::class, 'kuis_id');
     }

     
}
