@extends('layouts.owner')
@section('title', 'Yeni Şube')
@section('page-title', 'Yeni Şube Ekle')
@section('content')
<div class="max-w-2xl">
    <form action="{{ route('owner.branches.store') }}" method="POST" class="bg-white rounded-lg shadow-md p-6">
        @csrf
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Restoran *</label>
            <select name="restaurant_id" required class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:border-yellow-500">
                <option value="">Seçiniz</option>
                @foreach($restaurants as $restaurant)
                <option value="{{ $restaurant->id }}" {{ old('restaurant_id') == $restaurant->id ? 'selected' : '' }}>{{ $restaurant->name }}</option>
                @endforeach
            </select>
            @error('restaurant_id')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Şube Adı *</label>
            <input type="text" name="name" value="{{ old('name') }}" required class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:border-yellow-500">
            @error('name')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Adres *</label>
            <textarea name="address" rows="3" required class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:border-yellow-500">{{ old('address') }}</textarea>
            @error('address')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Telefon *</label>
            <input type="text" name="phone" value="{{ old('phone') }}" required class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:border-yellow-500">
            @error('phone')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
        </div>
        <div class="mb-6 bg-yellow-50 border border-yellow-200 rounded p-4">
            <p class="text-sm text-yellow-800">
                <strong>Not:</strong> Yeni eklenen şubeler admin onayından sonra aktif hale gelecektir.
            </p>
        </div>
        <div class="flex items-center justify-between">
            <a href="{{ route('owner.branches.index') }}" class="px-4 py-2 text-gray-700 bg-gray-200 rounded hover:bg-gray-300">İptal</a>
            <button type="submit" class="px-4 py-2 text-white rounded" style="background-color: var(--primary-yellow);">Kaydet</button>
        </div>
    </form>
</div>
@endsection
