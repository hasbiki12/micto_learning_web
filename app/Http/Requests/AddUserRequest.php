<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $rules = [
            'name' => 'required|string|max:50',
            'email' => 'required|email|unique:users,email',
            'role' => 'required',
            'password' => 'required|min:8|confirmed'
        ];
    
        if ($this->input('role') === 'siswa') {
            $rules['nis'] = 'required|max:20|unique:users,nis';
        }
    
        if ($this->input('role') === 'guru') {
            $rules['nuptk'] = 'required|max:20|unique:users,nuptk';
        }
    
        return $rules;
    }
    public function messages(): array
    {
        return [
            'name.required'=>'Nama tidak boleh kosong',
            'email.required'=>'Email tidak boleh kosong',
            'email.unique'=>'Email Sudah Digunakan',
            'role.required'=>'Role tidak boleh kosong',
            'nis.required' => 'NIS tidak boleh kosong',
            'nis.unique' => 'NIS sudah terdaftar. Silakan gunakan NIS lain.',
            'nuptk.required' => 'NUPTK tidak boleh kosong.',
            'nuptk.unique' => 'NUPTK sudah terdaftar. Silakan gunakan NUPTK lain.',
            'password.required'=>'Password tidak boleh kosong',
            'password.confirmed' => 'Konfirmasi password tidak sesuai dengan password.',
        ];
    }
}
