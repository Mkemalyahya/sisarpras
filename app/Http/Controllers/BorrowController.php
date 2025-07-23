<?php

namespace App\Http\Controllers;

use App\Models\Borrow;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BorrowController extends Controller
{
    public function index()
    {
        $borrows = Borrow::with('item')->get();

        return view('borrowings.index', compact('borrows'));
    }

    public function show(Borrow $borrow)
    {
        $borrow->load(['user', 'item']);

        return view('borrowings.show', compact('borrow'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'item_id'      => 'required|exists:items,id',
            'borrow_start' => 'required|date',
            'borrow_end'   => 'nullable|date|after:borrow_start',
            'description'  => 'nullable|string|max:255',
            'quantity'     => 'required|integer|min:1',
        ]);

        $validated['user_id'] = Auth::id();
        $validated['status'] = 'pending';

        Borrow::create($validated);
          $item = \App\Models\Item::findOrFail($validated['item_id']);

   
    if ($validated['quantity'] > $item->quantity) {
        return response()->json([
            'status' => false,
            'message' => 'Stok tidak mencukupi. Sisa stok: ' . $item->quantity,
        ], 400);
    }


    $item->quantity -= $validated['quantity'];
    $item->save();

    $validated['user_id'] = auth()->id(); // atau Auth::id();
    $validated['status'] = 'pending';

    $borrow = \App\Models\Borrow::create($validated);

    return response()->json([
        'status' => true,
        'message' => 'Peminjaman berhasil diajukan.',
        'data' => $borrow,
    ]);

        return redirect()->route('borrows.index')->with('success', 'Peminjaman berhasil dibuat.');
    }

    public function approve(Borrow $borrow)
    {
        if ($borrow->status !== 'pending') {
            return redirect()->back()->withErrors(['error' => 'Peminjaman ini sudah diproses.']);
        }

        $borrow->update(['status' => 'approved']);

        return redirect()->route('borrows.index')->with('success', 'Peminjaman disetujui.');
    }

    public function reject(Borrow $borrow)
    {
        if ($borrow->status !== 'pending') {
            return redirect()->back()->withErrors(['error' => 'Peminjaman ini sudah diproses.']);
        }

        $borrow->update(['status' => 'rejected']);

        return redirect()->route('borrows.index')->with('success', 'Peminjaman ditolak.');
    }

    public function destroy(Borrow $borrow)
    {
        $borrow->load('item');

        if ($borrow->item->status === 'borrowed') {
            $borrow->item->update(['status' => 'available']);
        }

        $borrow->delete();

        return redirect()->route('borrows.index')->with('success', 'Peminjaman dihapus.');
    }
}
