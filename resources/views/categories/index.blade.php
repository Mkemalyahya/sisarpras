@extends('layouts.app')

@section('title', 'Daftar Kategori')

@section('content')
    <div class="max-w-7xl p-6 mx-auto bg-[#e8e8e8]">
        <!-- Header Section -->
        <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6 gap-4">
            <div>
                <h2 class="text-2xl font-bold text-gray-800">Daftar Kategori Barang</h2>
                <p class="text-sm text-gray-500 mt-1">Kelola data kategori barang</p>
            </div>

            <a href="{{ route('categories.create') }}"
              class="group inline-flex items-center relative bg-white text-gray-700 font-medium rounded-lg px-4 py-2.5 text-sm border border-blue-200 shadow-sm overflow-hidden transition-all">
        <span class="absolute left-0 top-0 h-full w-0 bg-blue-50 transition-all duration-300 group-hover:w-full"></span>
      <span class="z-10">  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
  <path fill-rule="evenodd" d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25ZM12.75 9a.75.75 0 0 0-1.5 0v2.25H9a.75.75 0 0 0 0 1.5h2.25V15a.75.75 0 0 0 1.5 0v-2.25H15a.75.75 0 0 0 0-1.5h-2.25V9Z" clip-rule="evenodd" />
</svg></span>

                <span class="z-10">Tambah Kategori</span>
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
                        @foreach($categories as $index => $category)
                            <tr x-data @click="window.location = @js(route('categories.show', $category))"
                                class="cursor-pointer hover:bg-gray-50/95 transition duration-150">
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                                    {{ $index + 1 }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-800">{{ $category->name }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-ledt text-sm font-medium">
                                    <div class="flex justify-start space-x-2">
                                        <a href="{{ route('categories.edit', $category) }}"
                                            class="inline-flex items-center bg-amber-50 hover:bg-amber-100 text-amber-700 font-medium rounded-md px-3 py-1.5 text-xs shadow-xs border border-amber-200/60"
                                            title="Edit"
                                            @click.stop>
                                            <span class="material-icons-round text-sm mr-1">edit</span>
                                            Edit
                                        </a>

                                        <form action="{{ route('categories.destroy', $category) }}" method="POST" class="inline"
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
    </div>
@endsection
