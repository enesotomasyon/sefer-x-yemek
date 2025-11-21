@extends('layouts.owner')

@section('title', 'İşletme Paneli')
@section('page-title', 'Dashboard')

@section('content')
<!-- Stats Grid -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <!-- Total Restaurants -->
    <div class="card p-6">
        <div class="flex items-center justify-between mb-4">
            <div class="w-12 h-12 rounded-lg bg-gray-900 flex items-center justify-center">
                <i class="fas fa-store text-white text-xl"></i>
            </div>
        </div>
        <p class="text-sm text-gray-500 font-medium mb-1">İşletmelerim</p>
        <p class="text-3xl font-bold text-gray-900">{{ $stats['total_restaurants'] }}</p>
        <p class="text-xs text-gray-400 mt-2">{{ $stats['active_restaurants'] }} aktif</p>
    </div>

    <!-- Total Products -->
    <div class="card p-6">
        <div class="flex items-center justify-between mb-4">
            <div class="w-12 h-12 rounded-lg bg-gray-900 flex items-center justify-center">
                <i class="fas fa-box text-white text-xl"></i>
            </div>
        </div>
        <p class="text-sm text-gray-500 font-medium mb-1">Toplam Ürün</p>
        <p class="text-3xl font-bold text-gray-900">{{ $stats['total_products'] }}</p>
        <p class="text-xs text-gray-400 mt-2">{{ $stats['active_products'] }} aktif</p>
    </div>

    <!-- In Stock Products -->
    <div class="card p-6">
        <div class="flex items-center justify-between mb-4">
            <div class="w-12 h-12 rounded-lg bg-gray-900 flex items-center justify-center">
                <i class="fas fa-check-circle text-white text-xl"></i>
            </div>
        </div>
        <p class="text-sm text-gray-500 font-medium mb-1">Stokta Olan</p>
        <p class="text-3xl font-bold text-gray-900">{{ $stats['in_stock_products'] }}</p>
        <p class="text-xs text-gray-400 mt-2">Mevcut ürünler</p>
    </div>

    <!-- Total Branches -->
    <div class="card p-6">
        <div class="flex items-center justify-between mb-4">
            <div class="w-12 h-12 rounded-lg bg-gray-900 flex items-center justify-center">
                <i class="fas fa-code-branch text-white text-xl"></i>
            </div>
        </div>
        <p class="text-sm text-gray-500 font-medium mb-1">Toplam Şube</p>
        <p class="text-3xl font-bold text-gray-900">{{ $stats['total_branches'] }}</p>
        @if($stats['pending_branches'] > 0)
        <p class="text-xs text-gray-400 mt-2">{{ $stats['pending_branches'] }} onay bekliyor</p>
        @endif
    </div>
</div>

<!-- Recent Products -->
@if($recentProducts->count() > 0)
<div class="card p-6 mb-8">
    <div class="flex items-center justify-between mb-6 pb-4 border-b border-gray-100">
        <h3 class="text-lg font-bold text-gray-900">
            <i class="fas fa-clock text-gray-400 mr-2"></i>
            Son Eklenen Ürünler
        </h3>
        <a href="{{ route('owner.products.index') }}" class="text-sm font-medium text-gray-900 hover:text-gray-600 transition-colors">
            Tümünü Gör
            <i class="fas fa-arrow-right ml-1 text-xs"></i>
        </a>
    </div>
    <div class="space-y-3">
        @foreach($recentProducts as $product)
        <div class="flex items-center justify-between p-4 rounded-lg border border-gray-100 hover:border-gray-300 hover:shadow-sm transition-all">
            <div class="flex items-center gap-4 flex-1">
                @if($product->image)
                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-14 h-14 rounded-lg object-cover border border-gray-200">
                @else
                <div class="w-14 h-14 rounded-lg bg-gray-100 flex items-center justify-center border border-gray-200">
                    <i class="fas fa-utensils text-gray-400 text-lg"></i>
                </div>
                @endif
                <div class="flex-1 min-w-0">
                    <h4 class="font-semibold text-gray-900 truncate">{{ $product->name }}</h4>
                    <div class="flex items-center gap-3 mt-1">
                        <span class="text-sm text-gray-500">{{ $product->restaurant->name }}</span>
                        <span class="text-xs px-2 py-0.5 rounded border {{ $product->is_active ? 'border-gray-900 text-gray-900' : 'border-gray-300 text-gray-500' }}">
                            {{ $product->is_active ? 'Aktif' : 'Pasif' }}
                        </span>
                        <span class="text-xs px-2 py-0.5 rounded border {{ $product->in_stock ? 'border-gray-900 text-gray-900' : 'border-gray-300 text-gray-500' }}">
                            {{ $product->in_stock ? 'Stokta' : 'Tükendi' }}
                        </span>
                    </div>
                </div>
            </div>
            <div class="flex items-center gap-4">
                <span class="text-lg font-bold text-gray-900">{{ number_format($product->price, 2) }} ₺</span>
                <a href="{{ route('owner.products.edit', $product) }}" class="w-8 h-8 flex items-center justify-center rounded-lg border border-gray-200 hover:border-gray-900 hover:bg-gray-50 transition-all">
                    <i class="fas fa-edit text-gray-600"></i>
                </a>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endif

<!-- Quick Actions -->
<div class="card p-6">
    <h3 class="text-lg font-bold text-gray-900 mb-6 pb-4 border-b border-gray-100">
        <i class="fas fa-bolt text-gray-400 mr-2"></i>
        Hızlı İşlemler
    </h3>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
        <a href="{{ route('owner.products.create') }}" class="group flex items-center gap-3 p-4 rounded-lg border border-gray-200 hover:border-gray-900 hover:shadow-md transition-all">
            <div class="w-10 h-10 rounded-lg bg-gray-900 flex items-center justify-center group-hover:scale-105 transition-transform">
                <i class="fas fa-plus text-white text-sm"></i>
            </div>
            <span class="font-semibold text-gray-700 group-hover:text-gray-900">Ürün Ekle</span>
        </a>
        <a href="{{ route('owner.branches.create') }}" class="group flex items-center gap-3 p-4 rounded-lg border border-gray-200 hover:border-gray-900 hover:shadow-md transition-all">
            <div class="w-10 h-10 rounded-lg bg-gray-900 flex items-center justify-center group-hover:scale-105 transition-transform">
                <i class="fas fa-plus text-white text-sm"></i>
            </div>
            <span class="font-semibold text-gray-700 group-hover:text-gray-900">Şube Ekle</span>
        </a>
        <a href="{{ route('owner.restaurants.index') }}" class="group flex items-center gap-3 p-4 rounded-lg border border-gray-200 hover:border-gray-900 hover:shadow-md transition-all">
            <div class="w-10 h-10 rounded-lg bg-gray-900 flex items-center justify-center group-hover:scale-105 transition-transform">
                <i class="fas fa-edit text-white text-sm"></i>
            </div>
            <span class="font-semibold text-gray-700 group-hover:text-gray-900">İşletme Bilgileri</span>
        </a>
    </div>
</div>
@endsection
