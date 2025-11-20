<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function show(Product $product)
    {
        // Ürün aktif mi ve restoranı aktif mi kontrol et
        if (!$product->is_active ||
            !$product->restaurant->is_active ||
            !$product->restaurant->isSubscriptionActive()) {
            abort(404, 'Bu ürün şu anda mevcut değil.');
        }

        $product->load('restaurant', 'category');

        return view('products.show', compact('product'));
    }
}
