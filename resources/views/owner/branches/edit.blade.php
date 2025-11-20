@extends('layouts.owner')
@section('title', 'Şube Düzenle')
@section('page-title', 'Şube Düzenle')
@section('content')
<div class="max-w-2xl">
    <form action="{{ route('owner.branches.update', $branch) }}" method="POST" class="bg-white rounded-lg shadow-md p-6">
        @csrf
        @method('PUT')
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Restoran *</label>
            <select name="restaurant_id" required class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:border-yellow-500">
                <option value="">Seçiniz</option>
                @foreach($restaurants as $restaurant)
                <option value="{{ $restaurant->id }}" {{ old('restaurant_id', $branch->restaurant_id) == $restaurant->id ? 'selected' : '' }}>{{ $restaurant->name }}</option>
                @endforeach
            </select>
            @error('restaurant_id')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Şube Adı *</label>
            <input type="text" name="name" value="{{ old('name', $branch->name) }}" required class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:border-yellow-500">
            @error('name')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Adres *</label>
            <textarea name="address" rows="3" required class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:border-yellow-500">{{ old('address', $branch->address) }}</textarea>
            @error('address')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Telefon *</label>
            <input type="text" name="phone" value="{{ old('phone', $branch->phone) }}" required class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:border-yellow-500">
            @error('phone')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
        </div>
        <div class="mb-4 p-4 bg-gray-50 rounded">
            <div class="flex items-center justify-between">
                <span class="text-sm text-gray-700 font-semibold">Onay Durumu:</span>
                @if($branch->is_approved)
                <span class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-800">Onaylandı</span>
                @else
                <span class="px-2 py-1 text-xs rounded-full bg-yellow-100 text-yellow-800">Admin Onayı Bekleniyor</span>
                @endif
            </div>
        </div>
        <div class="flex items-center justify-between">
            <a href="{{ route('owner.branches.index') }}" class="px-4 py-2 text-gray-700 bg-gray-200 rounded hover:bg-gray-300">İptal</a>
            <button type="submit" class="px-4 py-2 text-white rounded" style="background-color: var(--primary-yellow);">Güncelle</button>
        </div>
    </form>
</div>
@endsection
