<!DOCTYPE html>
<html lang="en" data-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>
<body>
    
    <div class="drawer md:drawer-open">
        <input id="my-drawer-2" type="checkbox" class="drawer-toggle" />
        <div class="drawer-side shadow-xl">
            <label for="my-drawer-2" aria-label="close sidebar" class="drawer-overlay"></label>
            <ul class="menu md:bg-blend-soft-light bg-base-100 text-base-content min-h-full md:w-46 lg:w-60 sm:w-60 p-4 md:text-lg">
                <!-- Sidebar content -->
                <div class="wrape flex my-3">
                    <div class="md:avatar hidden">
                        <div class="w-12 rounded-full">
                            <img src="https://img.daisyui.com/images/stock/photo-1534528741775-53994a69daeb.webp" />
                        </div>
                    </div>
                    <li><a href="#" class="md:text-xl font-semibold">ADMIN</a></li>
                </div>
                <hr>
                <li><a href="/dashboard">Dashboard</a></li>
                <li><a href="/siswa">Data Siswa</a></li>
                <li><a href="/guru">Data Guru</a></li>
                <li><a href="/add_user">Tambah akun</a></li>
                <li><a>Keluar</a></li>
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
            <div class="container p-6 min-w-min">
                @yield('content')
            </div>
        </div>
    </div>
</body>
</html>
