@extends('layouts.public')

@section('title', $category->name . ' - Dijital Menü')

@section('content')
<!-- Category Hero Section -->
<section class="relative bg-gradient-to-br from-orange-50 via-white to-amber-50 py-12 border-b border-orange-100">
    <div class="max-w-7xl mx-auto px-4">
        <!-- Breadcrumb -->
        <nav class="flex items-center gap-2 text-sm mb-6">
            <a href="{{ route('home') }}" class="text-slate-600 hover:text-orange-600 transition-colors">Ana Sayfa</a>
            <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
            </svg>
            <span class="text-orange-600 font-semibold">{{ $category->name }}</span>
        </nav>

        <!-- Category Header -->
        <div class="flex items-center gap-6">
            <div class="w-20 h-20 rounded-2xl bg-gradient-to-br from-orange-500 to-orange-600 flex items-center justify-center shadow-lg">
                <i class="fas fa-utensils text-white text-3xl"></i>
            </div>
            <div>
                <h1 class="text-4xl md:text-5xl font-black text-slate-900 mb-2">{{ $category->name }}</h1>
                <p class="text-slate-600">
                    <span class="font-bold text-orange-600">{{ $products->total() }}</span> ürün bulundu
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Products Grid -->
<section class="py-12 bg-gradient-to-b from-white to-gray-50">
    <div class="max-w-7xl mx-auto px-4">
        @if($products->count() > 0)
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @foreach($products as $product)
            <div class="group bg-white rounded-2xl overflow-hidden border border-slate-200 hover:border-orange-500 transition-all duration-300 hover:shadow-2xl hover:-translate-y-2">
                <!-- Product Image -->
                <div class="relative h-56 overflow-hidden bg-gradient-to-br from-slate-100 to-slate-200">
                    @if($product->image)
                    <img src="{{ asset('storage/' . $product->image) }}"
                         alt="{{ $product->name }}"
                         class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-500">
                    @else
                    <div class="w-full h-full flex items-center justify-center">
                        <i class="fas fa-utensils text-6xl text-slate-400"></i>
                    </div>
                    @endif

                    <!-- Gradient Overlay -->
                    <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>

                    <!-- Price Badge -->
                    <div class="absolute top-4 right-4 bg-white/95 backdrop-blur-md px-4 py-2 rounded-xl shadow-lg">
                        <span class="text-orange-600 font-black text-lg">{{ number_format($product->price, 2) }} ₺</span>
                    </div>
                </div>

                <!-- Product Info -->
                <div class="p-5">
                    <h3 class="text-lg font-bold text-slate-900 mb-2 line-clamp-1 group-hover:text-orange-600 transition-colors">
                        {{ $product->name }}
                    </h3>

                    @if($product->description)
                    <p class="text-sm text-slate-600 mb-3 line-clamp-2 leading-relaxed">
                        {{ $product->description }}
                    </p>
                    @endif

                    <!-- Restaurant Info -->
                    <div class="flex items-center gap-2 pt-3 mt-3 border-t border-slate-100">
                        <div class="w-8 h-8 rounded-full bg-gradient-to-br from-orange-500 to-orange-600 flex items-center justify-center flex-shrink-0">
                            @if($product->restaurant->logo)
                            <img src="{{ asset('storage/' . $product->restaurant->logo) }}"
                                 alt="{{ $product->restaurant->name }}"
                                 class="w-full h-full rounded-full object-cover">
                            @else
                            <span class="text-white font-bold text-xs">{{ substr($product->restaurant->name, 0, 1) }}</span>
                            @endif
                        </div>
                        <div class="flex-1 min-w-0">
                            <a href="{{ route('restaurants.menu', $product->restaurant) }}"
                               class="text-sm font-semibold text-slate-700 hover:text-orange-600 transition-colors truncate block">
                                {{ $product->restaurant->name }}
                            </a>
                        </div>
                        <a href="{{ route('restaurants.menu', $product->restaurant) }}"
                           class="text-orange-600 hover:text-orange-700">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Pagination -->
        @if($products->hasPages())
        <div class="mt-12">
            {{ $products->links() }}
        </div>
        @endif

        @else
        <!-- Empty State -->
        <div class="text-center py-24">
            <div class="w-32 h-32 mx-auto mb-6 bg-gradient-to-br from-orange-50 to-amber-50 rounded-full flex items-center justify-center shadow-inner">
                <i class="fas fa-utensils text-6xl text-orange-600"></i>
            </div>
            <h3 class="text-2xl font-bold text-slate-900 mb-2">Henüz Ürün Yok</h3>
            <p class="text-slate-600 mb-8">Bu kategoride henüz ürün bulunmuyor.</p>
            <a href="{{ route('home') }}" class="btn-primary">
                Ana Sayfaya Dön
            </a>
        </div>
        @endif
    </div>
</section>
@endsection
