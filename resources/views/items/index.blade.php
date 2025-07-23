@extends('layouts.app')

@section('title', 'Daftar Barang')

@section('content')
    <div class="max-w-7xl p-6 mx-auto bg-[#e8e8e8]">
        <!-- Header Section -->
        <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6 gap-4">
            <div>
                <h2 class="text-2xl font-bold text-gray-800">Daftar Barang</h2>
                <p class="text-sm text-gray-500 mt-1">Kelola data barang yang tersedia di sistem</p>
            </div>

            <a href="{{ route('items.create') }}"
                class="group inline-flex items-center relative bg-white text-gray-700 font-medium rounded-lg px-4 py-2.5 text-sm border border-gray-200 shadow-sm overflow-hidden transition-all hover:shadow-md">
            <span class="absolute left-0 top-0 h-full w-0 bg-blue-50 transition-all duration-300 group-hover:w-full"></span>
         <span class="z-10">  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
  <path d="M6 3a3 3 0 0 0-3 3v2.25a3 3 0 0 0 3 3h2.25a3 3 0 0 0 3-3V6a3 3 0 0 0-3-3H6ZM15.75 3a3 3 0 0 0-3 3v2.25a3 3 0 0 0 3 3H18a3 3 0 0 0 3-3V6a3 3 0 0 0-3-3h-2.25ZM6 12.75a3 3 0 0 0-3 3V18a3 3 0 0 0 3 3h2.25a3 3 0 0 0 3-3v-2.25a3 3 0 0 0-3-3H6ZM17.625 13.5a.75.75 0 0 0-1.5 0v2.625H13.5a.75.75 0 0 0 0 1.5h2.625v2.625a.75.75 0 0 0 1.5 0v-2.625h2.625a.75.75 0 0 0 0-1.5h-2.625V13.5Z" />
</svg></span>

            <span class="z-10">Tambah Barang</span>
            </a>
        </div>

        <!-- Table Section -->
        <div class="bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Merek</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Asal</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kategori</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">qty</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Gambar</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($items as $index => $item)
                            <tr class="hover:bg-gray-50/95 transition duration-150">
                                <td class="px-6 py-4 text-sm text-gray-600">{{ $index + 1 }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-800">{{ $item->name }}</div>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-600">{{ $item->brand }}</td>
                                <td class="px-6 py-4 text-sm text-gray-600">{{ $item->origin }}</td>
                                <td class="px-6 py-4 text-sm text-gray-600">{{ $item->category->name ?? '-' }}</td>
                                <td class="px-6 py-4 text-sm text-gray-600">{{ $item->quantity }}</td>
                                <td class="px-6 py-4">
                                    <span class="px-2.5 py-1 inline-flex text-xs leading-5 font-semibold rounded-full
                                    {{ $item->status === 'available' ? 'bg-green-100 text-green-700' : 'bg-yellow-100 text-yellow-700' }}">
                                    {{ ucfirst($item->status) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-600">
                                    <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->name }}" class="h-16 w-16">
                                </td>
                                <td class="px-6 py-4 text-left text-sm font-medium">
                                    <div class="flex justify-start space-x-2">
                                        <a href="{{ route('items.edit', $item) }}"
                                           class="inline-flex items-center bg-amber-50 hover:bg-amber-100 text-amber-700 font-medium rounded-md px-3 py-1.5 text-xs shadow-xs border border-amber-200/60"
                                           title="Edit" @click.stop>
                                            <span class="material-icons-round text-sm mr-1">edit</span>Edit
                                        </a>

                                        <form action="{{ route('items.destroy', $item) }}" method="POST" class="inline" @click.stop>
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                    class="inline-flex items-center bg-red-50 hover:bg-red-100 text-red-700 font-medium rounded-md px-3 py-1.5 text-xs shadow-xs border border-red-200/60"
                                                    title="Hapus"
                                                    onclick="return confirm('Apakah Anda yakin ingin menghapus barang ini?')">
                                                <span class="material-icons-round text-sm mr-1">delete</span>Hapus
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
