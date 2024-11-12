<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Materi extends Model
{
    use HasFactory;
    protected $table = 'materi';
    protected $fillable = [
        'judul',
        'deskripsi',
        'file_path',
        'user_id',
        'bab_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function bab()
    {
        return $this->belongsTo(Bab::class,'bab_id', 'id');
    }
}
