<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Restaurant;
use App\Models\RestaurantCategoryImage;

class CategoryImageController extends Controller
{
    public function index()
    {
        $restaurant = Restaurant::where('owner_id', auth()->id())
            ->where('id', session('selected_restaurant_id'))
            ->firstOrFail();

        // Get all categories with the restaurant's custom images
        $categories = Category::orderBy('order')
            ->with(['restaurantImages' => function ($query) use ($restaurant) {
                $query->where('restaurant_id', $restaurant->id);
            }])
            ->get();

        return view('owner.category-images.index', compact('categories', 'restaurant'));
    }

    public function store(Request $request)
    {
        $restaurant = Restaurant::where('owner_id', auth()->id())
            ->where('id', session('selected_restaurant_id'))
            ->firstOrFail();

        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'image' => 'required|image|max:2048',
        ]);

        // Check if image already exists for this category
        $categoryImage = RestaurantCategoryImage::where('restaurant_id', $restaurant->id)
            ->where('category_id', $validated['category_id'])
            ->first();

        // Handle image upload
        $imagePath = $request->file('image')->store('restaurant-categories', 'public');

        if ($categoryImage) {
            // Update existing
            if ($categoryImage->image) {
                \Storage::disk('public')->delete($categoryImage->image);
            }
            $categoryImage->update(['image' => $imagePath]);
        } else {
            // Create new
            RestaurantCategoryImage::create([
                'restaurant_id' => $restaurant->id,
                'category_id' => $validated['category_id'],
                'image' => $imagePath,
            ]);
        }

        return redirect()->route('owner.category-images.index')
            ->with('success', 'Kategori görseli başarıyla güncellendi.');
    }

    public function destroy($categoryId)
    {
        $restaurant = Restaurant::where('owner_id', auth()->id())
            ->where('id', session('selected_restaurant_id'))
            ->firstOrFail();

        $categoryImage = RestaurantCategoryImage::where('restaurant_id', $restaurant->id)
            ->where('category_id', $categoryId)
            ->firstOrFail();

        if ($categoryImage->image) {
            \Storage::disk('public')->delete($categoryImage->image);
        }

        $categoryImage->delete();

        return redirect()->route('owner.category-images.index')
            ->with('success', 'Kategori görseli başarıyla silindi.');
    }
}
