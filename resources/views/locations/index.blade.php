@extends('layouts.app')

@section('title', 'Daftar Lokasi')

@section('content')
    <div class="max-w-7xl p-6 mx-auto bg-[#e8e8e8]">
        <!-- Header Section -->
        <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6 gap-4">
            <div>
                <h2 class="text-2xl font-bold text-gray-800">Daftar Lokasi Barang</h2>
                <p class="text-sm text-gray-500 mt-1">Kelola data lokasi barang</p>
            </div>

            <a href="{{ route('locations.create') }}"
                class="inline-flex items-center bg-gradient-to-br from-blue-600 to-blue-500 hover:from-blue-700 hover:to-blue-600 text-white font-medium rounded-md px-4 py-2.5 text-sm transition-all shadow-sm hover:shadow-md">
                <span class="material-icons-round text-base mr-2">add</span>
                Tambah Lokasi
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
                                Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($locations as $index => $location)
                            <tr x-data @click="window.location = @js(route('locations.show', $location))"
                                class="cursor-pointer hover:bg-gray-50/95 transition duration-150">
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                                    {{ $index + 1 }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-800">{{ $location->name }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-ledt text-sm font-medium">
                                    <div class="flex justify-start space-x-2">
                                        <a href="{{ route('locations.edit', $location) }}"
                                            class="inline-flex items-center bg-amber-50 hover:bg-amber-100 text-amber-700 font-medium rounded-md px-3 py-1.5 text-xs shadow-xs border border-amber-200/60"
                                            title="Edit"
                                            @click.stop>
                                            <span class="material-icons-round text-sm mr-1">edit</span>
                                            Edit
                                        </a>

                                        <form action="{{ route('locations.destroy', $location) }}" method="POST" class="inline"
                                            @click.stop>
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit"
                                                class="inline-flex items-center bg-red-50 hover:bg-red-100 text-red-700 font-medium rounded-md px-3 py-1.5 text-xs shadow-xs border border-red-200/60"
                                                title="Hapus"
                                                onclick="return confirm('Apakah Anda yakin ingin menghapus kategori ini?')">
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

@endsection
 </div>
