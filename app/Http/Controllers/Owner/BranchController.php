<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Branch;
use App\Models\Restaurant;

class BranchController extends Controller
{
    public function index()
    {
        $selectedRestaurantId = session('selected_restaurant_id');
        $restaurantIds = $selectedRestaurantId
            ? [$selectedRestaurantId]
            : auth()->user()->restaurants()->pluck('id');

        $branches = Branch::whereIn('restaurant_id', $restaurantIds)
            ->with('restaurant')
            ->latest()
            ->paginate(15);

        return view('owner.branches.index', compact('branches'));
    }

    public function create()
    {
        $restaurants = auth()->user()->restaurants;
        return view('owner.branches.create', compact('restaurants'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'restaurant_id' => 'required|exists:restaurants,id',
            'name' => 'required|string|max:255',
            'address' => 'required|string',
            'phone' => 'nullable|string|max:20',
        ]);

        $restaurant = Restaurant::findOrFail($validated['restaurant_id']);
        if ($restaurant->owner_id !== auth()->id()) {
            abort(403);
        }

        $validated['is_approved'] = false;

        Branch::create($validated);

        return redirect()->route('owner.branches.index')
            ->with('success', 'Şube başarıyla oluşturuldu. Admin onayı bekleniyor.');
    }

    public function edit(Branch $branch)
    {
        if ($branch->restaurant->owner_id !== auth()->id()) {
            abort(403);
        }

        $restaurants = auth()->user()->restaurants;
        return view('owner.branches.edit', compact('branch', 'restaurants'));
    }

    public function update(Request $request, Branch $branch)
    {
        if ($branch->restaurant->owner_id !== auth()->id()) {
            abort(403);
        }

        $validated = $request->validate([
            'restaurant_id' => 'required|exists:restaurants,id',
            'name' => 'required|string|max:255',
            'address' => 'required|string',
            'phone' => 'nullable|string|max:20',
        ]);

        $restaurant = Restaurant::findOrFail($validated['restaurant_id']);
        if ($restaurant->owner_id !== auth()->id()) {
            abort(403);
        }

        $branch->update($validated);

        return redirect()->route('owner.branches.index')
            ->with('success', 'Şube başarıyla güncellendi.');
    }

    public function destroy(Branch $branch)
    {
        if ($branch->restaurant->owner_id !== auth()->id()) {
            abort(403);
        }

        $branch->delete();

        return redirect()->route('owner.branches.index')
            ->with('success', 'Şube başarıyla silindi.');
    }
}
