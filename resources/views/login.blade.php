<!DOCTYPE html>
<html lang="en" data-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <link rel="icon" href="{{ asset('storage/logo/logo.png') }}" alt="Logo" class="object-scale-down" type="image/png">
    @vite('resources/css/app.css')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>  
    @if (session('error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Login Gagal',
                text: '{{ session('error') }}',
                confirmButtonText: 'OK'
            });
        </script>
    @endif
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
    <section class="bg-gray-50 light:bg-gray-900">
        <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
            <div class="w-full bg-white rounded-lg shadow light:border md:mt-0 sm:max-w-md xl:p-0 light:bg-gray-800 light:border-gray-700">
                <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                    <img src="{{ asset('storage/logo/logo.png') }}" alt="Logo" class="object-scale-down h-32 w-96">
                    {{-- <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl light:text-white">
                        Login Sekarang
                    </h1> --}}
                    <form method="POST" action="{{ route('login') }}" class="space-y-4 md:space-y-6" action="#">
                        @csrf
                        <div>
                            <label for="email" class="block mb-2 text-sm font-medium text-gray-900 light:text-white">Email</label>
                            <input type="email" name="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 light:bg-gray-700 light:border-gray-600 light:placeholder-gray-400 light:text-white light:focus:ring-blue-500 light:focus:border-blue-500" placeholder="masukkan email" required="required">
                        </div>
                        <div>
                            <label for="password" class="block mb-2 text-sm font-medium text-gray-900 light:text-white">Password</label>
                            <input type="password" name="password" id="password" placeholder="********" class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 light:bg-gray-700 light:border-gray-600 light:placeholder-gray-400 light:text-white light:focus:ring-blue-500 light:focus:border-blue-500" required="">
                        </div>
                        <button type="submit" class="w-full text-white bg-primary-600 hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center light:bg-primary-600 light:hover:bg-primary-700 light:focus:ring-primary-800">Login</button>
                        {{-- <div class="flex items-center justify-end">
                            <a href="#" class="text-sm font-medium text-primary-600 hover:underline light:text-primary-500">Lupa password?</a>
                        </div> --}}
                    </form>
                </div>
            </div>
        </div>
      </section>
</body>
</html>