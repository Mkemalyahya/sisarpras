<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class ItemApiController extends Controller
{
    public function index()
    {
        $items = Item::with(['location', 'category'])
            ->where('quantity', '>', 0)
            ->where('status', 'available')
            ->get();

        return response()->json(['data' => $items]);
    }

    public function show(Item $item)
    {
        $item->load(['location', 'category']);
        return response()->json(['data' => $item]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'        => 'required|string|max:255',
            'brand'       => 'required|string|max:255',
            'origin'      => 'required|string|max:255',
            'location_id' => 'required|exists:locations,id',
            'category_id' => 'required|exists:categories,id',
            'type'        => 'required|in:reusable,non-reusable',
            'quantity'    => 'required|integer|min:1',
            'image'       => 'nullable|image|max:4096',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('items', 'public');
        }

        $item = Item::create($validated);
        return response()->json(['message' => 'Item created.', 'data' => $item], 201);
    }

    public function update(Request $request, Item $item)
    {
        $validated = $request->validate([
            'name'        => 'required|string|max:255',
            'brand'       => 'required|string|max:255',
            'origin'      => 'required|string|max:255',
            'location_id' => 'required|exists:locations,id',
            'category_id' => 'required|exists:categories,id',
            'type'        => 'required|in:reusable,non-reusable',
            'quantity'    => 'required|integer|min:1',
            'image'       => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('image')) {
            if ($item->image && Storage::disk('public')->exists($item->image)) {
                Storage::disk('public')->delete($item->image);
            }
            $validated['image'] = $request->file('image')->store('items', 'public');
        }

        $item->update($validated);
        return response()->json(['message' => 'Item updated.', 'data' => $item]);
    }

    public function destroy(Item $item)
    {
        if ($item->image && Storage::disk('public')->exists($item->image)) {
            Storage::disk('public')->delete($item->image);
        }

        $item->delete();
        return response()->json(['message' => 'Item deleted.']);
    }
}
