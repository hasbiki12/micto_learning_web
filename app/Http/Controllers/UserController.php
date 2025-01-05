<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\AddUserRequest;
use App\Http\Requests\EditGuruRequest;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\UserDetailProfileResource;

class UserController extends Controller
{   //ini adalah fungsi data yang dikembalikan ke FE lebih dari 1 
    public function index()
    {
        $user = User::all();
        // return response()->json($user);//mereturn isi table users menjadi json format
        return UserResource::collection($user); //import class UserResource,key dibungkus dengan array
    }

    //untuk return hasil cmn 1 where $id
    public function show($id)
    {
        $users = User::findOrFail($id);
        return new UserDetailProfileResource($users); //untuk import single value bukan array
    }

    public function create()
    {
        return view('add_user');
    }

    public function store(AddUserRequest $request)
    {

        //Konfirmasi form dari File AddUserRequest

        $validated = $request->validated();

        $user = new User;
        $user->name = $validated['name'];
        $user->email = $validated['email'];
        $user->role = $validated['role'];
        $user->password = Hash::make($validated['password']);

        if ($user->role === 'siswa') {
            $user->nis = $validated['nis'];
        } else if ($user->role === 'guru') {
            $user->nuptk = $validated['nuptk'];
        }

        $user->save();
        session()->flash('success', 'Data berhasil disimpan.');
        // return redirect()->route('dashboard');
        return view('add_user');

    }

    //edit user page
    public function edit(Request $request, $id)
    {
        $user = User::findOrFail($id);
        return view('edit_user', ['user' => $user]);
    }


    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        // Validasi input
        $validated = $request->validate([
            'name' => 'required|string|max:50',
            'email' => 'required|email|max:50|unique:users,email,' . $user->id,
            'nis' => 'required|max:19|unique:users,nis,' . $user->id,
            'password' => 'nullable|min:8', // Hilangkan confirmed
        ], [
            'nis.required' => 'NIS harus diisi.',
            'nis.unique' => 'NIS sudah terdaftar, Silakan gunakan NIS lain.',
            'email.unique' => 'Email sudah terdaftar. Silakan gunakan email lain.',
            'name.required' => 'Nama harus diisi.',
        ]);

        if ($request->filled('password')) {
            $request->validate(['password' => 'confirmed'], [
                'password.confirmed' => 'Konfirmasi password tidak sesuai.',
            ]);
            $user->password = Hash::make($request->password);
        }

        $user->name = $validated['name'];
        $user->email = $validated['email'];
        $user->nis = $validated['nis'];

        $user->save();

        session()->flash('success', 'Data berhasil diubah.');
        return redirect()->route('dashboard');
    }



    //edit guru page sesuai id yang diedit
    public function editGuru(Request $request, $id)
    {
        $guru = User::findOrFail($id);
        return view('edit_guru', ['guru' => $guru]);
    }

    //form validasi edit guru
    public function updateGuru(Request $request, $id)
    {
        $guru = User::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:50',
            'email' => 'required|email|max:50|unique:users,email,' . $guru->id,
            'nuptk' => 'max:19|unique:users,nuptk,' . $guru->id,
            'password' => 'nullable|min:8|confirmed', // Validasi password jika diisi
        ], [
            'nuptk.required' => 'NUPTK harus diisi.',
            'nuptk.unique' => 'NUPTK sudah terdaftar, Silakan gunakan NUPTK lain.',
            'email.unique' => 'Email sudah terdaftar. Silakan gunakan email lain.',
            'name.required' => 'Nama harus diisi.',
            'password.confirmed' => 'Konfirmasi password tidak sesuai.',
        ]);

        $guru->name = $validated['name'];
        $guru->email = $validated['email'];
        $guru->nuptk = $validated['nuptk'];

        if (!empty($validated['password'])) {
            $guru->password = Hash::make($validated['password']);
        }

        $guru->save();

        session()->flash('success', 'Data berhasil diubah.');
        return redirect()->route('dashboard');
    }

    public function destroy($id)
    {

        $user = User::findOrFail($id); // Cari user berdasarkan ID, tampilkan error 404 jika tidak ditemukan
        $user->delete(); // Hapus user dari database

        session()->flash('success', 'Data berhasil dihapus.');
        return redirect()->route('dashboard');
    }
}
