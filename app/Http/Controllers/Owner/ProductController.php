<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Restaurant;
use App\Models\Category;

class ProductController extends Controller
{
    public function index()
    {
        $selectedRestaurantId = session('selected_restaurant_id');
        $restaurantIds = $selectedRestaurantId
            ? [$selectedRestaurantId]
            : auth()->user()->restaurants()->pluck('id');

        // Get products grouped by category
        $products = Product::whereIn('restaurant_id', $restaurantIds)
            ->with(['restaurant', 'category'])
            ->orderBy('category_id')
            ->orderBy('name')
            ->get()
            ->groupBy(function($product) {
                return $product->category ? $product->category->name : 'Kategorisiz';
            });

        return view('owner.products.index', compact('products'));
    }

    public function create()
    {
        $restaurants = auth()->user()->restaurants;
        $categories = Category::orderBy('order')->get();
        return view('owner.products.create', compact('restaurants', 'categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'restaurant_id' => 'required|exists:restaurants,id',
            'category_id' => 'nullable|exists:categories,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'image' => 'nullable|image|max:2048',
            'is_active' => 'boolean',
            'in_stock' => 'boolean',
        ]);

        $restaurant = Restaurant::findOrFail($validated['restaurant_id']);
        if ($restaurant->owner_id !== auth()->id()) {
            abort(403);
        }

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('products', 'public');
        }

        $validated['is_active'] = $request->has('is_active');
        $validated['in_stock'] = $request->has('in_stock');

        Product::create($validated);

        return redirect()->route('owner.products.index')
            ->with('success', 'Ürün başarıyla oluşturuldu.');
    }

    public function edit(Product $product)
    {
        if ($product->restaurant->owner_id !== auth()->id()) {
            abort(403);
        }

        $restaurants = auth()->user()->restaurants;
        $categories = Category::orderBy('order')->get();
        return view('owner.products.edit', compact('product', 'restaurants', 'categories'));
    }

    public function update(Request $request, Product $product)
    {
        if ($product->restaurant->owner_id !== auth()->id()) {
            abort(403);
        }

        $validated = $request->validate([
            'restaurant_id' => 'required|exists:restaurants,id',
            'category_id' => 'nullable|exists:categories,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'image' => 'nullable|image|max:2048',
            'is_active' => 'boolean',
            'in_stock' => 'boolean',
        ]);

        $restaurant = Restaurant::findOrFail($validated['restaurant_id']);
        if ($restaurant->owner_id !== auth()->id()) {
            abort(403);
        }

        if ($request->hasFile('image')) {
            if ($product->image) {
                \Storage::disk('public')->delete($product->image);
            }
            $validated['image'] = $request->file('image')->store('products', 'public');
        }

        $validated['is_active'] = $request->has('is_active');
        $validated['in_stock'] = $request->has('in_stock');

        $product->update($validated);

        return redirect()->route('owner.products.index')
            ->with('success', 'Ürün başarıyla güncellendi.');
    }

    public function destroy(Product $product)
    {
        if ($product->restaurant->owner_id !== auth()->id()) {
            abort(403);
        }

        if ($product->image) {
            \Storage::disk('public')->delete($product->image);
        }

        $product->delete();

        return redirect()->route('owner.products.index')
            ->with('success', 'Ürün başarıyla silindi.');
    }

    public function bulkUpdatePrices(Request $request)
    {
        $validated = $request->validate([
            'prices' => 'required|array',
            'prices.*' => 'required|numeric|min:0',
        ]);

        $selectedRestaurantId = session('selected_restaurant_id');
        $restaurantIds = $selectedRestaurantId
            ? [$selectedRestaurantId]
            : auth()->user()->restaurants()->pluck('id');

        foreach ($validated['prices'] as $productId => $price) {
            $product = Product::find($productId);

            if ($product && in_array($product->restaurant_id, $restaurantIds->toArray())) {
                $product->update(['price' => $price]);
            }
        }

        return redirect()->route('owner.products.index')
            ->with('success', 'Fiyatlar başarıyla güncellendi.');
    }

    public function increaseByPercentage(Request $request)
    {
        $validated = $request->validate([
            'percentage' => 'required|numeric|min:0|max:100',
        ]);

        $selectedRestaurantId = session('selected_restaurant_id');
        $restaurantIds = $selectedRestaurantId
            ? [$selectedRestaurantId]
            : auth()->user()->restaurants()->pluck('id');

        $products = Product::whereIn('restaurant_id', $restaurantIds)->get();

        foreach ($products as $product) {
            $newPrice = $product->price * (1 + $validated['percentage'] / 100);
            $product->update(['price' => $newPrice]);
        }

        return redirect()->route('owner.products.index')
            ->with('success', "Tüm ürünlerin fiyatları %{$validated['percentage']} artırıldı.");
    }
}
