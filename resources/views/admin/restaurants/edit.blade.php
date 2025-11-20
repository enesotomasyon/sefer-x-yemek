@extends('layouts.admin')
@section('title', 'Restoran Düzenle')
@section('page-title', 'Restoran Düzenle')
@section('content')
<div class="max-w-2xl">
    <form action="{{ route('admin.restaurants.update', $restaurant) }}" method="POST" enctype="multipart/form-data" class="bg-white rounded-lg shadow-md p-6">
        @csrf
        @method('PUT')
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">İşletme Sahibi *</label>
            <select name="owner_id" required class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:border-orange-500">
                @foreach($owners as $owner)
                <option value="{{ $owner->id }}" {{ $restaurant->owner_id == $owner->id ? 'selected' : '' }}>{{ $owner->name }} ({{ $owner->email }})</option>
                @endforeach
            </select>
            @error('owner_id')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Restoran Adı *</label>
            <input type="text" name="name" value="{{ old('name', $restaurant->name) }}" required class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:border-orange-500">
            @error('name')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Açıklama</label>
            <textarea name="description" rows="3" class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:border-orange-500">{{ old('description', $restaurant->description) }}</textarea>
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
            <input type="text" name="phone" value="{{ old('phone', $restaurant->phone) }}" class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:border-orange-500">
            @error('phone')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Adres</label>
            <textarea name="address" rows="2" class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:border-orange-500">{{ old('address', $restaurant->address) }}</textarea>
            @error('address')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Abonelik Bitiş Tarihi *</label>
            <input type="date" name="subscription_end_date" value="{{ old('subscription_end_date', $restaurant->subscription_end_date?->format('Y-m-d')) }}" required class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:border-orange-500">
            @error('subscription_end_date')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
        </div>
        <div class="mb-6">
            <label class="inline-flex items-center">
                <input type="checkbox" name="is_active" value="1" {{ old('is_active', $restaurant->is_active) ? 'checked' : '' }} class="form-checkbox h-5 w-5 text-orange-500">
                <span class="ml-2 text-gray-700">Aktif</span>
            </label>
        </div>
        <div class="flex items-center justify-between">
            <a href="{{ route('admin.restaurants.index') }}" class="px-4 py-2 text-gray-700 bg-gray-200 rounded hover:bg-gray-300">İptal</a>
            <button type="submit" class="px-4 py-2 text-white rounded" style="background-color: var(--primary-orange);">Güncelle</button>
        </div>
    </form>
</div>
@endsection
