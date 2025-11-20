<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Restaurant;
use App\Models\User;

class RestaurantController extends Controller
{
    public function index()
    {
        $restaurants = Restaurant::with('owner')->latest()->paginate(10);
        return view('admin.restaurants.index', compact('restaurants'));
    }

    public function create()
    {
        $owners = User::role('owner')->get();
        return view('admin.restaurants.create', compact('owners'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'owner_id' => 'required|exists:users,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'logo' => 'nullable|image|max:2048',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string',
            'subscription_end_date' => 'required|date',
            'is_active' => 'boolean',
        ]);

        if ($request->hasFile('logo')) {
            $validated['logo'] = $request->file('logo')->store('restaurants', 'public');
        }

        $validated['is_active'] = $request->has('is_active');

        Restaurant::create($validated);

        return redirect()->route('admin.restaurants.index')
            ->with('success', 'Restoran başarıyla oluşturuldu.');
    }

    public function edit(Restaurant $restaurant)
    {
        $owners = User::role('owner')->get();
        return view('admin.restaurants.edit', compact('restaurant', 'owners'));
    }

    public function update(Request $request, Restaurant $restaurant)
    {
        $validated = $request->validate([
            'owner_id' => 'required|exists:users,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'logo' => 'nullable|image|max:2048',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string',
            'subscription_end_date' => 'required|date',
            'is_active' => 'boolean',
        ]);

        if ($request->hasFile('logo')) {
            if ($restaurant->logo) {
                \Storage::disk('public')->delete($restaurant->logo);
            }
            $validated['logo'] = $request->file('logo')->store('restaurants', 'public');
        }

        $validated['is_active'] = $request->has('is_active');

        $restaurant->update($validated);

        return redirect()->route('admin.restaurants.index')
            ->with('success', 'Restoran başarıyla güncellendi.');
    }

    public function destroy(Restaurant $restaurant)
    {
        if ($restaurant->logo) {
            \Storage::disk('public')->delete($restaurant->logo);
        }

        $restaurant->delete();

        return redirect()->route('admin.restaurants.index')
            ->with('success', 'Restoran başarıyla silindi.');
    }
}
