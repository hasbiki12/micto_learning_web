<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;

class GuruController extends Controller
{
    public function guruPage(Request $request){
        $keyword = $request->input('keyword');
        $sort = $request->input('sort', 'name'); // Default ke kolom 'name'
        $direction = $request->input('direction', 'asc'); // Default ke ascending

        $guru = User::where('role', 'guru')
            ->where(function ($query) use ($keyword) {
                if ($keyword) {
                    $query->where('name', 'like', '%' . $keyword . '%')
                          ->orWhere('nuptk', 'like', '%'. $keyword . '%');
                }
            })
            ->orderBy($sort, $direction) // Urutkan berdasarkan parameter
                ->paginate(15);

         return view('guru', compact('guru', 'keyword', 'sort', 'direction'));
    }
    
}
