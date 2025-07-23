@extends('layouts.app')

@section('title', 'Edit Barang')

@section('content')
    <div class="max-w-5xl p-6 mx-auto bg-[#e8e8e8]">
        <!-- Header -->
        <div class="mb-8">
            <h2 class="text-2xl font-bold text-gray-800">Edit Barang</h2>
            <p class="text-sm text-gray-500 mt-1">Perbarui data barang berikut sesuai kebutuhan</p>
        </div>

        <!-- Form -->
        <form action="{{ route('items.update', $item->id) }}" method="POST" enctype="multipart/form-data"
              class="bg-white rounded-md border border-gray-200 shadow-sm p-6">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Left Column -->
                <div class="space-y-4">
                    <!-- Name -->
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Nama Barang</label>
                        <input type="text" name="name" id="name" value="{{ old('name', $item->name) }}"
                               class="block w-full border rounded-md px-4 py-2.5 shadow-sm border-gray-300 focus:ring-blue-100 focus:border-blue-400 transition duration-150"
                               placeholder="Proyektor" required>
                        @error('name')
                            <p class="text-xs text-red-600 mt-1.5 flex items-center">
                                <span class="material-icons-round text-xs mr-1">error</span>{{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Brand -->
                    <div>
                        <label for="brand" class="block text-sm font-medium text-gray-700 mb-2">Merek</label>
                        <input type="text" name="brand" id="brand" value="{{ old('brand', $item->brand) }}"
                               class="block w-full border rounded-md px-4 py-2.5 shadow-sm border-gray-300 focus:ring-blue-100 focus:border-blue-400 transition duration-150"
                               placeholder="Epson" required>
                        @error('brand')
                            <p class="text-xs text-red-600 mt-1.5 flex items-center">
                                <span class="material-icons-round text-xs mr-1">error</span>{{ $message }}
                            </p>
                        @enderror
                    </div>


                    <!-- Origin -->
                    <div>
                        <label for="origin" class="block text-sm font-medium text-gray-700 mb-2">Asal</label>
                        <input type="text" name="origin" id="origin" value="{{ old('origin', $item->origin) }}"
                               class="block w-full border rounded-md px-4 py-2.5 shadow-sm border-gray-300 focus:ring-blue-100 focus:border-blue-400 transition duration-150"
                               placeholder="Bonus" required>
                        @error('origin')
                            <p class="text-xs text-red-600 mt-1.5 flex items-center">
                                <span class="material-icons-round text-xs mr-1">error</span>{{ $message }}
                            </p>
                        @enderror
                    </div>
                    <!-- Quantity -->
                <div>
                    <label for="quantity" class="block text-sm font-medium text-gray-700 mb-2">Jumlah</label>
                    <input type="number" name="quantity" id="quantity" min="1" value="{{ old('quantity', $item->quantity) }}"
                           class="w-full px-4 py-2.5 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-100 focus:border-blue-400 transition duration-150"
                           required>
                    @error('quantity')
                        <p class="text-xs text-red-600 mt-1.5 flex items-center">
                            <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                            </svg>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                </div>


                <!-- Right Column -->
                <div class="space-y-4">
                    <!-- Lokasi -->
                    <div>
                        <label for="location_id" class="block text-sm font-medium text-gray-700 mb-2">Lokasi</label>
                        <select name="location_id" id="location_id"
                                class="block w-full border rounded-md px-4 py-2.5 shadow-sm border-gray-300 bg-white focus:ring-blue-100 focus:border-blue-400 transition duration-150"
                                required>
                            <option value="">Pilih Lokasi</option>
                            @foreach ($locations as $location)
                                <option value="{{ $location->id }}"
                                    {{ old('location_id', $item->location_id) == $location->id ? 'selected' : '' }}>
                                    {{ $location->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('location_id')
                            <p class="text-xs text-red-600 mt-1.5 flex items-center">
                                <span class="material-icons-round text-xs mr-1">error</span>{{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Kategori -->
                    <div>
                        <label for="category_id" class="block text-sm font-medium text-gray-700 mb-2">Kategori</label>
                        <select name="category_id" id="category_id"
                                class="block w-full border rounded-md px-4 py-2.5 shadow-sm border-gray-300 bg-white focus:ring-blue-100 focus:border-blue-400 transition duration-150"
                                required>
                            <option value="">Pilih Kategori</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}"
                                    {{ old('category_id', $item->category_id) == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <p class="text-xs text-red-600 mt-1.5 flex items-center">
                                <span class="material-icons-round text-xs mr-1">error</span>{{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Tipe -->
                    <div>
                        <label for="type" class="block text-sm font-medium text-gray-700 mb-2">Tipe</label>
                        <select name="type" id="type"
                                class="block w-full border rounded-md px-4 py-2.5 shadow-sm border-gray-300 bg-white focus:ring-blue-100 focus:border-blue-400 transition duration-150"
                                required>
                            <option value="">Pilih Tipe</option>
                            <option value="reusable" {{ old('type', $item->type) === 'reusable' ? 'selected' : '' }}>Reusable</option>
                            <option value="non-reusable" {{ old('type', $item->type) === 'non-reusable' ? 'selected' : '' }}>Non-Reusable</option>
                        </select>
                        @error('type')
                            <p class="text-xs text-red-600 mt-1.5 flex items-center">
                                <span class="material-icons-round text-xs mr-1">error</span>{{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Gambar -->
                    <div class="mt-6">
                        <label for="image" class="block text-sm font-medium text-gray-700 mb-2">Gambar</label>
                        <input type="file" name="image" id="image"
                            class="block w-full text-sm text-gray-500 file:border file:border-gray-300 file:rounded-md file:bg-gray-100 file:text-gray-700 hover:file:bg-gray-200">
                        @error('image')
                            <p class="text-xs text-red-600 mt-1.5 flex items-center">
                                <span class="material-icons-round text-xs mr-1">error</span>{{ $message }}</p>
                        @enderror

                        @if ($item->image)
                            <p class="text-sm mt-2">
                                Gambar saat ini:
                                <a href="{{ asset('storage/'.$item->image) }}" target="_blank" class="underline text-blue-600">
                                    {{ $item->image }}
                                </a>
                            </p>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Buttons -->
            <div class="flex justify-between items-center pt-6">
                <a href="{{ route('items.index') }}"
                   class="inline-flex items-center text-sm bg-gray-200 text-gray-600 hover:text-gray-800 font-medium hover:bg-gray-100 rounded-md px-4 py-2 transition-all">
                    <span class="material-icons-round text-base mr-2">arrow_back</span>
                    Kembali
                </a>

                <button type="submit"
                        class="inline-flex items-center bg-gradient-to-br from-green-600 to-green-500 hover:from-green-700 hover:to-green-600 text-white font-medium rounded-md px-5 py-2.5 text-sm transition-all shadow-sm hover:shadow-md">
                    <span class="material-icons-round text-base mr-2">save</span>
                    Perbarui Barang
                </button>
            </div>
        </form>
    </div>
@endsection
