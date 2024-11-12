<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Bab extends Model
{
    use HasFactory;
    protected $table = 'bab';
    protected $fillable = [
        'judul_bab', 
        'user_id'
    ];

    public function materi()
    {
        return $this->hasMany(Materi::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
