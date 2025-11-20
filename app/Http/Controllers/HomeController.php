<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Restaurant;
use App\Models\Slider;
use App\Models\Customer;

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

        // Aktif ve aboneliği geçerli restoranları getir
        $restaurants = Restaurant::where('is_active', true)
            ->whereDate('subscription_end_date', '>=', now())
            ->with('products')
            ->get();

        return view('home', compact('sliders', 'restaurants'));
    }
}
