<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class SiswaController extends Controller
{
    public function siswaPage(Request $request){

        $keyword = $request->input('keyword');
        $sort = $request->input('sort', 'name'); // Default ke kolom 'name'
        $direction = $request->input('direction', 'asc'); // Default ke ascending

        $siswa = User::where('role', 'siswa')
            ->where(function ($query) use ($keyword) {
                if ($keyword) {
                    $query->where('name', 'like', '%' . $keyword . '%')
                          ->orWhere('nis', 'like', '%'. $keyword . '%');
                }
            })
            ->orderBy($sort, $direction) // Urutkan berdasarkan parameter
                ->paginate(15);

         return view('siswa', compact('siswa', 'keyword', 'sort', 'direction'));
    }

    
}
