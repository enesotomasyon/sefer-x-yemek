@extends('layouts.owner')
@section('title', 'İşletme Düzenle')
@section('page-title', 'İşletme Düzenle')
@section('content')
<div class="max-w-3xl">
    <form action="{{ route('owner.restaurants.update', $restaurant) }}" method="POST" enctype="multipart/form-data" class="card p-8">
        @csrf
        @method('PUT')

        <div class="mb-6">
            <label class="block text-gray-900 text-sm font-bold mb-2">
                <i class="fas fa-store text-gray-400 mr-1"></i> İşletme Adı *
            </label>
            <input type="text" name="name" value="{{ old('name', $restaurant->name) }}" required
                   class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:border-gray-900 focus:ring-2 focus:ring-gray-900/10">
            @error('name')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
        </div>

        <div class="mb-6">
            <label class="block text-gray-900 text-sm font-bold mb-2">
                <i class="fas fa-align-left text-gray-400 mr-1"></i> Açıklama
            </label>
            <textarea name="description" rows="3"
                      class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:border-gray-900 focus:ring-2 focus:ring-gray-900/10">{{ old('description', $restaurant->description) }}</textarea>
            @error('description')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
        </div>

        <div class="mb-6">
            <label class="block text-gray-900 text-sm font-bold mb-2">
                <i class="fas fa-image text-gray-400 mr-1"></i> Logo
            </label>
            @if($restaurant->logo)
            <div class="mb-3">
                <img src="{{ asset('storage/' . $restaurant->logo) }}" class="w-32 h-32 rounded-lg object-cover border-2 border-gray-200">
            </div>
            @endif
            <input type="file" name="logo" accept="image/*"
                   class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:border-gray-900 focus:ring-2 focus:ring-gray-900/10">
            <p class="text-xs text-gray-500 mt-1">Maksimum 2MB, JPG, PNG veya GIF</p>
            @error('logo')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
        </div>

        <div class="mb-6">
            <label class="block text-gray-900 text-sm font-bold mb-2">
                <i class="fas fa-video text-gray-400 mr-1"></i> Menü Başlık Videosu
            </label>
            @if($restaurant->header_video)
            <div class="mb-3 relative">
                <video class="w-full max-w-md h-48 rounded-lg border-2 border-gray-200 object-cover" controls>
                    <source src="{{ asset('storage/' . $restaurant->header_video) }}" type="video/mp4">
                    Tarayıcınız video oynatmayı desteklemiyor.
                </video>
                <div class="mt-2">
                    <label class="inline-flex items-center gap-2 text-sm">
                        <input type="checkbox" name="remove_video" value="1" class="rounded border-gray-300 focus:ring-gray-900">
                        <span class="text-red-600 font-medium">Videoyu Kaldır</span>
                    </label>
                </div>
            </div>
            @endif
            <input type="file" name="header_video" accept="video/mp4,video/mpeg,video/quicktime,video/webm"
                   class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:border-gray-900 focus:ring-2 focus:ring-gray-900/10">
            <p class="text-xs text-gray-500 mt-1">Maksimum 50MB, MP4, MOV veya WEBM formatında. Menü sayfasının başlık kısmında görüntülenecektir.</p>
            @error('header_video')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
        </div>

        <div class="mb-6">
            <label class="block text-gray-900 text-sm font-bold mb-2">
                <i class="fas fa-phone text-gray-400 mr-1"></i> Telefon
            </label>
            <input type="text" name="phone" value="{{ old('phone', $restaurant->phone) }}"
                   class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:border-gray-900 focus:ring-2 focus:ring-gray-900/10">
            @error('phone')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
        </div>

        <div class="mb-6">
            <label class="block text-gray-900 text-sm font-bold mb-2">
                <i class="fas fa-map-marker-alt text-gray-400 mr-1"></i> Adres
            </label>
            <textarea name="address" rows="2"
                      class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:border-gray-900 focus:ring-2 focus:ring-gray-900/10">{{ old('address', $restaurant->address) }}</textarea>
            @error('address')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
        </div>

        <div class="mb-6 p-5 bg-gray-50 rounded-lg border border-gray-200">
            <div class="flex items-center justify-between mb-3 pb-3 border-b border-gray-200">
                <span class="text-sm text-gray-700 font-semibold">
                    <i class="fas fa-calendar-alt text-gray-400 mr-1"></i> Abonelik Durumu
                </span>
                <span class="text-sm {{ $restaurant->isSubscriptionActive() ? 'text-gray-900' : 'text-red-600' }} font-bold">
                    {{ $restaurant->subscription_end_date?->format('d.m.Y') }}
                </span>
            </div>
            <div class="flex items-center justify-between">
                <span class="text-sm text-gray-700 font-semibold">
                    <i class="fas fa-toggle-on text-gray-400 mr-1"></i> Durum
                </span>
                @if($restaurant->is_active)
                <span class="px-3 py-1 text-xs rounded border border-gray-900 text-gray-900 font-semibold">Aktif</span>
                @else
                <span class="px-3 py-1 text-xs rounded border border-gray-300 text-gray-500">Admin Onayı Bekleniyor</span>
                @endif
            </div>
        </div>

        <div class="flex items-center justify-between pt-4 border-t border-gray-200">
            <a href="{{ route('owner.restaurants.index') }}"
               class="px-6 py-2.5 text-gray-700 border-2 border-gray-300 rounded-lg hover:border-gray-900 hover:bg-gray-50 font-semibold transition-colors">
                <i class="fas fa-times mr-2"></i>İptal
            </a>
            <button type="submit"
                    class="px-6 py-2.5 bg-gray-900 text-white rounded-lg hover:bg-gray-800 font-semibold transition-colors">
                <i class="fas fa-save mr-2"></i>Güncelle
            </button>
        </div>
    </form>
</div>
@endsection
