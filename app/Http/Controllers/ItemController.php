<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Category;
use App\Models\Location;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ItemController extends Controller
{
    public function index()
    {
        $items = Item::with(['location', 'category'])->get();
        return view('items.index', compact('items'));
    }

    public function show(Item $item)
    {
        return view('items.show', compact('item'));
    }

    public function create()
    {
        $locations = Location::all();
        $categories = Category::all();
        return view('items.create', compact('locations', 'categories'));
    }

    public function edit(Item $item)
    {
        $locations = Location::all();
        $categories = Category::all();
        return view('items.edit', compact('item', 'locations', 'categories'));
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
            'image'       => 'nullable|image',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('items', 'public');
        }

        Item::create($validated);
        return redirect()->route('items.index')->with('success', 'Barang berhasil ditambahkan.');
    }

    public function update(Request $request, Item $item)
    {
            \Log::debug('Update item dipanggil');
        $validated = $request->validate([
            'name'        => 'required|string|max:255',
            'brand'       => 'required|string|max:255',
            'origin'      => 'required|string|max:255',
            'location_id' => 'required|exists:locations,id',
            'category_id' => 'required|exists:categories,id',
            'type'        => 'required|in:reusable,non-reusable',
            'quantity'    => 'required|integer|min:1',
            'image'       => 'nullable|image',
        ]);

        if ($request->hasFile('image')) {
            if ($item->image && Storage::disk('public')->exists($item->image)) {
                Storage::disk('public')->delete($item->image);
            }
            $validated['image'] = $request->file('image')->store('items', 'public');
        }

        $item->update($validated);
        return redirect()->route('items.index')->with('success', 'Barang berhasil diperbarui.');
    }

    public function destroy(Item $item)
    {
        if ($item->image && Storage::disk('public')->exists($item->image)) {
            Storage::disk('public')->delete($item->image);
        }

        $item->delete();
        return redirect()->route('items.index')->with('success', 'Barang berhasil dihapus.');
    }
}
