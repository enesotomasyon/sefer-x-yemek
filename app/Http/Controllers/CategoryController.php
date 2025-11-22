<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function show(Category $category)
    {
        // Get all products in this category with their restaurants
        $products = Product::where('category_id', $category->id)
            ->whereHas('restaurant', function ($query) {
                $query->where('is_active', true)
                    ->whereDate('subscription_end_date', '>=', now());
            })
            ->with(['restaurant', 'category'])
            ->orderBy('name')
            ->paginate(24);

        return view('categories.show', compact('category', 'products'));
    }
}
