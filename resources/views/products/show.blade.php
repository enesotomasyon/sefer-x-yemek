@extends('layouts.public')

@section('title', $product->name . ' - ' . $product->restaurant->name)

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-4xl mx-auto">
        <!-- Breadcrumb -->
        <div class="mb-6 text-sm text-gray-500">
            <a href="{{ route('home') }}" class="hover:text-primary">Ana Sayfa</a>
            <span class="mx-2">›</span>
            <a href="{{ route('restaurants.menu', $product->restaurant) }}" class="hover:text-primary">
                {{ $product->restaurant->name }}
            </a>
            <span class="mx-2">›</span>
            <span class="text-gray-700">{{ $product->name }}</span>
        </div>

        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
            <div class="md:flex">
                <!-- Product Image -->
                <div class="md:w-1/2">
                    @if($product->image)
                    <img src="{{ asset('storage/' . $product->image) }}"
                         alt="{{ $product->name }}"
                         class="w-full h-96 object-cover">
                    @else
                    <div class="w-full h-96 bg-gradient-to-br from-orange-200 to-yellow-200 flex items-center justify-center">
                        <svg class="w-32 h-32 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                    </div>
                    @endif
                </div>

                <!-- Product Details -->
                <div class="md:w-1/2 p-8">
                    <div class="mb-4">
                        <span class="inline-block px-3 py-1 text-sm font-semibold text-secondary border border-secondary rounded-full">
                            {{ $product->category->name ?? 'Diğer' }}
                        </span>
                    </div>

                    <h1 class="text-3xl font-bold text-gray-800 mb-4">{{ $product->name }}</h1>

                    @if($product->description)
                    <p class="text-gray-600 mb-6 leading-relaxed">{{ $product->description }}</p>
                    @endif

                    <div class="mb-6">
                        <span class="text-4xl font-bold text-primary">
                            {{ number_format($product->price, 2) }} ₺
                        </span>
                    </div>

                    <!-- Restaurant Info -->
                    <div class="border-t pt-6">
                        <h3 class="text-sm font-semibold text-gray-500 mb-3">RESTORAN BİLGİLERİ</h3>
                        <div class="flex items-center space-x-3 mb-3">
                            @if($product->restaurant->logo)
                            <img src="{{ asset('storage/' . $product->restaurant->logo) }}"
                                 alt="{{ $product->restaurant->name }}"
                                 class="w-12 h-12 rounded-full object-cover">
                            @else
                            <div class="w-12 h-12 rounded-full bg-gradient-to-br from-orange-400 to-yellow-400 flex items-center justify-center">
                                <span class="text-lg font-bold text-white">{{ substr($product->restaurant->name, 0, 1) }}</span>
                            </div>
                            @endif
                            <div>
                                <p class="font-semibold text-gray-800">{{ $product->restaurant->name }}</p>
                                @if($product->restaurant->phone)
                                <p class="text-sm text-gray-500">{{ $product->restaurant->phone }}</p>
                                @endif
                            </div>
                        </div>

                        <a href="{{ route('restaurants.menu', $product->restaurant) }}"
                           class="inline-block text-primary hover:text-orange-700 font-semibold">
                            Tüm Menüyü Görüntüle →
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Back Button -->
        <div class="mt-8 text-center">
            <a href="{{ route('restaurants.menu', $product->restaurant) }}"
               class="inline-flex items-center text-primary hover:text-orange-700">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Menüye Dön
            </a>
        </div>
    </div>
</div>
@endsection
