<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pertanyaan extends Model
{
    use HasFactory;

    protected $table = 'tbl_pertanyaan_kuis'; // Nama tabel sesuai migrasi
    protected $fillable = [
        'kuis_id',
        'pertanyaan',
        'jawaban_a',
        'jawaban_b',
        'jawaban_c',
        'jawaban_d',
        'jawaban_e',
        'kunci_jawaban',
    ];

    // Relasi dengan model Kuis
    public function kuis()
    {
        return $this->belongsTo(Kuis::class, 'kuis_id');
    }
}
