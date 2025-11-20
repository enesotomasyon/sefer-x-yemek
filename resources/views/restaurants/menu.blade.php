@extends('layouts.public')

@section('title', $restaurant->name . ' - Menü')

@section('content')
<div class="bg-white shadow-sm mb-8">
    <div class="container mx-auto px-4 py-8">
        <div class="flex items-center space-x-6">
            @if($restaurant->logo)
            <img src="{{ asset('storage/' . $restaurant->logo) }}"
                 alt="{{ $restaurant->name }}"
                 class="w-24 h-24 rounded-full object-cover">
            @else
            <div class="w-24 h-24 rounded-full bg-gradient-to-br from-orange-400 to-yellow-400 flex items-center justify-center">
                <span class="text-3xl font-bold text-white">{{ substr($restaurant->name, 0, 1) }}</span>
            </div>
            @endif

            <div class="flex-1">
                <h1 class="text-3xl font-bold text-gray-800 mb-2">{{ $restaurant->name }}</h1>
                @if($restaurant->description)
                <p class="text-gray-600">{{ $restaurant->description }}</p>
                @endif

                @if($restaurant->address)
                <p class="text-sm text-gray-500 mt-2">
                    <svg class="inline w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                    {{ $restaurant->address }}
                </p>
                @endif

                @if($restaurant->phone)
                <p class="text-sm text-gray-500 mt-1">
                    <svg class="inline w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                    </svg>
                    {{ $restaurant->phone }}
                </p>
                @endif
            </div>
        </div>
    </div>
</div>

<div class="container mx-auto px-4 py-8">
    @if($categories->count() > 0)
        @foreach($categories as $category)
        <div class="mb-12">
            <h2 class="text-2xl font-bold text-gray-800 mb-6 pb-2 border-b-2 border-primary">
                {{ $category->name }}
            </h2>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($category->products as $product)
                <a href="{{ route('products.show', $product) }}"
                   class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition-shadow">
                    @if($product->image)
                    <img src="{{ asset('storage/' . $product->image) }}"
                         alt="{{ $product->name }}"
                         class="w-full h-48 object-cover">
                    @else
                    <div class="w-full h-48 bg-gradient-to-br from-orange-200 to-yellow-200 flex items-center justify-center">
                        <svg class="w-16 h-16 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                    </div>
                    @endif

                    <div class="p-4">
                        <h3 class="text-lg font-bold text-gray-800 mb-2">{{ $product->name }}</h3>
                        @if($product->description)
                        <p class="text-gray-600 text-sm mb-3 line-clamp-2">{{ $product->description }}</p>
                        @endif

                        <div class="flex items-center justify-between">
                            <span class="text-2xl font-bold text-primary">
                                {{ number_format($product->price, 2) }} ₺
                            </span>
                            <span class="text-sm text-secondary font-semibold">Detay →</span>
                        </div>
                    </div>
                </a>
                @endforeach
            </div>
        </div>
        @endforeach
    @else
        <div class="text-center py-12">
            <p class="text-gray-500 text-lg">Bu restoranda henüz ürün bulunmamaktadır.</p>
        </div>
    @endif

    <div class="mt-8 text-center">
        <a href="{{ route('home') }}" class="inline-flex items-center text-primary hover:text-orange-700">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
            Ana Sayfaya Dön
        </a>
    </div>
</div>
@endsection
