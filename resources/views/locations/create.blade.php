@extends('layouts.app')

@section('title', 'Tambah Lokasi')

@section('content')
    <div class="max-w-md p-6 mx-auto bg-[#e8e8e8]">
        <!-- Header Section -->
        <div class="mb-8">
            <h2 class="text-2xl font-bold text-gray-800">Tambah Lokasi Baru</h2>
            <p class="text-sm text-gray-500 mt-1">Isi form berikut untuk menambahkan lokasi baru</p>
        </div>

        <!-- Form Section -->
        <form action="{{ route('locations.store') }}" method="POST" class="bg-white rounded-md border border-gray-200 shadow-sm p-6">
            @csrf

            <!-- Name -->
            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Nama</label>
                <input type="text" name="name" id="name"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-400 focus:ring focus:ring-blue-100 transition duration-150 px-4 py-2.5 border"
                        placeholder="contoh:Ruang Tata Usaha" required>
                @error('name')
                    <p class="text-xs text-red-600 mt-1.5 flex items-center">
                        <span class="material-icons-round text-xs mr-1">error</span>
                        {{ $message }}
                    </p>
                @enderror
            </div>

            <!-- Buttons -->
            <div class="flex justify-between items-center pt-4">
                <a href="{{ route('locations.index') }}"
                    class="inline-flex items-center text-sm bg-gray-200 text-gray-600 hover:text-gray-800 font-medium hover:bg-gray-100 rounded-md px-4 py-2 transition-all">
                    <span class="material-icons-round text-base mr-2">arrow_back</span>
                    Kembali
                </a>

                <button type="submit"
                        class="inline-flex items-center bg-gradient-to-br from-blue-600 to-blue-500 hover:from-blue-700 hover:to-blue-600 text-white font-medium rounded-md px-5 py-2.5 text-sm transition-all shadow-sm hover:shadow-md">
                    <span class="material-icons-round text-base mr-2">save</span>
                    Simpan Kategori
                </button>
            </div>
        </form>
    </div>
@endsection
