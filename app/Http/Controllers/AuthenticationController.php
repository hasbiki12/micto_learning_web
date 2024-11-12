<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthenticationController extends Controller
{   
    
    //Login WEB
    public function login(Request $request){
        $credentials = $request->only('email', 'password'); // Pastikan ini adalah array, bukan objek User

        if (Auth::attempt($credentials)) {
            if (Auth::user()->role !== 'admin') {
                Auth::logout(); // Logout jika bukan admin
                return redirect()->back()->withErrors(['access' => 'Akses hanya diperbolehkan untuk admin.']);
            }
            // Login berhasil
            return redirect()->intended('')->with('success', 'Login berhasil!');
        } else {
            // Login gagal
            return redirect()->back()->with(['error' => 'Email atau password salah']);
        }
    }

    //LOGIN MOBILE AUTHENTICATION
    public function loginMobile(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password'=>'required',
            ]);
            
        $user = User::where('email', $request->email)->first();
        if (! $user || ! Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['Email atau password salah'],
            ]);
        }
        $token = $user->createToken('api_token')->plainTextToken;
        return response()->json([
            'message' => 'Login sukses',
            'token' => $token,
            'role' => $user->role // Pastikan 'role' adalah atribut yang sesuai di model User
        ]);
        // return $user->createToken('api_tokens')->plainTextToken;
    }

    public function logout(Request $request){
         // Revoke the user's token
         $request->user()->currentAccessToken()->delete();
        return response()->json(['message' => 'Successfully logged out'], 200);
    }

    public function logoutWeb()
    {
        Auth::logout(); // Log out the user by clearing their session
        session()->flash('success', 'Anda telah berhasil keluar.');
        return redirect()->route('login'); // Redirect to the login page
    }

    public function me(Request $request){
        return response()->json(Auth::user());
    }
}
