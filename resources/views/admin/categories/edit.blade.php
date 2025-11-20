@extends('layouts.admin')
@section('title', 'Kategori Düzenle')
@section('page-title', 'Kategori Düzenle')
@section('content')
<div class="max-w-2xl">
    <form action="{{ route('admin.categories.update', $category) }}" method="POST" class="bg-white rounded-lg shadow-md p-6">
        @csrf
        @method('PUT')
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Kategori Adı *</label>
            <input type="text" name="name" value="{{ old('name', $category->name) }}" required class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:border-orange-500">
            @error('name')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
        </div>
        <div class="mb-6">
            <label class="block text-gray-700 text-sm font-bold mb-2">Sıra *</label>
            <input type="number" name="order" value="{{ old('order', $category->order) }}" required min="0" class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:border-orange-500">
            @error('order')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
        </div>
        <div class="flex items-center justify-between">
            <a href="{{ route('admin.categories.index') }}" class="px-4 py-2 text-gray-700 bg-gray-200 rounded hover:bg-gray-300">İptal</a>
            <button type="submit" class="px-4 py-2 text-white rounded" style="background-color: var(--primary-orange);">Güncelle</button>
        </div>
    </form>
</div>
@endsection
