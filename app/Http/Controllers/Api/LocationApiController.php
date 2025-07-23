<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Location;
use Illuminate\Http\Request;

class LocationApiController extends Controller
{
    public function index()
    {
        return response()->json(['data' => Location::all()]);
    }

    public function show(Location $location)
    {
        return response()->json(['data' => $location]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255'
        ]);

        $location = Location::create($validated);

        return response()->json(['message' => 'Lokasi berhasil ditambahkan.', 'data' => $location], 201);
    }

    public function update(Request $request, Location $location)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:locations,name,' . $location->id
        ]);

        $location->update($validated);

        return response()->json(['message' => 'Lokasi berhasil diperbarui.', 'data' => $location]);
    }

    public function destroy(Location $location)
    {
        $location->delete();

        return response()->json(['message' => 'Lokasi berhasil dihapus.']);
    }
}
