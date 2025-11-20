@extends('layouts.owner')
@section('title', 'Ürün Düzenle')
@section('page-title', 'Ürün Düzenle')
@section('content')
<div class="max-w-2xl">
    <form action="{{ route('owner.products.update', $product) }}" method="POST" enctype="multipart/form-data" class="bg-white rounded-lg shadow-md p-6">
        @csrf
        @method('PUT')
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Restoran *</label>
            <select name="restaurant_id" required class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:border-yellow-500">
                <option value="">Seçiniz</option>
                @foreach($restaurants as $restaurant)
                <option value="{{ $restaurant->id }}" {{ old('restaurant_id', $product->restaurant_id) == $restaurant->id ? 'selected' : '' }}>{{ $restaurant->name }}</option>
                @endforeach
            </select>
            @error('restaurant_id')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Kategori</label>
            <select name="category_id" class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:border-yellow-500">
                <option value="">Seçiniz (Boş bırakılırsa "Diğer" kategorisine eklenir)</option>
                @foreach($categories as $category)
                <option value="{{ $category->id }}" {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                @endforeach
            </select>
            @error('category_id')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Ürün Adı *</label>
            <input type="text" name="name" value="{{ old('name', $product->name) }}" required class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:border-yellow-500">
            @error('name')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Açıklama</label>
            <textarea name="description" rows="3" class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:border-yellow-500">{{ old('description', $product->description) }}</textarea>
            @error('description')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Ürün Görseli</label>
            @if($product->image)
            <img src="{{ asset('storage/' . $product->image) }}" class="w-32 h-32 rounded object-cover mb-2">
            @endif
            <input type="file" name="image" accept="image/*" class="w-full px-3 py-2 border border-gray-300 rounded">
            @error('image')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Fiyat (₺) *</label>
            <input type="number" step="0.01" name="price" value="{{ old('price', $product->price) }}" required min="0" class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:border-yellow-500">
            @error('price')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
        </div>
        <div class="mb-6">
            <label class="inline-flex items-center">
                <input type="checkbox" name="is_available" value="1" {{ old('is_available', $product->is_available) ? 'checked' : '' }} class="form-checkbox h-5 w-5 text-yellow-500">
                <span class="ml-2 text-gray-700">Stokta Mevcut</span>
            </label>
        </div>
        <div class="flex items-center justify-between">
            <a href="{{ route('owner.products.index') }}" class="px-4 py-2 text-gray-700 bg-gray-200 rounded hover:bg-gray-300">İptal</a>
            <button type="submit" class="px-4 py-2 text-white rounded" style="background-color: var(--primary-yellow);">Güncelle</button>
        </div>
    </form>
</div>
@endsection
