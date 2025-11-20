@extends('layouts.admin')
@section('title', 'Slider Düzenle')
@section('page-title', 'Slider Düzenle')
@section('content')
<div class="max-w-2xl">
    <form action="{{ route('admin.sliders.update', $slider) }}" method="POST" enctype="multipart/form-data" class="bg-white rounded-lg shadow-md p-6">
        @csrf
        @method('PUT')
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Başlık *</label>
            <input type="text" name="title" value="{{ old('title', $slider->title) }}" required class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:border-orange-500">
            @error('title')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Görsel</label>
            @if($slider->image)
            <img src="{{ asset('storage/' . $slider->image) }}" class="w-full h-32 object-cover rounded mb-2">
            @endif
            <input type="file" name="image" accept="image/*" class="w-full px-3 py-2 border border-gray-300 rounded">
            @error('image')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Link Tipi *</label>
            <select name="link_type" id="linkType" required class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:border-orange-500">
                <option value="">Seçiniz</option>
                <option value="restaurant" {{ old('link_type', $slider->link_type) === 'restaurant' ? 'selected' : '' }}>Restoran</option>
                <option value="product" {{ old('link_type', $slider->link_type) === 'product' ? 'selected' : '' }}>Ürün</option>
                <option value="external" {{ old('link_type', $slider->link_type) === 'external' ? 'selected' : '' }}>Dış Link</option>
            </select>
            @error('link_type')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
        </div>
        <div class="mb-4" id="restaurantSelect" style="display: none;">
            <label class="block text-gray-700 text-sm font-bold mb-2">Restoran</label>
            <select name="link_id_restaurant" class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:border-orange-500">
                <option value="">Seçiniz</option>
                @foreach($restaurants as $restaurant)
                <option value="{{ $restaurant->id }}" {{ old('link_id_restaurant', $slider->link_type === 'restaurant' ? $slider->link_id : null) == $restaurant->id ? 'selected' : '' }}>{{ $restaurant->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-4" id="productSelect" style="display: none;">
            <label class="block text-gray-700 text-sm font-bold mb-2">Ürün</label>
            <select name="link_id_product" class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:border-orange-500">
                <option value="">Seçiniz</option>
                @foreach($products as $product)
                <option value="{{ $product->id }}" {{ old('link_id_product', $slider->link_type === 'product' ? $slider->link_id : null) == $product->id ? 'selected' : '' }}>{{ $product->name }} ({{ $product->restaurant->name }})</option>
                @endforeach
            </select>
        </div>
        <div class="mb-4" id="externalLink" style="display: none;">
            <label class="block text-gray-700 text-sm font-bold mb-2">Dış Link (URL)</label>
            <input type="url" name="link_id_external" value="{{ old('link_id_external', $slider->link_type === 'external' ? $slider->link_id : '') }}" class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:border-orange-500" placeholder="https://example.com">
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Sıra *</label>
            <input type="number" name="order" value="{{ old('order', $slider->order) }}" required min="0" class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:border-orange-500">
            @error('order')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
        </div>
        <div class="mb-6">
            <label class="inline-flex items-center">
                <input type="checkbox" name="is_active" value="1" {{ old('is_active', $slider->is_active) ? 'checked' : '' }} class="form-checkbox h-5 w-5 text-orange-500">
                <span class="ml-2 text-gray-700">Aktif</span>
            </label>
        </div>
        <div class="flex items-center justify-between">
            <a href="{{ route('admin.sliders.index') }}" class="px-4 py-2 text-gray-700 bg-gray-200 rounded hover:bg-gray-300">İptal</a>
            <button type="submit" class="px-4 py-2 text-white rounded" style="background-color: var(--primary-orange);">Güncelle</button>
        </div>
    </form>
</div>
<script>
document.getElementById('linkType').addEventListener('change', function() {
    document.getElementById('restaurantSelect').style.display = 'none';
    document.getElementById('productSelect').style.display = 'none';
    document.getElementById('externalLink').style.display = 'none';
    if (this.value === 'restaurant') {
        document.getElementById('restaurantSelect').style.display = 'block';
    } else if (this.value === 'product') {
        document.getElementById('productSelect').style.display = 'block';
    } else if (this.value === 'external') {
        document.getElementById('externalLink').style.display = 'block';
    }
});
// Trigger change on page load
document.getElementById('linkType').dispatchEvent(new Event('change'));
</script>
@endsection
