<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Restaurant;

class RestaurantController extends Controller
{
    public function index()
    {
        $restaurants = auth()->user()->restaurants()->latest()->paginate(10);
        return view('owner.restaurants.index', compact('restaurants'));
    }

    public function create()
    {
        return view('owner.restaurants.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'logo' => 'nullable|image|max:2048',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string',
        ]);

        if ($request->hasFile('logo')) {
            $validated['logo'] = $request->file('logo')->store('restaurants', 'public');
        }

        $validated['owner_id'] = auth()->id();
        $validated['is_active'] = false;
        $validated['subscription_end_date'] = now()->addDays(30);

        Restaurant::create($validated);

        return redirect()->route('owner.restaurants.index')
            ->with('success', 'Restoran başarıyla oluşturuldu. Admin onayı bekleniyor.');
    }

    public function edit(Restaurant $restaurant)
    {
        if ($restaurant->owner_id !== auth()->id()) {
            abort(403);
        }

        return view('owner.restaurants.edit', compact('restaurant'));
    }

    public function update(Request $request, Restaurant $restaurant)
    {
        if ($restaurant->owner_id !== auth()->id()) {
            abort(403);
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'logo' => 'nullable|image|max:2048',
            'header_video' => 'nullable|mimetypes:video/mp4,video/mpeg,video/quicktime,video/webm|max:51200', // 50MB max
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string',
        ]);

        if ($request->hasFile('logo')) {
            if ($restaurant->logo) {
                \Storage::disk('public')->delete($restaurant->logo);
            }
            $validated['logo'] = $request->file('logo')->store('restaurants', 'public');
        }

        if ($request->hasFile('header_video')) {
            if ($restaurant->header_video) {
                \Storage::disk('public')->delete($restaurant->header_video);
            }
            $validated['header_video'] = $request->file('header_video')->store('restaurants/videos', 'public');
        }

        // Handle video removal
        if ($request->has('remove_video') && $request->remove_video) {
            if ($restaurant->header_video) {
                \Storage::disk('public')->delete($restaurant->header_video);
            }
            $validated['header_video'] = null;
        }

        $restaurant->update($validated);

        return redirect()->route('owner.restaurants.index')
            ->with('success', 'Restoran başarıyla güncellendi.');
    }

    public function destroy(Restaurant $restaurant)
    {
        if ($restaurant->owner_id !== auth()->id()) {
            abort(403);
        }

        if ($restaurant->logo) {
            \Storage::disk('public')->delete($restaurant->logo);
        }

        if ($restaurant->header_video) {
            \Storage::disk('public')->delete($restaurant->header_video);
        }

        $restaurant->delete();

        return redirect()->route('owner.restaurants.index')
            ->with('success', 'Restoran başarıyla silindi.');
    }
}
