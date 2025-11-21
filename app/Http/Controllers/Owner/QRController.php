<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class QRController extends Controller
{
    public function generate(Restaurant $restaurant)
    {
        // Ensure the authenticated user owns this restaurant
        if ($restaurant->user_id !== auth()->id()) {
            abort(403);
        }

        $url = route('restaurants.menu', $restaurant->slug);

        return view('owner.qr.generate', compact('restaurant', 'url'));
    }
}
