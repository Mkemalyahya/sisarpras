@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="max-w-7xl p-6 mx-auto bg-[#e8e8e8]">

    <!-- Hero Header with Animated Gradient -->
    <div class="mb-8 p-6 rounded-2xl bg-gradient-to-r from-indigo-500 via-blue-500 to-indigo-500 text-white shadow-xl transform transition-all duration-500 hover:shadow-2xl">
        <div class="flex flex-col md:flex-row items-center justify-between">
            <div class="flex items-center mb-4 md:mb-0">
                <div class="mr-4 bg-white/20 p-3 rounded-xl backdrop-blur-sm animate-pulse">
                    <img src="{{ asset('asset/logotb.png') }}" alt="Logo" class="h-12 w-auto transform transition-transform duration-300 hover:rotate-6">
                </div>
                <div>
                    <h1 class="text-3xl font-bold">Selamat Datang, {{ Auth::user()->name }}!</h1>
                    <p class="text-white/90 mt-1">Ringkasan aktivitas sistem terbaru</p>
                </div>
            </div>
            <div class="flex space-x-2">
                <span class="px-3 py-1 bg-white/10 rounded-full text-xs font-medium backdrop-blur-sm flex items-center">
                    <span class="w-2 h-2 bg-green-400 rounded-full mr-2 animate-pulse"></span>
                    Last updated: {{ now()->format('d M Y H:i') }}
                </span>
                <span class="px-3 py-1 bg-white/10 rounded-full text-xs font-medium backdrop-blur-sm">
                    {{ ucfirst(Auth::user()->role) }}
                </span>
            </div>
        </div>
    </div>

    <!-- Stats Cards with Mini Charts -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <!-- Users Card -->
        <div class="bg-white rounded-xl border border-gray-100 shadow-sm p-6 hover:shadow-md transition-all hover:-translate-y-1 group">
            <div class="flex items-start justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-500">Total Pengguna</p>
                    <p class="text-3xl font-bold text-gray-800 mt-2">{{ $totalUsers }}</p>
                    <div class="mt-3 flex items-center text-sm">
                        <span class="text-green-500 flex items-center">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"></path>
                            </svg>
                            +12%
                        </span>
                        <span class="text-gray-400 ml-1">vs bulan lalu</span>
                    </div>
                </div>
                <div class="relative w-20 h-16">
                    <canvas id="usersChart" class="absolute inset-0 w-full h-full"></canvas>
                </div>
            </div>
        </div>

        <!-- Items Card -->
        <div class="bg-white rounded-xl border border-gray-100 shadow-sm p-6 hover:shadow-md transition-all hover:-translate-y-1 group">
            <div class="flex items-start justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-500">Total Barang</p>
                    <p class="text-3xl font-bold text-gray-800 mt-2">{{ $totalItems }}</p>
                    <div class="mt-3 flex items-center text-sm">
                        <span class="text-green-500 flex items-center">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"></path>
                            </svg>
                            +8%
                        </span>
                        <span class="text-gray-400 ml-1">vs bulan lalu</span>
                    </div>
                </div>
                <div class="relative w-20 h-16">
                    <canvas id="itemsChart" class="absolute inset-0 w-full h-full"></canvas>
                </div>
            </div>
        </div>

        <!-- Borrows Card -->
        <div class="bg-white rounded-xl border border-gray-100 shadow-sm p-6 hover:shadow-md transition-all hover:-translate-y-1 group">
            <div class="flex items-start justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-500">Peminjaman Aktif</p>
                    <p class="text-3xl font-bold text-gray-800 mt-2">{{ $totalBorrows }}</p>
                    <div class="mt-3 flex items-center text-sm">
                        <span class="text-green-500 flex items-center">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"></path>
                            </svg>
                            +15%
                        </span>
                        <span class="text-gray-400 ml-1">vs bulan lalu</span>
                    </div>
                </div>
                <div class="relative w-20 h-16">
                    <canvas id="borrowsChart" class="absolute inset-0 w-full h-full"></canvas>
                </div>
            </div>
        </div>

        <!-- Returns Card -->
        <div class="bg-white rounded-xl border border-gray-100 shadow-sm p-6 hover:shadow-md transition-all hover:-translate-y-1 group">
            <div class="flex items-start justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-500">Pengembalian</p>
                    <p class="text-3xl font-bold text-gray-800 mt-2">{{ $totalReturns }}</p>
                    <div class="mt-3 flex items-center text-sm">
                        <span class="text-green-500 flex items-center">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"></path>
                            </svg>
                            +20%
                        </span>
                        <span class="text-gray-400 ml-1">vs bulan lalu</span>
                    </div>
                </div>
                <div class="relative w-20 h-16">
                    <canvas id="returnsChart" class="absolute inset-0 w-full h-full"></canvas>
                </div>
            </div>
        </div>
    </div>


    <!-- Recent Data Sections with Improved Design -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Recent Users -->
        <div class="bg-white rounded-xl border border-gray-100 shadow-sm overflow-hidden">
            <div class="p-5 border-b border-gray-100 flex justify-between items-center bg-gray-50">
                <h3 class="font-semibold text-gray-800 flex items-center">
                    <svg class="w-5 h-5 text-purple-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                    Pengguna Terbaru
                </h3>
                <a href="{{ route('users.index') }}" class="text-xs font-semibold text-blue-500 hover:text-blue-700 flex items-center transition-colors">
                    Lihat semua <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </a>
            </div>
            <div class="divide-y divide-gray-100">
                @foreach($recentUsers as $user)
                <a href="{{ route('users.show', $user) }}" class="block p-4 hover:bg-gray-50 transition duration-150">
                    <div class="flex items-center">
                        <div class="relative">
                            <div class="h-10 w-10 rounded-full bg-gradient-to-r from-purple-100 to-blue-100 flex items-center justify-center text-purple-600">
                                @if($user->profile_photo_path)
                                    <img src="{{ Storage::url($user->profile_photo_path) }}" alt="Profile" class="h-full w-full rounded-full object-cover">
                                @else
                                    <span class="font-medium">{{ substr($user->name, 0, 1) }}</span>
                                @endif
                            </div>
                            @if($user->role === 'admin')
                            <div class="absolute -bottom-1 -right-1 h-4 w-4 rounded-full bg-blue-500 border-2 border-white flex items-center justify-center">
                                <svg class="w-2 h-2 text-white" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                </svg>
                            </div>
                            @endif
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-semibold text-gray-900">{{ $user->name }}</p>
                            <p class="text-xs text-gray-500">{{ $user->email }}</p>
                        </div>
                        <div class="ml-auto">
                            <span class="px-2.5 py-0.5 text-xs rounded-full {{ $user->role === 'admin' ? 'bg-blue-100 text-blue-800' : 'bg-gray-100 text-gray-800' }} font-medium">
                                {{ ucfirst($user->role) }}
                            </span>
                        </div>
                    </div>
                </a>
                @endforeach
            </div>
        </div>

        <!-- Recent Items -->
        <div class="bg-white rounded-xl border border-gray-100 shadow-sm overflow-hidden">
            <div class="p-5 border-b border-gray-100 flex justify-between items-center bg-gray-50">
                <h3 class="font-semibold text-gray-800 flex items-center">
                    <svg class="w-5 h-5 text-indigo-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                    </svg>
                    Barang Terbaru
                </h3>
                <a href="{{ route('items.index') }}" class="text-xs font-semibold text-blue-500 hover:text-blue-700 flex items-center transition-colors">
                    Lihat semua <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </a>
            </div>
            <div class="divide-y divide-gray-100">
                @foreach($recentItems as $item)
                <a href="{{ route('items.show', $item) }}" class="block p-4 hover:bg-gray-50 transition duration-150">
                    <div class="flex items-center">
                        <div class="h-10 w-10 rounded-full bg-gradient-to-r from-indigo-100 to-blue-100 flex items-center justify-center text-indigo-600">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-semibold text-gray-900">{{ $item->name }}</p>
                            <p class="text-xs text-gray-500">{{ $item->category->name ?? 'No category' }}</p>
                        </div>
                        <div class="ml-auto flex flex-col items-end">
                            <span class="text-sm font-medium {{ $item->quantity > 0 ? 'text-green-600' : 'text-red-500' }}">
                                Stok: {{ $item->quantity }}
                            </span>
                            <span class="text-xs text-gray-400">{{ $item->location->name ?? 'No location' }}</span>
                        </div>
                    </div>
                </a>
                @endforeach
            </div>
        </div>

        <!-- Recent Borrows -->
        <div class="bg-white rounded-xl border border-gray-100 shadow-sm overflow-hidden">
            <div class="p-5 border-b border-gray-100 flex justify-between items-center bg-gray-50">
                <h3 class="font-semibold text-gray-800 flex items-center">
                    <svg class="w-5 h-5 text-amber-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                    Peminjaman Terbaru
                </h3>
                <a href="{{ route('borrows.index') }}" class="text-xs font-semibold text-blue-500 hover:text-blue-700 flex items-center transition-colors">
                    Lihat semua <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </a>
            </div>
            <div class="divide-y divide-gray-100">
                @foreach($recentBorrows as $borrow)
                <a href="{{ route('borrows.show', $borrow) }}" class="block p-4 hover:bg-gray-50 transition duration-150">
                    <div class="flex items-center">
                        <div class="h-10 w-10 rounded-full bg-gradient-to-r from-amber-100 to-yellow-100 flex items-center justify-center text-amber-600">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-semibold text-gray-900">{{ $borrow->item->name }}</p>
                            <p class="text-xs text-gray-500">Dipinjam oleh {{ $borrow->user->name }}</p>
                        </div>
                        <div class="ml-auto text-right">
                            <p class="text-xs font-medium text-gray-500">
                                {{ \Carbon\Carbon::parse($borrow->borrow_start)->format('d M') }}
                            </p>
                            <p class="text-xs font-medium {{ $borrow->is_overdue ? 'text-red-500' : 'text-green-500' }}">
                                {{ $borrow->status }}
                            </p>
                        </div>
                    </div>
                </a>
                @endforeach
            </div>
        </div>

        <!-- Recent Returns -->
        <div class="bg-white rounded-xl border border-gray-100 shadow-sm overflow-hidden">
            <div class="p-5 border-b border-gray-100 flex justify-between items-center bg-gray-50">
                <h3 class="font-semibold text-gray-800 flex items-center">
                    <svg class="w-5 h-5 text-emerald-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                    </svg>
                    Pengembalian Terbaru
                </h3>
                <a href="{{ route('returnings.index') }}" class="text-xs font-semibold text-blue-500 hover:text-blue-700 flex items-center transition-colors">
                    Lihat semua <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </a>
            </div>
            <div class="divide-y divide-gray-100">
                @foreach($recentReturns as $return)
                <a href="{{ route('returnings.show', $return) }}" class="block p-4 hover:bg-gray-50 transition duration-150">
                    <div class="flex items-center">
                        <div class="h-10 w-10 rounded-full bg-gradient-to-r from-emerald-100 to-green-100 flex items-center justify-center text-emerald-600">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-semibold text-gray-900">{{ $return->borrow->item->name }}</p>
                            <p class="text-xs text-gray-500">Dikembalikan oleh {{ $return->borrow->user->name }}</p>
                        </div>
                        <div class="ml-auto text-right">
                            <p class="text-xs font-medium text-gray-500">
                                {{ \Carbon\Carbon::parse($return->return_date)->format('d M') }}
                            </p>
                            <p class="text-xs font-medium {{ $return->is_late ? 'text-red-500' : 'text-green-500' }}">
                                {{ $return->is_late ? 'Terlambat' : 'Tepat waktu' }}
                            </p>
                        </div>
                    </div>
                </a>
                @endforeach
            </div>
        </div>
    </div>

     <!-- Main Charts Section -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
        <!-- Monthly Activity Chart -->
        <div class="bg-white rounded-xl border border-gray-100 shadow-sm p-6">
            <div class="flex justify-between items-center mb-6">
                <h3 class="font-semibold text-gray-800">Aktivitas Bulanan</h3>
                <div class="flex space-x-2">
                    <button class="px-3 py-1 text-xs bg-blue-50 text-blue-600 rounded-full">Bulan Ini</button>
                    <button class="px-3 py-1 text-xs bg-gray-100 text-gray-600 rounded-full">Tahun Ini</button>
                </div>
            </div>
            <div class="h-64">
                <canvas id="monthlyActivityChart"></canvas>
            </div>
        </div>

        <!-- Borrow Status Chart -->
        <div class="bg-white rounded-xl border border-gray-100 shadow-sm p-6">
            <div class="flex justify-between items-center mb-6">
                <h3 class="font-semibold text-gray-800">Status Peminjaman</h3>
                <div class="text-xs text-gray-500">Update: {{ now()->format('d M') }}</div>
            </div>
            <div class="h-64">
                <canvas id="borrowStatusChart"></canvas>
            </div>
        </div>
    </div>

    <!-- Floating Action Button -->
    <div class="fixed bottom-8 right-8 z-10">
        <div class="relative group">
            <button id="fab-main" class="w-14 h-14 rounded-full bg-gradient-to-r from-blue-600 to-indigo-600 text-white shadow-lg hover:shadow-xl transition-all flex items-center justify-center focus:outline-none transform hover:scale-105">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                </svg>
            </button>
            <div class="absolute bottom-full right-0 mb-4 hidden group-hover:block space-y-2">
                <a href="{{ route('borrows.create') }}" class="flex items-center justify-center w-10 h-10 rounded-full bg-green-500 text-white shadow-md hover:bg-green-600 transition-all transform hover:scale-110">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                </a>
                <a href="{{ route('items.create') }}" class="flex items-center justify-center w-10 h-10 rounded-full bg-indigo-500 text-white shadow-md hover:bg-indigo-600 transition-all transform hover:scale-110">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                </a>
                <a href="{{ route('users.create') }}" class="flex items-center justify-center w-10 h-10 rounded-full bg-purple-500 text-white shadow-md hover:bg-purple-600 transition-all transform hover:scale-110">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                    </svg>
                </a>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Mini charts for stats cards
    function createMiniChart(id, color) {
        const ctx = document.getElementById(id).getContext('2d');
        return new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['', '', '', '', '', ''],
                datasets: [{
                    data: [5, 15, 10, 20, 15, 25],
                    borderColor: color,
                    borderWidth: 2,
                    tension: 0.4,
                    fill: false,
                    pointRadius: 0
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    x: { display: false },
                    y: { display: false }
                },
                plugins: { legend: { display: false } }
            }
        });
    }

    // Monthly Activity Chart
    function createMonthlyActivityChart() {
        const ctx = document.getElementById('monthlyActivityChart').getContext('2d');
        return new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'],
                datasets: [
                    {
                        label: 'Peminjaman',
                        data: [12, 19, 15, 21, 18, 25, 22, 30, 28, 26, 20, 18],
                        backgroundColor: 'rgba(79, 70, 229, 0.7)',
                        borderRadius: 4
                    },
                    {
                        label: 'Pengembalian',
                        data: [10, 15, 13, 17, 15, 20, 18, 25, 23, 20, 15, 12],
                        backgroundColor: 'rgba(16, 185, 129, 0.7)',
                        borderRadius: 4
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    x: {
                        grid: { display: false }
                    },
                    y: {
                        beginAtZero: true,
                        grid: { color: 'rgba(0, 0, 0, 0.05)' }
                    }
                },
                plugins: {
                    legend: {
                        position: 'top',
                        labels: {
                            boxWidth: 12,
                            padding: 20
                        }
                    }
                }
            }
        });
    }

    // Borrow Status Chart
    function createBorrowStatusChart() {
        const ctx = document.getElementById('borrowStatusChart').getContext('2d');
        return new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: ['Aktif', 'Terlambat', 'Selesai'],
                datasets: [{
                    data: [45, 15, 40],
                    backgroundColor: [
                        'rgba(99, 102, 241, 0.8)',
                        'rgba(239, 68, 68, 0.8)',
                        'rgba(16, 185, 129, 0.8)'
                    ],
                    borderWidth: 0
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                cutout: '70%',
                plugins: {
                    legend: {
                        position: 'right',
                        labels: {
                            boxWidth: 12,
                            padding: 20
                        }
                    }
                }
            }
        });
    }

    // Initialize all charts when the page loads
    document.addEventListener('DOMContentLoaded', function() {
        // Mini charts
        createMiniChart('usersChart', 'rgba(99, 102, 241, 1)');
        createMiniChart('itemsChart', 'rgba(79, 70, 229, 1)');
        createMiniChart('borrowsChart', 'rgba(245, 158, 11, 1)');
        createMiniChart('returnsChart', 'rgba(16, 185, 129, 1)');

        // Main charts
        createMonthlyActivityChart();
        createBorrowStatusChart();
    });
</script>
@endpush
@endsection
