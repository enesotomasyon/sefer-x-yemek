@extends('layouts.owner')
@section('title', 'Yeni Restoran')
@section('page-title', 'Yeni Restoran Ekle')
@section('content')
<div class="max-w-2xl">
    <form action="{{ route('owner.restaurants.store') }}" method="POST" enctype="multipart/form-data" class="bg-white rounded-lg shadow-md p-6">
        @csrf
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Restoran Adı *</label>
            <input type="text" name="name" value="{{ old('name') }}" required class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:border-yellow-500">
            @error('name')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Açıklama</label>
            <textarea name="description" rows="3" class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:border-yellow-500">{{ old('description') }}</textarea>
            @error('description')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Logo</label>
            <input type="file" name="logo" accept="image/*" class="w-full px-3 py-2 border border-gray-300 rounded">
            @error('logo')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Telefon</label>
            <input type="text" name="phone" value="{{ old('phone') }}" class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:border-yellow-500">
            @error('phone')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
        </div>
        <div class="mb-6">
            <label class="block text-gray-700 text-sm font-bold mb-2">Adres</label>
            <textarea name="address" rows="2" class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:border-yellow-500">{{ old('address') }}</textarea>
            @error('address')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
        </div>
        <div class="bg-yellow-50 border border-yellow-200 rounded p-4 mb-6">
            <p class="text-sm text-yellow-800">
                <strong>Not:</strong> Yeni eklenen restoranlar admin onayından sonra aktif hale gelecektir.
            </p>
        </div>
        <div class="flex items-center justify-between">
            <a href="{{ route('owner.restaurants.index') }}" class="px-4 py-2 text-gray-700 bg-gray-200 rounded hover:bg-gray-300">İptal</a>
            <button type="submit" class="px-4 py-2 text-white rounded" style="background-color: var(--primary-yellow);">Kaydet</button>
        </div>
    </form>
</div>
@endsection
