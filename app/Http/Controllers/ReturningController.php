<?php

namespace App\Http\Controllers;

use App\Models\Borrow;
use App\Models\Returning;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReturningController extends Controller
{
   public function index()
{
    $returnings = Returning::with(['user:id,name,email', 'borrow:id,item_id,borrow_start,borrow_end,status', 'item:id,name'])
        ->orderByDesc('return_date')
        ->get();

    return view('returnings.index', compact('returnings'));
}


    public function show(Returning $returning)
    {
        $returning->load(['user', 'borrow', 'item']);
        return view('returnings.show', compact('returning'));
    }

    public function create()
    {
        $borrows = Borrow::with('item')->whereDoesntHave('returnings')->get();
        return view('returnings.create', compact('borrows'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'borrow_id'   => 'required|exists:borrows,id',
            'description' => 'nullable|string|max:255',
        ]);

        $borrow = Borrow::with('item')->findOrFail($validated['borrow_id']);

        Returning::create([
            'user_id'     => Auth::id(),
            'borrow_id'   => $borrow->id,
            'item_id'     => $borrow->item_id,
            'return_date' => now(),
            'description' => $validated['description'] ?? '',
        ]);

        return redirect()->route('returnings.index')->with('success', 'Barang berhasil dikembalikan.');
    }
}
