@extends('layouts.app')

@section('title', 'Daftar Pengguna')

@section('content')
    <div class="max-w-7xl p-6 mx-auto bg-[#e8e8e8]">
        <!-- Header Section -->
        <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6 gap-4">
            <div>
                <h2 class="text-2xl font-bold text-gray-800">Daftar Pengguna</h2>
                <p class="text-sm text-gray-500 mt-1">Kelola data pengguna sistem</p>
            </div>

            <a href="{{ route('users.create') }}"
                  class="group inline-flex items-center relative bg-white text-gray-700 font-medium rounded-lg px-4 py-2.5 text-sm border border-blue-200 shadow-sm overflow-hidden transition-all">
        <span class="absolute left-0 top-0 h-full w-0 bg-blue-50 transition-all duration-300 group-hover:w-full"></span>
    <span class="z-10">  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"  class="size-6" stroke="currentColor">
  <path d="M5.25 6.375a4.125 4.125 0 1 1 8.25 0 4.125 4.125 0 0 1-8.25 0ZM2.25 19.125a7.125 7.125 0 0 1 14.25 0v.003l-.001.119a.75.75 0 0 1-.363.63 13.067 13.067 0 0 1-6.761 1.873c-2.472 0-4.786-.684-6.76-1.873a.75.75 0 0 1-.364-.63l-.001-.122ZM18.75 7.5a.75.75 0 0 0-1.5 0v2.25H15a.75.75 0 0 0 0 1.5h2.25v2.25a.75.75 0 0 0 1.5 0v-2.25H21a.75.75 0 0 0 0-1.5h-2.25V7.5Z" />
</svg></span>

        <span class="z-10">Tambah Pengguna</span>
            </a>
        </div>

        <!-- Table Section -->
        <div class="bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                No
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Nama
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Email
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Role
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($users as $index => $user)
                            <tr x-data @click="window.location = @js(route('users.show', $user))"
                                class="cursor-pointer hover:bg-gray-50/95 transition duration-150">
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                                    {{ $index + 1 }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-800">{{ $user->name }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                                    {{ $user->email }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span
                                        class="px-2.5 py-1 inline-flex text-xs leading-5 font-semibold rounded-full
                                        {{ $user->role === 'admin' ? 'bg-green-100 text-green-700' : 'bg-blue-100 text-blue-700' }}">
                                        {{ ucfirst($user->role) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-ledt text-sm font-medium">
                                    <div class="flex justify-start space-x-2">
                                        <a href="{{ route('users.edit', $user) }}"
                                            class="inline-flex items-center bg-amber-50 hover:bg-amber-100 text-amber-700 font-medium rounded-md px-3 py-1.5 text-xs shadow-xs border border-amber-200/60"
                                            title="Edit"
                                            @click.stop>
                                            <span class="material-icons-round text-sm mr-1">edit</span>
                                            Edit
                                        </a>

                                        <form action="{{ route('users.destroy', $user) }}" method="POST" class="inline"
                                            @click.stop>
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit"
                                                class="inline-flex items-center bg-red-50 hover:bg-red-100 text-red-700 font-medium rounded-md px-3 py-1.5 text-xs shadow-xs border border-red-200/60"
                                                title="Hapus"
                                                onclick="return confirm('Apakah Anda yakin ingin menghapus pengguna ini?')">
                                                <span class="material-icons-round text-sm mr-1">delete</span>
                                                Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
