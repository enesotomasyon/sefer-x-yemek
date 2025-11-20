@extends('layouts.owner')
@section('title', 'Restoranlarım')
@section('page-title', 'Restoranlarım')
@section('content')
<div class="mb-4">
    <a href="{{ route('owner.restaurants.create') }}" class="px-4 py-2 text-white rounded" style="background-color: var(--primary-yellow);">Yeni Restoran Ekle</a>
</div>
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    @forelse($restaurants as $restaurant)
    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        @if($restaurant->logo)
        <img src="{{ asset('storage/' . $restaurant->logo) }}" class="w-full h-48 object-cover">
        @else
        <div class="w-full h-48 bg-gray-200 flex items-center justify-center">
            <span class="text-gray-400 text-4xl">🍽️</span>
        </div>
        @endif
        <div class="p-4">
            <h3 class="text-xl font-bold mb-2">{{ $restaurant->name }}</h3>
            <p class="text-gray-600 text-sm mb-3">{{ $restaurant->description }}</p>
            <div class="flex items-center justify-between mb-2">
                <span class="text-sm text-gray-500">Abonelik:</span>
                <span class="text-sm {{ $restaurant->isSubscriptionActive() ? 'text-green-600' : 'text-red-600' }}">
                    {{ $restaurant->subscription_end_date?->format('d.m.Y') }}
                </span>
            </div>
            <div class="flex items-center justify-between mb-4">
                <span class="text-sm text-gray-500">Durum:</span>
                @if($restaurant->is_active)
                <span class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-800">Aktif</span>
                @else
                <span class="px-2 py-1 text-xs rounded-full bg-gray-100 text-gray-800">Pasif</span>
                @endif
            </div>
            <div class="flex space-x-2">
                <a href="{{ route('owner.restaurants.edit', $restaurant) }}" class="flex-1 px-3 py-2 bg-blue-500 text-white text-sm rounded hover:bg-blue-600 text-center">Düzenle</a>
                <a href="{{ route('owner.qr.generate', $restaurant) }}" class="flex-1 px-3 py-2 text-white text-sm rounded hover:bg-yellow-600 text-center" style="background-color: var(--primary-yellow);">QR Kod</a>
            </div>
        </div>
    </div>
    @empty
    <div class="col-span-3 bg-white rounded-lg shadow-md p-8 text-center">
        <p class="text-gray-500 mb-4">Henüz restoran bulunmamaktadır.</p>
        <a href="{{ route('owner.restaurants.create') }}" class="inline-block px-4 py-2 text-white rounded" style="background-color: var(--primary-yellow);">İlk Restoranınızı Ekleyin</a>
    </div>
    @endforelse
</div>
<div class="mt-6">{{ $restaurants->links() }}</div>
@endsection
