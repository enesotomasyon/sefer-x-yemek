@extends('layouts.admin')
@section('title', 'Yeni Restoran')
@section('page-title', 'Yeni Restoran Ekle')
@section('content')
<div class="max-w-2xl">
    <form action="{{ route('admin.restaurants.store') }}" method="POST" enctype="multipart/form-data" class="bg-white rounded-lg shadow-md p-6">
        @csrf
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">İşletme Sahibi *</label>
            <select name="owner_id" required class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:border-orange-500">
                <option value="">Seçiniz</option>
                @foreach($owners as $owner)
                <option value="{{ $owner->id }}" {{ old('owner_id') == $owner->id ? 'selected' : '' }}>{{ $owner->name }} ({{ $owner->email }})</option>
                @endforeach
            </select>
            @error('owner_id')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Restoran Adı *</label>
            <input type="text" name="name" value="{{ old('name') }}" required class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:border-orange-500">
            @error('name')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Açıklama</label>
            <textarea name="description" rows="3" class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:border-orange-500">{{ old('description') }}</textarea>
            @error('description')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Logo</label>
            <input type="file" name="logo" accept="image/*" class="w-full px-3 py-2 border border-gray-300 rounded">
            @error('logo')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Telefon</label>
            <input type="text" name="phone" value="{{ old('phone') }}" class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:border-orange-500">
            @error('phone')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Adres</label>
            <textarea name="address" rows="2" class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:border-orange-500">{{ old('address') }}</textarea>
            @error('address')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Abonelik Bitiş Tarihi *</label>
            <input type="date" name="subscription_end_date" value="{{ old('subscription_end_date', now()->addMonths(1)->format('Y-m-d')) }}" required class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:border-orange-500">
            @error('subscription_end_date')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
        </div>
        <div class="mb-6">
            <label class="inline-flex items-center">
                <input type="checkbox" name="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }} class="form-checkbox h-5 w-5 text-orange-500">
                <span class="ml-2 text-gray-700">Aktif</span>
            </label>
        </div>
        <div class="flex items-center justify-between">
            <a href="{{ route('admin.restaurants.index') }}" class="px-4 py-2 text-gray-700 bg-gray-200 rounded hover:bg-gray-300">İptal</a>
            <button type="submit" class="px-4 py-2 text-white rounded" style="background-color: var(--primary-orange);">Kaydet</button>
        </div>
    </form>
</div>
@endsection
