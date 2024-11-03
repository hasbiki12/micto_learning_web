<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthenticationController extends Controller
{   
    
    
    public function login(Request $request){
        $request->validate([
            'email' => 'required|email', 
            'password' => 'required',
        ]);
        
        $user = User::where('email', $request->email)->first();

        if (! $user || ! Hash::check($request->password, $user->password)) {
        return redirect()->back()->with('error', 'Email atau password salah!');
        throw ValidationException::withMessages([
            'email' => ['email atau password salah !'],
        ]);
        }   
        if ($user->role !== 'admin') {
            return redirect('login')->withErrors(['email' => 'Akses hanya untuk admin!']);
        }
         // Redirect ke halaman dashboard jika role-nya admin
         return redirect('dashboard')
         ->with('status', 'Login berhasil!');

        // // Redirect ke halaman dashboard
        // return redirect('dashboard');
        // return $user->createToken('user login')->plainTextToken;

    }

    public function logout(Request $request){
        $request->user()->currentAccessToken()->delete();
    }

    public function me(Request $request){
        return response()->json(Auth::user());
    }
}


//  // Misalnya, jika NUPTK memiliki panjang 16 karakter dan NIS memiliki panjang 10 karakter
        // $isTeacher = strlen($request->identifier) === 16; // Sesuaikan panjang sesuai format NUPTK di sistem kamu
        // $isStudent = strlen($request->identifier) === 10; // Sesuaikan panjang sesuai format NIS
        
        // if ($isTeacher) {
        //     // Logika validasi untuk guru (misalnya NUPTK)
        //     $user = User::where('nuptk', $request->identifier)->where('role', 'teacher')->first();
        // } elseif ($isStudent) {
        //     // Logika validasi untuk siswa (misalnya NIS)
        //     $user = User::where('nis', $request->identifier)->where('role', 'student')->first();
        // }

        //  // Cek apakah pengguna ditemukan dan password cocok
        // if ($user && Hash::check($request->password, $user->password)) {
        //     // Lakukan login atau alihkan ke halaman sesuai role
        //     Auth::login($user);
        //     return redirect()->intended('/dashboard'); // Redirect ke dashboard
        // } else {
        //     return back()->withErrors([
        //         'login' => 'Identifier atau password salah.',
        //     ]);
        // }