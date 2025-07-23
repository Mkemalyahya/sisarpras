@extends('layouts.app')

@section('title', 'Daftar Peminjaman')

@section('content')
    <div class="max-w-7xl p-6 mx-auto bg-[#e8e8e8]">

        <!-- Header Section -->
        <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6 gap-4">
            <div>
                <h2 class="text-2xl font-bold text-gray-800">Daftar Peminjaman</h2>
                <p class="text-sm text-gray-500 mt-1">Kelola data peminjaman yang tersedia di sistem.</p>
            </div>
        </div>

        <!-- Table Section -->
        <div class="bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Peminjam</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID Barang</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Barang</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">qty</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Waktu Peminjaman</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Waktu Pengembalian</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($borrows as $index => $borrow)
                            <tr class="hover:bg-gray-50/95 transition duration-150">
                                <td class="px-6 py-4 text-sm text-gray-600">{{ $index + 1 }}</td>
                                <td class="px-6 py-4 text-sm text-gray-600">{{ $borrow->user->name }}</td>
                                <td class="px-6 py-4 text-sm text-gray-600">{{ $borrow->item->id }}</td>
                                <td class="px-6 py-4 text-sm text-gray-600">{{ $borrow->item->name }}</td>
                                <td class="px-6 py-4 text-sm text-gray-600">{{ $borrow->quantity }}</td>
                                <td class="px-6 py-4 text-sm text-gray-600">{{ $borrow->borrow_start }}</td>
                                <td class="px-6 py-4 text-sm text-gray-600">{{ $borrow->borrow_end }}</td>
                                <td class="px-6 py-4 text-sm text-gray-600">{{ ucfirst($borrow->status) }}</td>
                                <td class="px-6 py-4 text-sm text-gray-600">
                                    @if ($borrow->status === 'pending')
                                        <div class="flex items-center gap-3">
                                            <form action="{{ route('borrows.approve', $borrow) }}" method="POST">
                                                @csrf
                                                @method('PUT')

                                                <button type="submit" onclick="return confirm('Setujui peminjaman ini?')"
                                                    class="inline-flex items-center px-4 py-2 bg-green-100 text-green-700 hover:bg-green-200 rounded-md text-sm font-medium transition-all">
                                                    <span class="material-icons-round text-base mr-2">check_circle</span>
                                                    Setujui
                                                </button>
                                            </form>

                                            <form action="{{ route('borrows.reject', $borrow->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')

                                                <button type="submit" onclick="return confirm('Tolak peminjaman ini?')"
                                                    class="inline-flex items-center px-4 py-2 bg-red-100 text-red-700 hover:bg-red-200 rounded-md text-sm font-medium transition-all">
                                                    <span class="material-icons-round text-base mr-2">cancel</span>
                                                    Tolak
                                                </button>
                                            </form>
                                        </div>
                                    @endif

                                    <div class="flex gap-2">
                                        <form action="{{ route('borrows.destroy', $borrow) }}" method="POST"
                                            onsubmit="return confirm('Yakin ingin menghapus peminjaman ini?')">
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit"
                                                class="inline-flex items-center bg-red-100 text-red-700 hover:bg-red-200 font-medium rounded px-2 py-1 text-sm">
                                                <span class="material-icons-round text-base mr-1">delete</span>Hapus
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
