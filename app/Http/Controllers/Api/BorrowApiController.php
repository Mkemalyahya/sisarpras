<?php

namespace App\Http\Controllers\Api;
use App\Models\Borrow;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BorrowApiController extends Controller
{
     public function index()
    {
        $borrows = Borrow::with('item')
            ->select('id', 'user_id', 'item_id', 'borrow_start', 'borrow_end', 'status', 'description', 'quantity')
            ->get();

        return response()->json(['data' => $borrows]);
    }

    public function show(Borrow $borrow)
    {
        $borrow->load(['user', 'item']);
        return response()->json(['data' => $borrow]);
    }

 public function store(Request $request)
{
    $validated = $request->validate([
        'item_id'      => 'required|exists:items,id',
        'quantity'     => 'required|integer|min:1',
        'borrow_start' => 'required|date',
        'borrow_end'   => 'nullable|date|after:borrow_start',
        'description'  => 'nullable|string|max:255',
    ]);

    $item = \App\Models\Item::findOrFail($validated['item_id']);

    // ⛔ Cek stok cukup
    if ($validated['quantity'] > $item->quantity) {
        return response()->json([
            'status' => false,
            'message' => 'Stok tidak mencukupi. Sisa stok: ' . $item->quantity,
        ], 400);
    }

    // ✅ Kurangi stok
    $item->quantity -= $validated['quantity'];
    $item->save();

    $validated['user_id'] = auth()->id(); // atau Auth::id() jika tidak pakai helper
    $validated['status'] = 'pending';

    $borrow = \App\Models\Borrow::create($validated);

    return response()->json([
        'status' => true,
        'message' => 'Peminjaman berhasil diajukan.',
        'data' => $borrow,
    ]);
}


     public function approve(Borrow $borrow)
    {
        if ($borrow->status !== 'pending') {
            return response()->json(['error' => 'Peminjaman ini sudah diproses.'], 422);
        }

        $borrow->update(['status' => 'approved']);

        return response()->json(['message' => 'Peminjaman disetujui.']);
    }

    public function reject(Borrow $borrow)
    {
        if ($borrow->status !== 'pending') {
            return response()->json(['error' => 'Peminjaman ini sudah diproses.'], 422);
        }

        $borrow->update(['status' => 'rejected']);

        return response()->json(['message' => 'Peminjaman ditolak.']);
    }

      public function destroy(Borrow $borrow)
    {
        $borrow->load('item');

        if ($borrow->item->status === 'borrowed') {
            $borrow->item->update(['status' => 'available']);
        }

        $borrow->delete();

        return response()->json(['message' => 'Peminjaman dihapus.']);
    }
}
