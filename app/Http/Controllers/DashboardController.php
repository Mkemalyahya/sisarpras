<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Item;
use App\Models\Borrow;
use App\Models\Returning;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard', [
            'totalUsers' => User::count(),
            'totalItems' => Item::count(),
            'totalBorrows' => Borrow::whereNull('borrow_end')->count(),
            'totalReturns' => Returning::count(),
            'recentUsers' => User::latest()->take(5)->get(),
            'recentItems' => Item::with('category')->latest()->take(5)->get(),
            'recentBorrows' => Borrow::with(['user', 'item'])->latest()->take(5)->get(),
            'recentReturns' => Returning::with(['borrow.user', 'borrow.item'])->latest()->take(5)->get()
        ]);
    }
}
