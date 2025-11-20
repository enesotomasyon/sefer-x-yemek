<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Slider;
use App\Models\Restaurant;
use App\Models\Product;

class SliderController extends Controller
{
    public function index()
    {
        $sliders = Slider::orderBy('order')->paginate(10);
        return view('admin.sliders.index', compact('sliders'));
    }

    public function create()
    {
        $restaurants = Restaurant::where('is_active', true)->get();
        $products = Product::where('is_active', true)->with('restaurant')->get();
        return view('admin.sliders.create', compact('restaurants', 'products'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'required|image|max:2048',
            'link_type' => 'required|in:product,restaurant',
            'link_id' => 'required|integer',
            'order' => 'required|integer|min:0',
            'is_active' => 'boolean',
        ]);

        $validated['image'] = $request->file('image')->store('sliders', 'public');
        $validated['is_active'] = $request->has('is_active');

        Slider::create($validated);

        return redirect()->route('admin.sliders.index')
            ->with('success', 'Slider başarıyla oluşturuldu.');
    }

    public function edit(Slider $slider)
    {
        $restaurants = Restaurant::where('is_active', true)->get();
        $products = Product::where('is_active', true)->with('restaurant')->get();
        return view('admin.sliders.edit', compact('slider', 'restaurants', 'products'));
    }

    public function update(Request $request, Slider $slider)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'nullable|image|max:2048',
            'link_type' => 'required|in:product,restaurant',
            'link_id' => 'required|integer',
            'order' => 'required|integer|min:0',
            'is_active' => 'boolean',
        ]);

        if ($request->hasFile('image')) {
            if ($slider->image) {
                \Storage::disk('public')->delete($slider->image);
            }
            $validated['image'] = $request->file('image')->store('sliders', 'public');
        }

        $validated['is_active'] = $request->has('is_active');

        $slider->update($validated);

        return redirect()->route('admin.sliders.index')
            ->with('success', 'Slider başarıyla güncellendi.');
    }

    public function destroy(Slider $slider)
    {
        if ($slider->image) {
            \Storage::disk('public')->delete($slider->image);
        }

        $slider->delete();

        return redirect()->route('admin.sliders.index')
            ->with('success', 'Slider başarıyla silindi.');
    }
}
