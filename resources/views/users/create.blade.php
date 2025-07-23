@extends('layouts.app')

@section('title', 'Tambah Pengguna')

@section('content')
<div class="max-w-md p-6 mx-auto bg-[#e8e8e8]">
    <!-- Header Section -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-8 gap-4">
        <div>
            <h2 class="text-2xl font-bold text-gray-800">Tambah Pengguna Baru</h2>
            <p class="text-sm text-gray-500 mt-1">Isi form berikut untuk menambahkan pengguna baru</p>
        </div>

        <a href="{{ route('users.index') }}"
            class="group inline-flex items-center relative bg-white text-gray-700 font-medium rounded-lg px-4 py-2.5 text-sm border border-gray-200 shadow-sm overflow-hidden transition-all hover:shadow-md">
            <span class="absolute left-0 top-0 h-full w-0 bg-blue-50 transition-all duration-300 group-hover:w-full"></span>
            <svg class="w-4 h-4 mr-2 z-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            <span class="z-10">Kembali</span>
        </a>
    </div>

    <!-- Form Section -->
    <form action="{{ route('users.store') }}" method="POST" class="bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden">
        @csrf
        <div class="p-6 space-y-5">
            <!-- Name -->
            <div>
                <label for="name" class="block text-xs font-medium text-gray-500 mb-1.5">Nama Lengkap</label>
                <input type="text" name="name" id="name" value="{{ old('name') }}"
                        class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-100 focus:border-blue-400 transition duration-150"
                        placeholder="Masukkan nama lengkap" required>
                @error('name')
                    <p class="text-xs text-red-600 mt-1.5 flex items-center">
                        <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                        </svg>
                        {{ $message }}
                    </p>
                @enderror
            </div>

            <!-- Email -->
            <div>
                <label for="email" class="block text-xs font-medium text-gray-500 mb-1.5">Alamat Email</label>
                <input type="email" name="email" id="email" value="{{ old('email') }}"
                        class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-100 focus:border-blue-400 transition duration-150"
                        placeholder="contoh@email.com" required>
                @error('email')
                    <p class="text-xs text-red-600 mt-1.5 flex items-center">
                        <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                        </svg>
                        {{ $message }}
                    </p>
                @enderror
            </div>

            <!-- Password -->
            <div>
                <label for="password" class="block text-xs font-medium text-gray-500 mb-1.5">Password</label>
                <input type="password" name="password" id="password"
                        class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-100 focus:border-blue-400 transition duration-150"
                        placeholder="••••••••" required>
                @error('password')
                    <p class="text-xs text-red-600 mt-1.5 flex items-center">
                        <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                        </svg>
                        {{ $message }}
                    </p>
                @enderror
            </div>

            <!-- Role -->
            <div>
                <label for="role" class="block text-xs font-medium text-gray-500 mb-1.5">Peran Pengguna</label>
                <select name="role" id="role"
                        class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-100 focus:border-blue-400 transition duration-150 bg-white"
                        required>
                    <option value="">Pilih peran pengguna</option>
                    <option value="user" {{ old('role') === 'user' ? 'selected' : '' }}>User</option>
                    <option value="admin" {{ old('role') === 'admin' ? 'selected' : '' }}>Admin</option>
                </select>
                @error('role')
                    <p class="text-xs text-red-600 mt-1.5 flex items-center">
                        <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                        </svg>
                        {{ $message }}
                    </p>
                @enderror
            </div>
        </div>

        <!-- Form Footer -->
        <div class="bg-gray-50 px-6 py-4 border-t border-gray-200 flex justify-end">
            <button type="submit"
                    class="group relative inline-flex items-center overflow-hidden bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg px-5 py-2.5 text-sm shadow-sm transition-all">
                <span class="absolute left-0 top-0 h-full w-0 bg-blue-500 transition-all duration-300 group-hover:w-full"></span>
                <svg class="w-4 h-4 mr-2 z-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"></path>
                </svg>
                <span class="z-10">Simpan Pengguna</span>
            </button>
        </div>
    </form>
</div>
@endsection
