@extends('layouts.main')
@section('title', 'Data Siswa')
@section('content')

<div class="flex justify-center mt-12 ">
    <div class="bg-white shadow-md rounded-lg p-6 w-96">
        <h2 class="text-xl font-semibold text-center mb-4">Ubah Siswa</h2>
        <form id="user-form" method="post" action="/users/{{$user->id}}">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-700">Nama</label>
                <input type="text" id="name" name="name"
                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2"
                    placeholder="Masukkan nama Anda" value="{{$user->name}}">
            </div>
            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" id="email" name="email"
                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 "
                    placeholder="Masukkan email Anda" value="{{$user->email}}">
            </div>
            <div class="mb-4">
                <label for="nis" class="block text-sm font-medium text-gray-700">NIS</label>
                <input type="text" id="nis" name="nis"
                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2"
                    placeholder="Masukkan NIS Anda" value="{{$user->nis}}">
            </div>
            <div class="mb-4 relative">
                <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                <input type="password" id="password" name="password"
                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 pr-10"
                    placeholder="Masukkan password Anda">
                <button type="button" id="toggle-password"
                    class="absolute inset-y-0 my-7 right-0 px-3 py-2 text-gray-500 hover:text-gray-700">
                    <svg id="eye-icon" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path id="eye-icon-path" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                    </svg>
                </button>
            </div>

            <div class="mb-4 relative">
                <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Konfirmasi
                    Password</label>
                <input type="password" id="password_confirmation" name="password_confirmation"
                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 pr-10"
                    placeholder="Konfirmasi password Anda">
                <button type="button" id="toggle-password-confirmation"
                    class="absolute inset-y-0 my-7 right-0 px-3 py-2 text-gray-500 hover:text-gray-700">
                    <svg id="eye-icon-confirmation" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path id="eye-icon-path-confirmation" stroke-linecap="round" stroke-linejoin="round"
                            stroke-width="2"
                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                    </svg>
                </button>
            </div>

            <div class="flex justify-start mt-4">
                <button type="submit"
                    class="btn btn-success bg-blue-600 text-white font-semibold  rounded-md hover:bg-blue-500 transition duration-200">Update</button>
            </div>
            @if ($errors->any())
                <div class="mb-4">
                    <p class="list-disc list-inside text-red-500 font-base">
                        @foreach ($errors->all() as $error)
                            <span>{{ $error }}</span>
                        @endforeach
                    </p>
                </div>
            @endif
        </form>
    </div>
</div>

<script>
    function togglePasswordVisibility(inputId, iconId, pathId) {
        const inputField = document.getElementById(inputId);
        const eyeIconPath = document.getElementById(pathId);

        if (inputField.type === 'password') {
            inputField.type = 'text';
            eyeIconPath.setAttribute('d', 'M15 12a3 3 0 11-6 0 3 3 0 016 0z M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z');
        } else {
            inputField.type = 'password';
            eyeIconPath.setAttribute('d', 'M15 12a3 3 0 11-6 0 3 3 0 016 0z M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z');
        }
    }

    document.getElementById('toggle-password').addEventListener('click', function () {
        togglePasswordVisibility('password', 'eye-icon', 'eye-icon-path');
    });

    document.getElementById('toggle-password-confirmation').addEventListener('click', function () {
        togglePasswordVisibility('password_confirmation', 'eye-icon-confirmation', 'eye-icon-path-confirmation');
    });
</script>
@endsection