@extends('layouts.public')

@section('title', 'Ana Sayfa - Dijital Menü')

@section('content')
<!-- Hero Slider Section -->
@if($sliders->count() > 0)
<div class="relative bg-white mb-12">
    <div class="max-w-7xl mx-auto">
        <div class="relative h-[500px] overflow-hidden rounded-2xl" id="slider">
            @foreach($sliders as $index => $slider)
            <div class="slider-item absolute inset-0 transition-opacity duration-700 ease-in-out {{ $index === 0 ? 'opacity-100' : 'opacity-0' }}" data-index="{{ $index }}">
                <a href="{{ $slider->getLink() }}" class="block w-full h-full relative group">
                    <img src="{{ asset('storage/' . $slider->image) }}"
                         alt="{{ $slider->title }}"
                         class="w-full h-full object-cover transform transition-transform duration-700 group-hover:scale-105">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/20 to-transparent">
                        <div class="absolute bottom-0 left-0 right-0 p-8 md:p-12">
                            <h2 class="text-3xl md:text-5xl font-bold text-white mb-2 drop-shadow-lg">{{ $slider->title }}</h2>
                        </div>
                    </div>
                </a>
            </div>
            @endforeach

            <!-- Slider Navigation Arrows -->
            @if($sliders->count() > 1)
            <button onclick="prevSlide()" class="absolute left-4 top-1/2 -translate-y-1/2 bg-white/90 hover:bg-white p-3 rounded-full shadow-lg transition-all duration-200 hover:scale-110 z-10">
                <svg class="w-6 h-6 text-gray-800" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
            </button>
            <button onclick="nextSlide()" class="absolute right-4 top-1/2 -translate-y-1/2 bg-white/90 hover:bg-white p-3 rounded-full shadow-lg transition-all duration-200 hover:scale-110 z-10">
                <svg class="w-6 h-6 text-gray-800" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </button>

            <!-- Slider Dots -->
            <div class="absolute bottom-6 left-1/2 -translate-x-1/2 flex gap-2 z-10">
                @foreach($sliders as $index => $slider)
                <button onclick="goToSlide({{ $index }})" class="slider-dot w-3 h-3 rounded-full transition-all duration-300 {{ $index === 0 ? 'bg-white w-8' : 'bg-white/50 hover:bg-white/75' }}"></button>
                @endforeach
            </div>
            @endif
        </div>
    </div>
</div>
@endif

<div class="bg-gray-50 min-h-screen">
    <div class="max-w-7xl mx-auto px-4 py-8">

        <!-- Categories Section -->
        @if($categories->count() > 0)
        <div class="mb-16">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-2xl md:text-3xl font-bold text-gray-900">Kategoriler</h2>
                <button onclick="scrollCategories('right')" class="md:hidden text-gray-600 hover:text-gray-900">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </button>
            </div>

            <div class="relative">
                <div id="categories-container" class="flex gap-4 overflow-x-auto scrollbar-hide pb-4 scroll-smooth">
                    @foreach($categories as $category)
                    <a href="{{ route('home') }}?category={{ $category->slug }}"
                       class="flex-shrink-0 bg-white rounded-xl p-6 hover:shadow-lg transition-all duration-300 text-center group border border-gray-100 hover:border-red-100 min-w-[140px]">
                        <div class="text-4xl mb-3 text-gray-700 group-hover:text-red-500 transition-colors duration-300">
                            @if($category->slug === 'pizza')
                                <i class="fas fa-pizza-slice"></i>
                            @elseif($category->slug === 'burger')
                                <i class="fas fa-burger"></i>
                            @elseif($category->slug === 'kebap')
                                <i class="fas fa-meat"></i>
                            @elseif($category->slug === 'tatli')
                                <i class="fas fa-cake-candles"></i>
                            @elseif($category->slug === 'icecek')
                                <i class="fas fa-glass-water"></i>
                            @elseif($category->slug === 'salata')
                                <i class="fas fa-bowl-food"></i>
                            @elseif($category->slug === 'corba')
                                <i class="fas fa-bowl-hot"></i>
                            @elseif($category->slug === 'makarna')
                                <i class="fas fa-plate-wheat"></i>
                            @elseif(str_contains($category->slug, 'kahvalti'))
                                <i class="fas fa-bacon"></i>
                            @elseif(str_contains($category->slug, 'deniz'))
                                <i class="fas fa-fish"></i>
                            @else
                                <i class="fas fa-utensils"></i>
                            @endif
                        </div>
                        <h3 class="font-semibold text-gray-800 text-sm group-hover:text-red-500 transition-colors duration-300">
                            {{ $category->name }}
                        </h3>
                    </a>
                    @endforeach
                </div>

                <!-- Desktop Scroll Buttons -->
                <button onclick="scrollCategories('left')" class="hidden md:block absolute left-0 top-1/2 -translate-y-1/2 -translate-x-4 bg-white rounded-full p-2 shadow-lg hover:shadow-xl transition-all duration-200">
                    <svg class="w-5 h-5 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                </button>
                <button onclick="scrollCategories('right')" class="hidden md:block absolute right-0 top-1/2 -translate-y-1/2 translate-x-4 bg-white rounded-full p-2 shadow-lg hover:shadow-xl transition-all duration-200">
                    <svg class="w-5 h-5 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </button>
            </div>
        </div>
        @endif

        <!-- Popular Restaurants Section -->
        <div class="mb-12">
            <h2 class="text-2xl md:text-3xl font-bold text-gray-900 mb-6">Popüler Restoranlar</h2>

            @if($popularRestaurants->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($popularRestaurants as $restaurant)
                <a href="{{ route('restaurants.menu', $restaurant) }}"
                   class="group bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 border border-gray-100">

                    <div class="relative overflow-hidden">
                        @if($restaurant->logo)
                        <img src="{{ asset('storage/' . $restaurant->logo) }}"
                             alt="{{ $restaurant->name }}"
                             class="w-full h-56 object-cover transform group-hover:scale-110 transition-transform duration-500">
                        @else
                        <div class="w-full h-56 bg-gradient-to-br from-red-400 to-orange-400 flex items-center justify-center">
                            <span class="text-5xl font-bold text-white">{{ substr($restaurant->name, 0, 1) }}</span>
                        </div>
                        @endif

                        <!-- Product Count Badge -->
                        <div class="absolute top-4 right-4 bg-white/95 backdrop-blur-sm px-3 py-1.5 rounded-full shadow-lg">
                            <span class="text-sm font-semibold text-gray-700">
                                <i class="fas fa-utensils text-xs mr-1"></i>
                                {{ $restaurant->products_count }} ürün
                            </span>
                        </div>
                    </div>

                    <div class="p-5">
                        <h3 class="text-xl font-bold text-gray-900 mb-2 group-hover:text-red-500 transition-colors duration-300">
                            {{ $restaurant->name }}
                        </h3>

                        @if($restaurant->description)
                        <p class="text-gray-600 text-sm mb-4 line-clamp-2 leading-relaxed">
                            {{ $restaurant->description }}
                        </p>
                        @endif

                        <div class="flex items-center justify-between pt-3 border-t border-gray-100">
                            <span class="text-sm font-medium text-red-500 group-hover:text-red-600 transition-colors">
                                Menüyü İncele
                            </span>
                            <svg class="w-5 h-5 text-red-500 transform group-hover:translate-x-1 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                        </div>
                    </div>
                </a>
                @endforeach
            </div>
            @else
            <div class="text-center py-20 bg-white rounded-2xl">
                <div class="text-gray-400 mb-4">
                    <i class="fas fa-store text-6xl"></i>
                </div>
                <p class="text-gray-500 text-lg font-medium">Henüz aktif restoran bulunmamaktadır.</p>
            </div>
            @endif
        </div>
    </div>
</div>

@push('scripts')
<script>
    // Slider functionality
    let currentSlide = 0;
    const slides = document.querySelectorAll('.slider-item');
    const dots = document.querySelectorAll('.slider-dot');
    const totalSlides = slides.length;
    let autoSlideInterval;

    function showSlide(index) {
        slides.forEach((slide, i) => {
            slide.classList.toggle('opacity-100', i === index);
            slide.classList.toggle('opacity-0', i !== index);
        });

        dots.forEach((dot, i) => {
            if (i === index) {
                dot.classList.remove('bg-white/50', 'w-3');
                dot.classList.add('bg-white', 'w-8');
            } else {
                dot.classList.remove('bg-white', 'w-8');
                dot.classList.add('bg-white/50', 'w-3');
            }
        });
    }

    function nextSlide() {
        currentSlide = (currentSlide + 1) % totalSlides;
        showSlide(currentSlide);
    }

    function prevSlide() {
        currentSlide = (currentSlide - 1 + totalSlides) % totalSlides;
        showSlide(currentSlide);
    }

    function goToSlide(index) {
        currentSlide = index;
        showSlide(currentSlide);
        resetAutoSlide();
    }

    function startAutoSlide() {
        autoSlideInterval = setInterval(nextSlide, 5000);
    }

    function resetAutoSlide() {
        clearInterval(autoSlideInterval);
        startAutoSlide();
    }

    // Start auto slide if there are slides
    if (totalSlides > 0) {
        startAutoSlide();
    }

    // Categories horizontal scroll
    function scrollCategories(direction) {
        const container = document.getElementById('categories-container');
        const scrollAmount = 300;

        if (direction === 'left') {
            container.scrollBy({ left: -scrollAmount, behavior: 'smooth' });
        } else {
            container.scrollBy({ left: scrollAmount, behavior: 'smooth' });
        }
    }

    // Hide scrollbar style
    const style = document.createElement('style');
    style.textContent = `
        .scrollbar-hide::-webkit-scrollbar {
            display: none;
        }
        .scrollbar-hide {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }
    `;
    document.head.appendChild(style);
</script>
@endpush
@endsection
