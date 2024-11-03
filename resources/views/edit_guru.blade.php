@extends('layouts.main')
@section('title', 'Data Siswa')
@section('content')

<div class="flex justify-center mt-12 ">
    <div class="bg-white shadow-md rounded-lg p-6 w-96">
        <h2 class="text-xl font-semibold text-center mb-4">Ubah Guru</h2>
        <form id="guru-form" method="post" action="/users/{{$guru->id}}">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-700">Nama</label>
                <input type="text" id="name" name="name" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2" placeholder="Masukkan nama Anda" value="{{$guru->name}}">
            </div>
            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" id="email" name="email" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 " placeholder="Masukkan email Anda" value="{{$guru->email}}">
            </div>
            <div class="mb-4">
                <label for="nuptk" class="block text-sm font-medium text-gray-700">NUPTK</label>
                <input type="text" id="nuptk" name="nuptk" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2" placeholder="Masukkan NUPTK Anda" value="{{$guru->nuptk}}">
            </div>
            <div class="flex justify-start mt-4">
                <button type="submit" class="btn btn-success bg-blue-600 text-white font-semibold  rounded-md hover:bg-blue-500 transition duration-200">Update</button>
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
@endsection