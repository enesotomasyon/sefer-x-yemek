@extends('layouts.public')

@section('title', 'Ana Sayfa - Dijital Menü')

@section('content')
<div class="container mx-auto px-4 py-8">
    <!-- Slider Section -->
    @if($sliders->count() > 0)
    <div class="mb-12">
        <div class="relative rounded-xl overflow-hidden shadow-lg" id="slider">
            @foreach($sliders as $index => $slider)
            <div class="slider-item {{ $index === 0 ? 'active' : 'hidden' }}" data-index="{{ $index }}">
                <a href="{{ $slider->getLink() }}">
                    <img src="{{ asset('storage/' . $slider->image) }}"
                         alt="{{ $slider->title }}"
                         class="w-full h-96 object-cover">
                    <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black to-transparent p-6">
                        <h2 class="text-3xl font-bold text-white">{{ $slider->title }}</h2>
                    </div>
                </a>
            </div>
            @endforeach

            <!-- Slider Navigation -->
            @if($sliders->count() > 1)
            <button class="absolute left-4 top-1/2 transform -translate-y-1/2 bg-white/80 hover:bg-white p-2 rounded-full" onclick="prevSlide()">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
            </button>
            <button class="absolute right-4 top-1/2 transform -translate-y-1/2 bg-white/80 hover:bg-white p-2 rounded-full" onclick="nextSlide()">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </button>
            @endif
        </div>
    </div>
    @endif

    <!-- Categories Section -->
    @if($categories->count() > 0)
    <div class="mb-12">
        <h2 class="text-3xl font-bold text-gray-800 mb-6">Kategoriler</h2>
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-6 gap-4">
            @foreach($categories as $category)
            <a href="{{ route('home') }}?category={{ $category->slug }}"
               class="bg-white rounded-lg shadow-md p-6 hover:shadow-xl transition-shadow text-center group">
                <div class="text-4xl mb-3">
                    @if($category->slug === 'pizza')
                        🍕
                    @elseif($category->slug === 'burger')
                        🍔
                    @elseif($category->slug === 'kebap')
                        🥙
                    @elseif($category->slug === 'tatli')
                        🍰
                    @elseif($category->slug === 'icecek')
                        🥤
                    @elseif($category->slug === 'salata')
                        🥗
                    @elseif($category->slug === 'corba')
                        🍲
                    @elseif($category->slug === 'makarna')
                        🍝
                    @else
                        🍽️
                    @endif
                </div>
                <h3 class="font-bold text-gray-800 group-hover:text-orange-500 transition-colors">
                    {{ $category->name }}
                </h3>
            </a>
            @endforeach
        </div>
    </div>
    @endif

    <!-- Popular Restaurants Section -->
    <div>
        <h2 class="text-3xl font-bold text-gray-800 mb-6">Popüler Restoranlar</h2>

        @if($popularRestaurants->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($popularRestaurants as $restaurant)
            <a href="{{ route('restaurants.menu', $restaurant) }}"
               class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-xl transition-shadow">
                @if($restaurant->logo)
                <img src="{{ asset('storage/' . $restaurant->logo) }}"
                     alt="{{ $restaurant->name }}"
                     class="w-full h-48 object-cover">
                @else
                <div class="w-full h-48 bg-gradient-to-br from-orange-400 to-yellow-400 flex items-center justify-center">
                    <span class="text-4xl font-bold text-white">{{ substr($restaurant->name, 0, 1) }}</span>
                </div>
                @endif

                <div class="p-4">
                    <h3 class="text-xl font-bold text-gray-800 mb-2">{{ $restaurant->name }}</h3>
                    @if($restaurant->description)
                    <p class="text-gray-600 text-sm mb-3 line-clamp-2">{{ $restaurant->description }}</p>
                    @endif

                    <div class="flex items-center justify-between">
                        <span class="text-sm text-gray-500">
                            {{ $restaurant->products_count }} ürün
                        </span>
                        <span class="text-orange-500 font-semibold">Menüyü Gör →</span>
                    </div>
                </div>
            </a>
            @endforeach
        </div>
        @else
        <div class="text-center py-12">
            <p class="text-gray-500 text-lg">Henüz aktif restoran bulunmamaktadır.</p>
        </div>
        @endif
    </div>
</div>

@push('scripts')
<script>
    let currentSlide = 0;
    const slides = document.querySelectorAll('.slider-item');
    const totalSlides = slides.length;

    function showSlide(index) {
        slides.forEach(slide => slide.classList.add('hidden'));
        slides[index].classList.remove('hidden');
    }

    function nextSlide() {
        currentSlide = (currentSlide + 1) % totalSlides;
        showSlide(currentSlide);
    }

    function prevSlide() {
        currentSlide = (currentSlide - 1 + totalSlides) % totalSlides;
        showSlide(currentSlide);
    }

    // Auto slide every 5 seconds
    setInterval(nextSlide, 5000);
</script>
@endpush
@endsection
