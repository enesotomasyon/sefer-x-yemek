<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Restaurant;
use App\Models\Category;

class RestaurantController extends Controller
{
    public function menu(Restaurant $restaurant)
    {
        // Restoran aboneliği kontrolü
        if (!$restaurant->is_active || !$restaurant->isSubscriptionActive()) {
            abort(404, 'Bu restoran şu anda aktif değil.');
        }

        // Kategorileri ve ürünleri getir (aktif olanlar, stok durumuna bakılmaksızın)
        $categories = Category::orderBy('order')
            ->with([
                'products' => function ($query) use ($restaurant) {
                    $query->where('restaurant_id', $restaurant->id)
                        ->where('is_active', true);
                },
                'restaurantImages' => function ($query) use ($restaurant) {
                    $query->where('restaurant_id', $restaurant->id);
                }
            ])
            ->get()
            ->filter(function ($category) {
                // Kategori göster eğer:
                // 1. Ürünü varsa
                // 2. Veya resmi varsa (restaurant-specific veya default)
                $hasProducts = $category->products->count() > 0;
                $hasImage = $category->restaurantImages->count() > 0 || $category->image;

                return $hasProducts || $hasImage;
            });

        // "Diğer" kategorisi yoksa oluştur
        $otherCategory = Category::where('slug', 'diger')->first();

        // Kategorisi olmayan ürünleri "Diğer" kategorisine ata
        $restaurant->products()
            ->whereNull('category_id')
            ->update(['category_id' => $otherCategory?->id]);

        return view('restaurants.menu', compact('restaurant', 'categories'));
    }
}
