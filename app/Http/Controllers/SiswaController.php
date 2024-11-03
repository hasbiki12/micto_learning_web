<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class SiswaController extends Controller
{
    public function siswaPage(){
        $siswa = User::where('role', 'siswa')->get();
        return view('siswa', compact('siswa'));
    }

    
}
