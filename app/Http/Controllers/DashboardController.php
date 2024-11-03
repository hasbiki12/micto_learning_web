<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use App\Models\User;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $totalSiswa = User::where('role', 'siswa')->count(); // Hitung jumlah user dengan role siswa
        $totalGuru = User::where('role', 'guru')->count(); // Hitung jumlah user dengan role siswa
        $namaAdmin = User::where('role','admin')->value('name');
        $currentDateTime = Carbon::now(); // Mendapatkan waktu sekarang
        return view('dashboard', compact('totalSiswa','totalGuru','namaAdmin','currentDateTime'));
    }
    
} 
