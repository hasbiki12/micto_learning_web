@extends('layouts.main')
@section('title', 'Dashboard')
@section('content')
    <div class="flex justify-center mt-12">
        <div class="bg-white shadow-xl rounded-lg p-6 w-96">
            <h2 class="text-xl font-semibold text-center mb-4">Tambah Pengguna</h2>
            <form id="user-form" method="post" action="{{ route('users.store') }}">
                @csrf
                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium text-gray-700">Nama</label>
                    <input type="text" id="name" name="name" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring focus:ring-blue-300" placeholder="Masukkan nama Anda">
                </div>
                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                    <input type="email" id="email" name="email" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring focus:ring-blue-300" placeholder="Masukkan email Anda">
                </div>
                <div class="mb-3">
                    <label for="role" class="block text-sm font-medium text-gray-700">Role</label>
                    <select id="role" name="role" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-300" onchange="toggleFields()">
                        <option value="">Pilih role</option>
                        <option value="guru">Guru</option>
                        <option value="siswa">Siswa</option>    
                        <option value="admin">Admin</option>
                    </select>
                </div>  
                <div id="nis-field" class="mt-2 hidden">
                    <label for="nis" class="block text-sm font-medium text-gray-700">NIS</label>
                    <input type="text" id="nis" name="nis" class="mb-4 mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring focus:ring-blue-300" placeholder="Masukkan NIS">
                </div>
                <div id="nuptk-field" class="mt-2 hidden">
                    <label for="nuptk" class="block text-sm font-medium text-gray-700">NUPTK</label>
                    <input type="text" id="nuptk" name="nuptk" class="mb-4 mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring focus:ring-blue-300" placeholder="Masukkan NUPTK">
                </div>
                <div class="mb-4">
                    <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                    <input type="password" id="password" name="password" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring focus:ring-blue-300" placeholder="Masukkan Password (min. 8 karakter)">
                </div>
                <div class="mb-4">
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Konfirmasi Password</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring focus:ring-blue-300" placeholder="Konfirmasi Password">
                </div>
                
                <div class="flex justify-center mb-2">
                    <button type="submit" class="w-full bg-blue-600 text-white font-semibold py-2 rounded-md hover:bg-blue-500 transition duration-200">Kirim</button>
                </div>
                {{-- error message --}}
                @foreach (['name', 'nis', 'nuptk', 'password', 'password_confirmation'] as $field)
                    @if ($errors->has($field) && (in_array($field, ['nis', 'nuptk']) ? old('role') === ($field === 'nis' ? 'siswa' : 'guru') : true))
                        <div>
                            <p class="text-red-500">{{ $errors->first($field) }}</p>
                        </div>
                    @endif
                @endforeach
            
            </form>
        </div>
    </div>
   








    <script>
        function toggleFields() {
            const role = document.getElementById('role').value;
            const nisField = document.getElementById('nis-field');
            const nuptkField = document.getElementById('nuptk-field');
        
            if (role === 'siswa') {
                nisField.classList.remove('hidden');
                nuptkField.classList.add('hidden');
            } else if (role === 'guru') {
                nuptkField.classList.remove('hidden');
                nisField.classList.add('hidden');
            } else {
                nisField.classList.add('hidden');
                nuptkField.classList.add('hidden');
            }
        }
        </script>
@endsection