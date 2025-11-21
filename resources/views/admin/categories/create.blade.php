@extends('layouts.admin')
@section('title', 'Yeni Kategori')
@section('page-title', 'Yeni Kategori Ekle')
@section('content')
<div class="max-w-2xl">
    <form action="{{ route('admin.categories.store') }}" method="POST" enctype="multipart/form-data" class="card p-8">
        @csrf
        <div class="mb-6">
            <label class="block text-gray-900 text-sm font-bold mb-2">
                <i class="fas fa-tag text-gray-400 mr-1"></i> Kategori Adı *
            </label>
            <input type="text" name="name" value="{{ old('name') }}" required
                   class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:border-gray-900 focus:ring-2 focus:ring-gray-900/10">
            @error('name')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
        </div>

        <div class="mb-6">
            <label class="block text-gray-900 text-sm font-bold mb-2">
                <i class="fas fa-image text-gray-400 mr-1"></i> Kategori Görseli
            </label>
            <input type="file" name="image" accept="image/*"
                   class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:border-gray-900 focus:ring-2 focus:ring-gray-900/10">
            <p class="text-xs text-gray-500 mt-1">Maksimum 2MB, JPG, PNG veya GIF. Menüde kategori başlığında görüntülenecektir.</p>
            @error('image')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
        </div>

        <div class="mb-6">
            <label class="block text-gray-900 text-sm font-bold mb-2">
                <i class="fas fa-sort text-gray-400 mr-1"></i> Sıra *
            </label>
            <input type="number" name="order" value="{{ old('order', 0) }}" required min="0"
                   class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:border-gray-900 focus:ring-2 focus:ring-gray-900/10">
            @error('order')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
        </div>

        <div class="flex items-center justify-between pt-4 border-t border-gray-200">
            <a href="{{ route('admin.categories.index') }}"
               class="px-6 py-2.5 text-gray-700 border-2 border-gray-300 rounded-lg hover:border-gray-900 hover:bg-gray-50 font-semibold transition-colors">
                <i class="fas fa-times mr-2"></i>İptal
            </a>
            <button type="submit"
                    class="px-6 py-2.5 bg-gray-900 text-white rounded-lg hover:bg-gray-800 font-semibold transition-colors">
                <i class="fas fa-save mr-2"></i>Kaydet
            </button>
        </div>
    </form>
</div>
@endsection
