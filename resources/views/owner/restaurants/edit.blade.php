@extends('layouts.owner')
@section('title', 'Restoran Düzenle')
@section('page-title', 'Restoran Düzenle')
@section('content')
<div class="max-w-2xl">
    <form action="{{ route('owner.restaurants.update', $restaurant) }}" method="POST" enctype="multipart/form-data" class="bg-white rounded-lg shadow-md p-6">
        @csrf
        @method('PUT')
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Restoran Adı *</label>
            <input type="text" name="name" value="{{ old('name', $restaurant->name) }}" required class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:border-yellow-500">
            @error('name')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Açıklama</label>
            <textarea name="description" rows="3" class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:border-yellow-500">{{ old('description', $restaurant->description) }}</textarea>
            @error('description')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Logo</label>
            @if($restaurant->logo)
            <img src="{{ asset('storage/' . $restaurant->logo) }}" class="w-24 h-24 rounded object-cover mb-2">
            @endif
            <input type="file" name="logo" accept="image/*" class="w-full px-3 py-2 border border-gray-300 rounded">
            @error('logo')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Telefon</label>
            <input type="text" name="phone" value="{{ old('phone', $restaurant->phone) }}" class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:border-yellow-500">
            @error('phone')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Adres</label>
            <textarea name="address" rows="2" class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:border-yellow-500">{{ old('address', $restaurant->address) }}</textarea>
            @error('address')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
        </div>
        <div class="mb-4 p-4 bg-gray-50 rounded">
            <div class="flex items-center justify-between mb-2">
                <span class="text-sm text-gray-700 font-semibold">Abonelik Durumu:</span>
                <span class="text-sm {{ $restaurant->isSubscriptionActive() ? 'text-green-600' : 'text-red-600' }} font-bold">
                    {{ $restaurant->subscription_end_date?->format('d.m.Y') }}
                </span>
            </div>
            <div class="flex items-center justify-between">
                <span class="text-sm text-gray-700 font-semibold">Durum:</span>
                @if($restaurant->is_active)
                <span class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-800">Aktif</span>
                @else
                <span class="px-2 py-1 text-xs rounded-full bg-gray-100 text-gray-800">Admin Onayı Bekleniyor</span>
                @endif
            </div>
        </div>
        <div class="flex items-center justify-between">
            <a href="{{ route('owner.restaurants.index') }}" class="px-4 py-2 text-gray-700 bg-gray-200 rounded hover:bg-gray-300">İptal</a>
            <button type="submit" class="px-4 py-2 text-white rounded" style="background-color: var(--primary-yellow);">Güncelle</button>
        </div>
    </form>
</div>
@endsection
