@extends('layouts.main')
@section('title', 'Data Guru')
  @section('content')
    <div class="container p-6">
      <h1 class="text-3xl font-semibold" >Data Guru</h1>
      <div class="wraper grid grid-cols-2  mt-12">
        <div class="overflow">
          <table class="table md:table md:text-base">
              <thead>
                <tr class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                  <th>No</th>
                  <th>Nama</th>
                  <th>Email</th>
                  <th>NUPTK</th>
                  <th>Role</th>
                </tr>
              </thead>
              <tbody>
                <!-- row 1 -->
                @foreach($guru as $data)
                <tr>
                  <th>{{$loop->iteration}}</th>
                  <td class="whitespace-nowrap">{{ $data->name }}</td>
                  <td>{{ $data->email }}</td>
                  <td>{{ $data->nuptk }}</td>
                  <td>{{ $data->role }}</td>
                  <td class="flex items-center px-6 py-4">
                    <a href="{{ url('edit_guru/' . $data->id) }}" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">
                      <i class="fa-regular fa-pen-to-square"></i>
                    </a>
                    <form id="delete-form-{{ $data->id }}" action="{{ route('users.destroy', $data->id) }}" method="POST" >
                      @csrf
                      @method('DELETE')
                    </form>
                    <a href="#" class="font-medium text-red-600 dark:text-red-500 hover:underline ms-3" onclick="confirmDelete({{ $data->id }})">
                      <i class="fa-solid fa-trash"></i>
                    </a>
                  </td>
                </tr>            
                @endforeach
              </tbody>
          </table>    
        </div>
      </div>
    </div>

 {{-- Alert untuk konfirmasi hapus --}}
  <script>
    function confirmDelete(userId) {
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: "Data yang dihapus tidak dapat dikembalikan!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById(`delete-form-${userId}`).submit();
            }
        });
    }
  </script>
  @endsection