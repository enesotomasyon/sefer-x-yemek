@extends('layouts.admin')
@section('title', 'İşletme Sahibi Düzenle')
@section('page-title', 'İşletme Sahibi Düzenle')
@section('content')
<div class="max-w-2xl">
    <form action="{{ route('admin.owners.update', $owner) }}" method="POST" class="bg-white rounded-lg shadow-md p-6">
        @csrf
        @method('PUT')
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Ad Soyad *</label>
            <input type="text" name="name" value="{{ old('name', $owner->name) }}" required class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:border-orange-500">
            @error('name')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">E-posta *</label>
            <input type="email" name="email" value="{{ old('email', $owner->email) }}" required class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:border-orange-500">
            @error('email')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Yeni Şifre</label>
            <input type="password" name="password" class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:border-orange-500">
            <p class="text-gray-500 text-xs mt-1">Boş bırakırsanız şifre değiştirilmez.</p>
            @error('password')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2">Şifre Tekrar</label>
            <input type="password" name="password_confirmation" class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:border-orange-500">
        </div>
        <div class="mb-6 p-4 bg-gray-50 rounded">
            <div class="flex items-center justify-between">
                <span class="text-sm text-gray-700 font-semibold">Restoran Sayısı:</span>
                <span class="text-sm font-bold">{{ $owner->restaurants->count() }}</span>
            </div>
        </div>
        <div class="flex items-center justify-between">
            <a href="{{ route('admin.owners.index') }}" class="px-4 py-2 text-gray-700 bg-gray-200 rounded hover:bg-gray-300">İptal</a>
            <button type="submit" class="px-4 py-2 text-white rounded" style="background-color: var(--primary-orange);">Güncelle</button>
        </div>
    </form>
</div>
@endsection
