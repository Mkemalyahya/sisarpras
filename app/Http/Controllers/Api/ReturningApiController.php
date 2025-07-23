<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Borrow;
use App\Models\Returning;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReturningApiController extends Controller
{
    public function index()
    {
        $returnings = Returning::with(['user', 'borrow', 'item'])->get();
        return response()->json(['data' => $returnings]);
    }

    public function show(Returning $returning)
    {
        $returning->load(['user', 'borrow', 'item']);
        return response()->json(['data' => $returning]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'borrow_id'   => 'required|exists:borrows,id',
            'description' => 'nullable|string|max:255',
        ]);

        $borrow = Borrow::with('item')->findOrFail($validated['borrow_id']);

        $returning = Returning::create([
            'user_id'     => Auth::id(),
            'borrow_id'   => $borrow->id,
            'item_id'     => $borrow->item_id,
            'return_date' => now(),
            'description' => $validated['description'] ?? '',
        ]);

        return response()->json([
            'status'  => true,
            'message' => 'Barang berhasil dikembalikan.',
            'data'    => $returning,
        ], );
    }
}
