@extends('layouts.app')

@section('title', 'Detail Pengguna')

@section('content')
<div class="max-w-4xl p-6 mx-auto bg-[#e8e8e8]">
    <!-- Header Section -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-8 gap-4">
        <div>
            <h2 class="text-2xl font-bold text-gray-800">Detail Pengguna</h2>
            <p class="text-sm text-gray-500 mt-1">Informasi lengkap pengguna sistem</p>
        </div>

      <div class="flex gap-3">
    <!-- Edit Button -->
    <a href="{{ route('users.edit', $user) }}"
        class="group inline-flex items-center relative bg-white text-gray-700 font-medium rounded-lg px-4 py-2.5 text-sm border border-blue-200 shadow-sm overflow-hidden transition-all">
        <span class="absolute left-0 top-0 h-full w-0 bg-blue-50 transition-all duration-300 group-hover:w-full"></span>
        <svg class="w-4 h-4 mr-2 z-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
        </svg>
        <span class="z-10">Edit Pengguna</span>
    </a>

    <!-- Back Button -->
    <a href="{{ route('users.index') }}"
          class="group inline-flex items-center relative bg-white text-gray-700 font-medium rounded-lg px-4 py-2.5 text-sm border border-blue-200 shadow-sm overflow-hidden transition-all">
        <span class="absolute left-0 top-0 h-full w-0 bg-blue-50 transition-all duration-300 group-hover:w-full"></span>
        <svg class="w-4 h-4 mr-2 z-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
        </svg>
        <span class="z-10">kembali</span>
    </a>
</div>
    </div>

    <!-- User Card -->
    <div class="bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden">
        <div class="p-6">
            <div class="flex flex-col md:flex-row gap-6">

                <!-- User Avatar -->
                <div class="flex-shrink-0">
                    <div class="h-24 w-24 rounded-full bg-blue-100 flex items-center justify-center text-blue-600">
                        <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                    </div>
                </div>

                <!-- User Details -->
                <div class="flex-1">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <!-- Name -->
                        <div>
                            <p class="text-xs font-medium text-gray-500 mb-1">Nama Lengkap</p>
                            <p class="text-gray-800 font-medium">{{ $user->name }}</p>
                        </div>

                        <!-- Email -->
                        <div>
                            <p class="text-xs font-medium text-gray-500 mb-1">Email</p>
                            <p class="text-gray-800 font-medium">{{ $user->email }}</p>
                        </div>

                        <!-- Role -->
                        <div>
                            <p class="text-xs font-medium text-gray-500 mb-1">Role</p>
                            <p class="text-sm font-medium">
                                <span class="px-2.5 py-1 inline-flex rounded-full
                                    {{ $user->role === 'admin' ? 'bg-green-100 text-green-700' : 'bg-blue-100 text-blue-700' }}">
                                    {{ ucfirst($user->role) }}
                                </span>
                            </p>
                        </div>

                        <!-- Tanggal Dibuat -->
                        <div>
                            <p class="text-xs font-medium text-gray-500 mb-1">Bergabung Pada</p>
                            <p class="text-gray-800 text-sm">{{ $user->created_at->format('d M Y H:i') }}</p>
                        </div>
                    </div>

                    <!-- Additional Info -->
                    <div class="mt-6 pt-6 border-t border-gray-100">
                        <h4 class="text-sm font-medium text-gray-700 mb-3 flex items-center">
                            <svg class="w-4 h-4 mr-2 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            Informasi Tambahan
                        </h4>
                        <p class="text-gray-600 text-sm">
                            Pengguna ini memiliki akses {{ $user->role === 'admin' ? 'penuh' : 'terbatas' }} dalam sistem.
                            Terakhir diperbarui {{ $user->updated_at->diffForHumans() }}.
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Activity Section -->
        <div class="bg-gray-50 px-6 py-4 border-t border-gray-200">
            <h4 class="text-sm font-medium text-gray-700 mb-3 flex items-center">
                <svg class="w-4 h-4 mr-2 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                Aktivitas Terakhir
            </h4>
            <div class="flex items-center text-gray-500 text-sm">
                <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <p>Belum ada aktivitas yang tercatat</p>
            </div>
        </div>
    </div>
</div>
@endsection
