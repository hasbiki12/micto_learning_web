@extends('layouts.main')
@section('title', 'Dashboard')
@section('content')
    
    @if(session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: '{{ session('success') }}',
                showConfirmButton: true,
            }).then((result) => {
                if (result.isConfirmed) {
                    // Opsi untuk melanjutkan jika perlu
                    window.location = "{{ route('dashboard') }}"; // Mengarahkan kembali ke dashboard
                }
            });
        </script>
    @endif
    <div class="flex md:justify-between ">
        <h1 class="text-3xl font-bold text-slate-600">Dashboard</h1>
        <div class="wrapper flex gap-1">
                @php
                    // Format: Hari, Tanggal/Bulan/Tahun 
                    $currentDateTime = \Carbon\Carbon::now();
                    $formattedDate = $currentDateTime->locale('id')->translatedFormat('l, j F Y');
                    $formattedTime = $currentDateTime->format('H:i:s'); 
                @endphp
            <div class="card bg-base-100 border-2 hidden md:block">
                <div class="card-body flex flex-row  p-2 text-center">
                    <p id="realtime-date">{{ $formattedDate }}</p>
                </div>
            </div>
            <div class="card bg-base-100  border-2 hidden md:block">
                <div class="card-body flex flex-row  p-2 text-center">
                    <p id="realtime-clock">{{ $formattedTime }}</p>
                </div>
            </div>
        </div>
    </div>
    <br>
    <hr>
    <p class="mt-4 md:text-2xl ">Selamat datang di halaman dashboard Anda. Berikut konten utama Anda!</p>

    <div class="container md:flex gap-2 w-full mt-12">
        <a href="/siswa">
            <div class="card bg-base-100 md:w-96 md:h-44 shadow-lg">
                <div class="card-body md:w-auto flex flex-col  lg:justify-between">
                  <h2 class="card-title font-medium text-lg">Total Siswa</h2>
                  <div class="card-actions justify-between md:mt-8">
                    <div class="flex flex-col">
                        <p class="font-bold text-xl">{{ $totalSiswa }}</p>    
                        <span class="card-title text-base font-light from-neutral-400">Akun Siswa</span>
                    </div>
                    <i class="fa-regular fa-user fa-3x" style="color: #63c3e6;"></i>
                  </div>
                </div>
            </div>
        </a>
        <a href="/guru">
            <div class="card bg-base-100 md:w-96 md:h-44 shadow-lg">
                <div class="card-body flex flex-col justify-between">
                  <h2 class="card-title font-medium text-lg">Total Guru</h2>
                  <div class="card-actions justify-between md:mt-8">
                    <div class="flex flex-col">
                        <p class="font-bold text-xl">{{ $totalGuru }}</p>    
                        <span class="card-title text-base font-light from-neutral-400">Akun Guru</span>
                    </div>
                    <i class="fa-regular fa-user fa-3x" style="color: #63c3e6;"></i>
                  </div>
                </div>
            </div>
        </a>
    </div>


    <script>
        // Fungsi untuk memperbarui tanggal dan waktu setiap detik
        function updateDateTime() {
            // Ambil elemen dengan ID "realtime-date" dan "realtime-clock"
            const dateElement = document.getElementById('realtime-date');
            const clockElement = document.getElementById('realtime-clock');
            
            // Dapatkan waktu saat ini
            const now = new Date();
            
            // Format waktu dalam jam:menit:detik
            const hours = String(now.getHours()).padStart(2, '0');
            const minutes = String(now.getMinutes()).padStart(2, '0');
            const seconds = String(now.getSeconds()).padStart(2, '0');
            
            // Update teks di elemen dengan waktu yang diformat
            clockElement.textContent = `${hours}:${minutes}:${seconds}`;
            
            // Format tanggal dalam format lokal (dalam Bahasa Indonesia)
            const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
            const formattedDate = now.toLocaleDateString('id-ID', options);
            
            // Update teks di elemen dengan tanggal yang diformat
            dateElement.textContent = formattedDate;
        }
    
        // Perbarui tanggal dan waktu setiap detik
        setInterval(updateDateTime, 1000);
    </script>
@endsection