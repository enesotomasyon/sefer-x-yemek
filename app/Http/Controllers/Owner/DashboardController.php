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
        $selectedRestaurantId = session('selected_restaurant_id');

        // Build queries based on selected restaurant
        $restaurantQuery = $owner->restaurants();
        $restaurantIds = $selectedRestaurantId
            ? [$selectedRestaurantId]
            : $owner->restaurants()->pluck('id');

        if ($selectedRestaurantId) {
            $restaurantQuery = $restaurantQuery->where('id', $selectedRestaurantId);
        }

        $stats = [
            'total_restaurants' => $selectedRestaurantId ? 1 : $owner->restaurants()->count(),
            'active_restaurants' => $restaurantQuery->where('is_active', true)->count(),
            'total_products' => Product::whereIn('restaurant_id', $restaurantIds)->count(),
            'active_products' => Product::whereIn('restaurant_id', $restaurantIds)->where('is_active', true)->count(),
            'in_stock_products' => Product::whereIn('restaurant_id', $restaurantIds)->where('in_stock', true)->count(),
            'total_branches' => Branch::whereIn('restaurant_id', $restaurantIds)->count(),
            'pending_branches' => Branch::whereIn('restaurant_id', $restaurantIds)
                ->where('is_approved', false)
                ->count(),
        ];

        $recentProducts = Product::whereIn('restaurant_id', $restaurantIds)
            ->with('restaurant')
            ->latest()
            ->take(5)
            ->get();

        return view('owner.dashboard', compact('stats', 'recentProducts'));
    }

    public function selectRestaurant(Request $request)
    {
        $restaurantId = $request->input('restaurant_id');

        // Validate that the restaurant belongs to the owner
        if ($restaurantId && !auth()->user()->restaurants()->where('id', $restaurantId)->exists()) {
            return back()->with('error', 'Bu işletmeye erişim yetkiniz yok.');
        }

        session(['selected_restaurant_id' => $restaurantId ?: null]);

        return back()->with('success', $restaurantId
            ? 'İşletme seçildi.'
            : 'Tüm işletmeler gösteriliyor.');
    }
}
