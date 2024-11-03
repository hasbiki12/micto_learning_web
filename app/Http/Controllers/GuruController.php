<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;

class GuruController extends Controller
{
    public function guruPage(){
        // return view('guru');
        $guru = User::where('role', 'guru')->get();
        return view('guru', compact('guru'));
    }
    
}
