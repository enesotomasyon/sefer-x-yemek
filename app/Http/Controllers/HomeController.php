<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Restaurant;
use App\Models\Slider;
use App\Models\Customer;
use App\Models\Category;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        // Müşteri kaydı oluştur
        Customer::create([
            'ip_address' => $request->ip(),
        ]);

        // Aktif slider'ları getir
        $sliders = Slider::where('is_active', true)
            ->orderBy('order')
            ->get();

        // Kategorileri getir (order'a göre sıralı)
        $categories = Category::orderBy('order')->get();

        // Popüler restoranları getir (ürün sayısına göre)
        $popularRestaurants = Restaurant::where('is_active', true)
            ->whereDate('subscription_end_date', '>=', now())
            ->withCount('products')
            ->orderBy('products_count', 'desc')
            ->limit(6)
            ->get();

        return view('home', compact('sliders', 'categories', 'popularRestaurants'));
    }
}
