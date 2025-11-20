@extends('layouts.owner')

@section('title', 'İşletme Paneli')
@section('page-title', 'Dashboard')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
    <!-- Total Restaurants -->
    <div class="bg-white rounded-lg shadow-md p-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-500 text-sm">Restoranlarım</p>
                <p class="text-3xl font-bold" style="color: var(--primary-orange);">{{ $stats['total_restaurants'] }}</p>
            </div>
            <div class="bg-orange-100 rounded-full p-3">
                <svg class="w-8 h-8" style="color: var(--primary-orange);" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                </svg>
            </div>
        </div>
        <p class="text-sm text-gray-600 mt-2">{{ $stats['active_restaurants'] }} aktif</p>
    </div>

    <!-- Total Products -->
    <div class="bg-white rounded-lg shadow-md p-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-500 text-sm">Toplam Ürün</p>
                <p class="text-3xl font-bold" style="color: var(--primary-yellow);">{{ $stats['total_products'] }}</p>
            </div>
            <div class="bg-yellow-100 rounded-full p-3">
                <svg class="w-8 h-8" style="color: var(--primary-yellow);" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                </svg>
            </div>
        </div>
    </div>

    <!-- Total Branches -->
    <div class="bg-white rounded-lg shadow-md p-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-500 text-sm">Toplam Şube</p>
                <p class="text-3xl font-bold text-blue-600">{{ $stats['total_branches'] }}</p>
            </div>
            <div class="bg-blue-100 rounded-full p-3">
                <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>
            </div>
        </div>
        @if($stats['pending_branches'] > 0)
        <p class="text-sm text-orange-600 mt-2">{{ $stats['pending_branches'] }} onay bekliyor</p>
        @endif
    </div>
</div>

<!-- Recent Restaurants -->
@if($recentRestaurants->count() > 0)
<div class="bg-white rounded-lg shadow-md p-6 mb-8">
    <h3 class="text-lg font-semibold mb-4">Son Restoranlarım</h3>
    <div class="space-y-4">
        @foreach($recentRestaurants as $restaurant)
        <div class="flex items-center justify-between p-4 border border-gray-200 rounded-lg hover:bg-gray-50">
            <div class="flex items-center space-x-4">
                @if($restaurant->logo)
                <img src="{{ asset('storage/' . $restaurant->logo) }}" alt="{{ $restaurant->name }}" class="w-12 h-12 rounded-full object-cover">
                @else
                <div class="w-12 h-12 rounded-full bg-gradient-to-br from-orange-400 to-yellow-400 flex items-center justify-center">
                    <span class="text-lg font-bold text-white">{{ substr($restaurant->name, 0, 1) }}</span>
                </div>
                @endif
                <div>
                    <h4 class="font-semibold">{{ $restaurant->name }}</h4>
                    <p class="text-sm text-gray-500">
                        @if($restaurant->is_active && $restaurant->isSubscriptionActive())
                        <span class="text-green-600">● Aktif</span>
                        @else
                        <span class="text-red-600">● Pasif</span>
                        @endif
                    </p>
                </div>
            </div>
            <div class="flex items-center space-x-2">
                <a href="{{ route('owner.restaurants.edit', $restaurant) }}" class="text-blue-600 hover:text-blue-800">
                    Düzenle
                </a>
                <a href="{{ route('restaurants.menu', $restaurant) }}" target="_blank" class="text-gray-600 hover:text-gray-800">
                    Görüntüle
                </a>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endif

<!-- Quick Actions -->
<div class="bg-white rounded-lg shadow-md p-6">
    <h3 class="text-lg font-semibold mb-4">Hızlı İşlemler</h3>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
        <a href="{{ route('owner.restaurants.create') }}" class="flex items-center p-4 border border-gray-200 rounded-lg hover:bg-gray-50 transition">
            <svg class="w-6 h-6 mr-3" style="color: var(--primary-orange);" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
            </svg>
            Restoran Ekle
        </a>
        <a href="{{ route('owner.products.create') }}" class="flex items-center p-4 border border-gray-200 rounded-lg hover:bg-gray-50 transition">
            <svg class="w-6 h-6 mr-3" style="color: var(--primary-yellow);" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
            </svg>
            Ürün Ekle
        </a>
        <a href="{{ route('owner.branches.create') }}" class="flex items-center p-4 border border-gray-200 rounded-lg hover:bg-gray-50 transition">
            <svg class="w-6 h-6 mr-3 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
            </svg>
            Şube Ekle
        </a>
        <a href="{{ route('owner.restaurants.index') }}" class="flex items-center p-4 border border-gray-200 rounded-lg hover:bg-gray-50 transition">
            <svg class="w-6 h-6 mr-3 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16" />
            </svg>
            Tüm Restoranlar
        </a>
    </div>
</div>
@endsection
