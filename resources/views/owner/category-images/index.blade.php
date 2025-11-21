@extends('layouts.owner')
@section('title', 'Kategori Görselleri')
@section('page-title', 'Kategori Görselleri')
@section('content')
<div class="mb-6">
    <p class="text-gray-600">İşletmenizin menüsünde gösterilecek kategori görsellerini yönetin. Admin tarafından oluşturulmuş kategorilere özel görsel ekleyebilirsiniz.</p>
</div>

@if($categories->count() > 0)
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    @foreach($categories as $category)
    <div class="card p-6">
        <!-- Category Header -->
        <div class="mb-4 pb-4 border-b border-gray-200">
            <h3 class="text-lg font-bold text-gray-900 mb-1">{{ $category->name }}</h3>
            <p class="text-sm text-gray-500">
                <i class="fas fa-utensils mr-1"></i>
                {{ $category->products->count() }} Ürün
            </p>
        </div>

        @php
            $restaurantImage = $category->restaurantImages->first();
        @endphp

        @if($restaurantImage)
        <!-- Current Custom Image -->
        <div class="mb-4">
            <label class="block text-sm font-semibold text-gray-900 mb-2">
                <i class="fas fa-image text-gray-400 mr-1"></i> Özel Görseliniz
            </label>
            <div class="relative group">
                <img src="{{ asset('storage/' . $restaurantImage->image) }}"
                     class="w-full h-48 rounded-lg object-cover border-2 border-gray-200">
                <div class="absolute inset-0 bg-black/50 opacity-0 group-hover:opacity-100 transition-opacity rounded-lg flex items-center justify-center">
                    <form action="{{ route('owner.category-images.destroy', $category->id) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                                onclick="return confirm('Bu görseli kaldırmak istediğinizden emin misiniz?')"
                                class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 font-semibold transition-colors">
                            <i class="fas fa-trash mr-2"></i>Görseli Kaldır
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Update Form -->
        <form action="{{ route('owner.category-images.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="category_id" value="{{ $category->id }}">
            <div class="mb-4">
                <label class="block text-sm font-semibold text-gray-900 mb-2">
                    <i class="fas fa-sync text-gray-400 mr-1"></i> Görseli Değiştir
                </label>
                <input type="file" name="image" accept="image/*" required
                       class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:border-gray-900 focus:ring-2 focus:ring-gray-900/10">
            </div>
            <button type="submit"
                    class="w-full px-4 py-2.5 bg-gray-900 text-white rounded-lg hover:bg-gray-800 font-semibold transition-colors">
                <i class="fas fa-sync mr-2"></i>Görseli Güncelle
            </button>
        </form>

        @elseif($category->image)
        <!-- Default Admin Image -->
        <div class="mb-4">
            <label class="block text-sm font-semibold text-gray-900 mb-2">
                <i class="fas fa-image text-gray-400 mr-1"></i> Varsayılan Görsel
            </label>
            <img src="{{ asset('storage/' . $category->image) }}"
                 class="w-full h-48 rounded-lg object-cover border-2 border-gray-200 mb-2">
            <p class="text-xs text-gray-500">
                <i class="fas fa-info-circle mr-1"></i>
                Bu, admin tarafından belirlenen varsayılan görseldir. Kendi görselinizi yükleyebilirsiniz.
            </p>
        </div>

        <!-- Upload Form -->
        <form action="{{ route('owner.category-images.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="category_id" value="{{ $category->id }}">
            <div class="mb-4">
                <label class="block text-sm font-semibold text-gray-900 mb-2">
                    <i class="fas fa-upload text-gray-400 mr-1"></i> Özel Görsel Yükle
                </label>
                <input type="file" name="image" accept="image/*" required
                       class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:border-gray-900 focus:ring-2 focus:ring-gray-900/10">
            </div>
            <button type="submit"
                    class="w-full px-4 py-2.5 bg-gray-900 text-white rounded-lg hover:bg-gray-800 font-semibold transition-colors">
                <i class="fas fa-upload mr-2"></i>Görsel Yükle
            </button>
        </form>

        @else
        <!-- No Image -->
        <div class="mb-4">
            <div class="w-full h-48 rounded-lg bg-gradient-to-br from-gray-100 to-gray-200 flex items-center justify-center border-2 border-gray-200 mb-2">
                <i class="fas fa-utensils text-5xl text-gray-300"></i>
            </div>
            <p class="text-xs text-gray-500">
                <i class="fas fa-info-circle mr-1"></i>
                Bu kategori için henüz görsel yüklenmemiş.
            </p>
        </div>

        <!-- Upload Form -->
        <form action="{{ route('owner.category-images.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="category_id" value="{{ $category->id }}">
            <div class="mb-4">
                <label class="block text-sm font-semibold text-gray-900 mb-2">
                    <i class="fas fa-upload text-gray-400 mr-1"></i> Görsel Yükle
                </label>
                <input type="file" name="image" accept="image/*" required
                       class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:border-gray-900 focus:ring-2 focus:ring-gray-900/10">
            </div>
            <button type="submit"
                    class="w-full px-4 py-2.5 bg-gray-900 text-white rounded-lg hover:bg-gray-800 font-semibold transition-colors">
                <i class="fas fa-upload mr-2"></i>Görsel Yükle
            </button>
        </form>
        @endif

        <p class="text-xs text-gray-400 mt-3 pt-3 border-t border-gray-100">
            <i class="fas fa-ruler mr-1"></i>
            Maksimum 2MB, JPG, PNG veya GIF
        </p>
    </div>
    @endforeach
</div>
@else
<!-- Empty State -->
<div class="card p-12 text-center">
    <i class="fas fa-utensils text-7xl text-gray-200 mb-6"></i>
    <p class="text-gray-400 text-xl font-semibold">Henüz kategori bulunmamaktadır.</p>
    <p class="text-gray-400 text-sm mt-2">Kategoriler admin tarafından oluşturulur.</p>
</div>
@endif
@endsection
