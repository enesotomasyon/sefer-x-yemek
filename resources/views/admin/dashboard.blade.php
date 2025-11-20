@extends('layouts.admin')

@section('title', 'Admin Dashboard')
@section('page-title', 'Dashboard')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
    <!-- Total Restaurants -->
    <div class="bg-white rounded-lg shadow-md p-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-500 text-sm">Toplam Restoran</p>
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

    <!-- Total Categories -->
    <div class="bg-white rounded-lg shadow-md p-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-500 text-sm">Toplam Kategori</p>
                <p class="text-3xl font-bold text-gray-700">{{ $stats['total_categories'] }}</p>
            </div>
            <div class="bg-gray-100 rounded-full p-3">
                <svg class="w-8 h-8 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                </svg>
            </div>
        </div>
    </div>

    <!-- Pending Branches -->
    <div class="bg-white rounded-lg shadow-md p-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-500 text-sm">Onay Bekleyen Şube</p>
                <p class="text-3xl font-bold text-red-600">{{ $stats['pending_branches'] }}</p>
            </div>
            <div class="bg-red-100 rounded-full p-3">
                <svg class="w-8 h-8 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
        </div>
        @if($stats['pending_branches'] > 0)
        <a href="{{ route('admin.branches.index') }}" class="text-sm text-red-600 hover:text-red-800 mt-2 inline-block">
            Şubeleri Görüntüle →
        </a>
        @endif
    </div>

    <!-- Total Customers -->
    <div class="bg-white rounded-lg shadow-md p-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-500 text-sm">Toplam Müşteri</p>
                <p class="text-3xl font-bold text-blue-600">{{ $stats['total_customers'] }}</p>
            </div>
            <div class="bg-blue-100 rounded-full p-3">
                <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                </svg>
            </div>
        </div>
    </div>
</div>

<!-- Quick Actions -->
<div class="bg-white rounded-lg shadow-md p-6">
    <h3 class="text-lg font-semibold mb-4">Hızlı İşlemler</h3>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
        <a href="{{ route('admin.restaurants.create') }}" class="flex items-center p-4 border border-gray-200 rounded-lg hover:bg-gray-50 transition">
            <svg class="w-6 h-6 mr-3" style="color: var(--primary-orange);" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
            </svg>
            Restoran Ekle
        </a>
        <a href="{{ route('admin.categories.create') }}" class="flex items-center p-4 border border-gray-200 rounded-lg hover:bg-gray-50 transition">
            <svg class="w-6 h-6 mr-3" style="color: var(--primary-yellow);" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
            </svg>
            Kategori Ekle
        </a>
        <a href="{{ route('admin.sliders.create') }}" class="flex items-center p-4 border border-gray-200 rounded-lg hover:bg-gray-50 transition">
            <svg class="w-6 h-6 mr-3 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
            </svg>
            Slider Ekle
        </a>
        <a href="{{ route('admin.restaurants.index') }}" class="flex items-center p-4 border border-gray-200 rounded-lg hover:bg-gray-50 transition">
            <svg class="w-6 h-6 mr-3 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16" />
            </svg>
            Tüm Restoranlar
        </a>
    </div>
</div>
@endsection
