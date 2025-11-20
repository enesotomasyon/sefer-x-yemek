<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Restaurant;
use App\Models\Product;
use App\Models\Branch;

class DashboardController extends Controller
{
    public function index()
    {
        $owner = auth()->user();

        $stats = [
            'total_restaurants' => $owner->restaurants()->count(),
            'active_restaurants' => $owner->restaurants()->where('is_active', true)->count(),
            'total_products' => Product::whereIn('restaurant_id', $owner->restaurants()->pluck('id'))->count(),
            'total_branches' => Branch::whereIn('restaurant_id', $owner->restaurants()->pluck('id'))->count(),
            'pending_branches' => Branch::whereIn('restaurant_id', $owner->restaurants()->pluck('id'))
                ->where('is_approved', false)
                ->count(),
        ];

        $recentRestaurants = $owner->restaurants()->latest()->take(5)->get();

        return view('owner.dashboard', compact('stats', 'recentRestaurants'));
    }
}
