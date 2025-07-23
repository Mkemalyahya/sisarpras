<div class="w-64 h-screen fixed flex flex-col bg-white border-r border-gray-200 shadow-sm">
    {{-- Header --}}
    <div class="p-5 flex items-center gap-3 border-b border-gray-200 bg-white/80 backdrop-blur-sm">
        <div class="p-2 rounded-lg bg-gradient-to-r from-blue-300 to-blue-400 shadow-md">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6 text-white">
                <path fill-rule="evenodd" d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.007 5.404.433c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.433 2.082-5.006z" clip-rule="evenodd" />
            </svg>
        </div>
        <span class="text-blue-800 text-xl font-bold">SISFO<span class="text-blue-600 font-extrabold"> TB</span></span>
    </div>

    {{-- Menu --}}
    <div class="flex-1 px-3 py-6 overflow-y-auto">
        <div class="space-y-1.5">

            @php
                $navItems = [
                    ['label' => 'Dashboard', 'route' => 'dashboard', 'icon' => 'dashboard'],
                    ['label' => 'Pengguna', 'route' => 'users.index', 'icon' => 'groups'],
                    ['label' => 'Kategori Barang', 'route' => 'categories.index', 'icon' => 'category'],
                    ['label' => 'Lokasi Barang', 'route' => 'locations.index', 'icon' => 'warehouse'],
                    ['label' => 'Barang', 'route' => 'items.index', 'icon' => 'inventory'],
                    ['label' => 'Peminjaman', 'route' => 'borrows.index', 'icon' => 'assignment'],
                    ['label' => 'Pengembalian', 'route' => 'returnings.index', 'icon' => 'assignment_return']
                ];
            @endphp

            @foreach ($navItems as $item)
                @php $active = request()->routeIs($item['route']); @endphp
                <a href="{{ route($item['route']) }}"
                    class="group relative flex items-center gap-3 px-3 py-2.5 rounded-lg transition-all mx-1 overflow-hidden
                    {{ $active ? 'bg-blue-200 text-blue-700' : 'text-blue-900 hover:text-blue-900' }}">
                    <!-- Hover effect background -->
                    <span class="absolute left-0 top-0 h-full w-0 bg-blue-100 transition-all duration-300 group-hover:w-full"></span>

                    <!-- Left border indicator -->
                    <span class="absolute left-0 top-0 h-full w-1
                        {{ $active ? 'bg-blue-400' : 'bg-transparent group-hover:bg-blue-300' }}"></span>

                    <!-- Icon and text -->
                    <span class="material-icons-round relative z-10 {{ $active ? 'text-blue-600' : 'text-blue-500 group-hover:text-blue-700' }}">
                        {{ $item['icon'] }}
                    </span>
                    <span class="text-sm font-medium relative z-10">{{ $item['label'] }}</span>

                    <!-- Active indicator -->
                    @if ($active)
                        <span class="ml-auto relative z-10 w-2 h-2 bg-blue-600 rounded-full animate-pulse"></span>
                    @endif
                </a>
            @endforeach

        </div>
    </div>

    {{-- Logout --}}
    <div class="p-4 border-t border-gray-200 bg-white/80 backdrop-blur-sm">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="group relative flex items-center gap-3 px-3 py-2.5 rounded-lg w-full text-left transition-all overflow-hidden
                           border border-red-200 text-red-700 hover:text-red-900 shadow-inner">
                <!-- Hover effect background -->
                <span class="absolute left-0 top-0 h-full w-0 bg-red-100 transition-all duration-300 group-hover:w-full"></span>

                <span class="material-icons-round relative z-10 text-red-600">logout</span>
                <span class="text-sm font-medium relative z-10">Logout</span>
                <span class="ml-auto relative z-10 transform group-hover:translate-x-1 transition-transform">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </span>
            </button>
        </form>
    </div>
</div>
