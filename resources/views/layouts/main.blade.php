<!DOCTYPE html>
<html lang="en" data-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <link rel="icon" href="{{ asset('storage/logo/logo.png') }}" alt="Logo" class="object-scale-down" type="image/png">
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>
<body">
    
    <div class="drawer md:drawer-open ">
        <input id="my-drawer-2" type="checkbox" class="drawer-toggle" />
        <div class="drawer-side shadow-xl">
            <label for="my-drawer-2" aria-label="close sidebar" class="drawer-overlay"></label>
            <ul class=" menu md:bg-blend-soft-light bg-base-100 text-base-content min-h-full md:w-46 lg:w-60 sm:w-60 p-4 md:text-lg">
                <!-- Sidebar content -->
                <div class="my-3 mx-4">
                    <i class="fa-regular fa-user fa-lg mr-2"></i>
                    <a href="#" class="md:text-xl font-semibold">ADMIN</a>
                </div>
                <hr>
                <li><a href="/dashboard">Dashboard</a></li>
                <li><a href="/siswa">Data Siswa</a></li>
                <li><a href="/guru">Data Guru</a></li>
                <li><a href="/add_user">Tambah akun</a></li>
                <li><a href="#" onclick="confirmLogout(event)">Keluar</a></li>
                <form id="logout-form" action="{{ route('logoutWeb') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </ul>
        </div>
        
        <div class="drawer-content ">
            <!-- Button to open drawer on smaller screens -->
            <label for="my-drawer-2" class="btn btn-ghost drawer-button justify-start md:hidden">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="inline-block h-5 w-5 stroke-current">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                </svg>
            </label>
    
            <!-- Main content section -->
            <div class="container p-6 w-full h-full  bg-slate-50 md:w-4/4">
                @yield('content')
            </div>
        </div>
    </div>

    {{-- Konfirmasi logout --}}
    <script>
        function confirmLogout(event) {
            event.preventDefault(); // Mencegah aksi default link
    
            Swal.fire({
                title: 'Apakah Anda yakin ingin keluar?',
                text: "Anda akan keluar dari sesi saat ini.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, keluar!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('logout-form').submit(); // Kirim form logout
                }
            });
        }
    </script>
</body>
</html>
