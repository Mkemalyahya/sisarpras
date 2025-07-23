@extends('layouts.app')

@section('title', 'Daftar Pengembalian')

@section('content')
    <div class="max-w-7xl p-6 mx-auto bg-[#e8e8e8]">

        <!-- Header Section -->
        <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6 gap-4">
            <div>
                <h2 class="text-2xl font-bold text-gray-800">Daftar Pengembalian</h2>
                <p class="text-sm text-gray-500 mt-1">Kelola data pengembalian yang tersedia di sistem.</p>
            </div>
        </div>

        <!-- Table Section -->
        <div class="bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID Peminjaman</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Pengembali</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID Barang</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Barang</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Waktu Pengembalian</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Deskripsi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($returnings as $index => $returning)
                            <tr class="hover:bg-gray-50/95 transition duration-150">
                                <td class="px-6 py-4 text-sm text-gray-600">{{ $index + 1 }}</td>
                                <td class="px-6 py-4 text-sm text-gray-600">{{ $returning->borrow_id }}</td>
                                <td class="px-6 py-4 text-sm text-gray-600">{{ $returning->user->name }}</td>
                                <td class="px-6 py-4 text-sm text-gray-600">{{ $returning->item_id }}</td>
                                <td class="px-6 py-4 text-sm text-gray-600">{{ $returning->item->name }}</td>
                                <td class="px-6 py-4 text-sm text-gray-600">{{ $returning->return_date }}</td>
                                <td class="px-6 py-4 text-sm text-gray-600">{{ $returning->description }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
