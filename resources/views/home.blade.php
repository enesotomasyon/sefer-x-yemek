@extends('layouts.public')

@section('title', 'Ana Sayfa - Dijital Menü')

@push('styles')
<style>
    #slider {
        height: 500px !important;
        min-height: 500px !important;
        display: block !important;
    }
    #slider .slider-item {
        height: 500px !important;
        min-height: 500px !important;
    }
    #slider .slider-item a {
        height: 100% !important;
    }
    #slider .slider-item img {
        height: 500px !important;
        min-height: 500px !important;
    }
    @media (min-width: 768px) {
        #slider {
            height: 600px !important;
            min-height: 600px !important;
        }
        #slider .slider-item {
            height: 600px !important;
            min-height: 600px !important;
        }
        #slider .slider-item img {
            height: 600px !important;
            min-height: 600px !important;
        }
    }
</style>
@endpush

@section('content')
<!-- Hero Slider Section with Modern Design -->
@if(isset($sliders) && $sliders->count() > 0)
<section class="relative bg-gradient-to-br from-slate-50 via-white to-gray-50 py-12 mb-8 z-0" style="min-height: 600px;">
    <div class="max-w-7xl mx-auto px-4" style="height: 100%;">
        <div class="relative overflow-hidden rounded-3xl shadow-2xl" id="slider" style="background-color: #f0f0f0; height: 500px; min-height: 500px; display: block;">
            @foreach($sliders as $index => $slider)
            <div class="slider-item absolute inset-0 z-10 transition-all duration-1000 ease-in-out {{ $index === 0 ? 'opacity-100 scale-100' : 'opacity-0 scale-105' }}" data-index="{{ $index }}" style="{{ $index === 0 ? 'display: block; width: 100%; height: 100%;' : 'display: none; width: 100%; height: 100%;' }}">
                <a href="{{ $slider->getLink() }}" class="block w-full h-full relative group z-10" style="display: block; width: 100%; height: 100%;">
                    <img src="{{ asset('storage/' . $slider->image) }}"
                         alt="{{ $slider->title }}"
                         class="w-full h-full object-cover transform transition-transform duration-[2000ms] group-hover:scale-110"
                         style="display: block !important; width: 100% !important; height: 100% !important; min-height: 500px !important; max-height: 600px !important; object-fit: cover !important;">

                    <!-- Modern Gradient Overlay - Extra Dark for Readability -->
                    <div class="absolute inset-0 bg-black/40 z-20"></div>
                    <div class="absolute inset-0 bg-gradient-to-t from-black via-black/70 to-transparent z-20"></div>

                    <!-- Content with Animation -->
                    <div class="absolute bottom-0 left-0 p-6 md:p-12 z-30">
                        <div class="transform transition-all duration-700 group-hover:translate-y-[-10px] max-w-4xl">
                            <!-- Text Container with Background -->
                            <div class="backdrop-blur-sm bg-black/10 px-4 py-2 rounded-2xl mb-4 inline-block">
                                <h2 class="text-3xl md:text-6xl font-black text-white tracking-tight leading-tight" style="text-shadow: 0 6px 20px rgba(0,0,0,1), 0 3px 8px rgba(0,0,0,0.9), 0 1px 3px rgba(0,0,0,0.8);">
                                    {{ $slider->title }}
                                </h2>
                            </div>
                            <div class="inline-flex items-center gap-3 bg-gradient-to-r from-orange-600 to-orange-700 backdrop-blur-md px-6 md:px-8 py-3 md:py-4 rounded-full shadow-2xl group-hover:from-orange-500 group-hover:to-orange-600 transition-all duration-300">
                                <span class="text-white font-bold text-sm md:text-base">Keşfet</span>
                                <svg class="w-4 h-4 md:w-5 md:h-5 text-white transform group-hover:translate-x-2 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                                </svg>
                            </div>
                        </div>
                    </div>

                    <!-- Decorative Elements -->
                    <div class="absolute top-8 right-8 w-16 h-16 md:w-24 md:h-24 bg-orange-500/10 backdrop-blur-sm rounded-full border border-orange-400/30 animate-pulse z-40"></div>
                    <div class="absolute bottom-8 left-8 w-12 h-12 md:w-16 md:h-16 bg-amber-500/10 backdrop-blur-sm rounded-full border border-amber-400/30 z-40"></div>
                </a>
            </div>
            @endforeach

            <!-- Modern Navigation Arrows -->
            @if($sliders->count() > 1)
            <button onclick="prevSlide()" class="absolute left-4 md:left-6 top-1/2 -translate-y-1/2 bg-white/95 backdrop-blur-sm hover:bg-orange-600 p-3 md:p-4 rounded-2xl shadow-xl transition-all duration-300 hover:scale-110 hover:shadow-2xl z-50 group">
                <svg class="w-5 h-5 md:w-6 md:h-6 text-orange-600 group-hover:text-white transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M15 19l-7-7 7-7" />
                </svg>
            </button>
            <button onclick="nextSlide()" class="absolute right-4 md:right-6 top-1/2 -translate-y-1/2 bg-white/95 backdrop-blur-sm hover:bg-orange-600 p-3 md:p-4 rounded-2xl shadow-xl transition-all duration-300 hover:scale-110 hover:shadow-2xl z-50 group">
                <svg class="w-5 h-5 md:w-6 md:h-6 text-orange-600 group-hover:text-white transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M9 5l7 7-7 7" />
                </svg>
            </button>

            <!-- Modern Progress Dots -->
            <div class="absolute bottom-6 md:bottom-8 left-1/2 -translate-x-1/2 flex gap-2 md:gap-3 z-50 bg-black/20 backdrop-blur-md px-4 md:px-6 py-2 md:py-3 rounded-full">
                @foreach($sliders as $index => $slider)
                <button onclick="goToSlide({{ $index }})" class="slider-dot h-2 rounded-full transition-all duration-500 {{ $index === 0 ? 'bg-white w-8 md:w-12 shadow-lg' : 'bg-white/40 w-2 hover:bg-white/70 hover:w-6 md:hover:w-8' }}"></button>
                @endforeach
            </div>
            @endif
        </div>
    </div>
</section>
@endif

<!-- Intro Video Section -->
@if(isset($introVideo) && $introVideo)
<section class="relative bg-gradient-to-br from-orange-50 via-white to-amber-50 border-b border-orange-100 overflow-hidden" style="min-height: 600px;">
    <!-- Background Video -->
    <video
        id="intro-video"
        autoplay
        loop
        muted
        playsinline
        preload="auto"
        class="absolute inset-0 w-full h-full object-cover"
        style="z-index: 0;">
        <source src="{{ asset('storage/' . $introVideo) }}" type="video/mp4">
    </video>

    <!-- Gradient Overlay -->
    <div class="absolute inset-0 bg-gradient-to-br from-orange-500/30 via-transparent to-amber-500/20" style="z-index: 1;"></div>
    <div class="absolute inset-0 bg-gradient-to-t from-black/40 via-transparent to-transparent" style="z-index: 1;"></div>

    <!-- Content Overlay -->
    <div class="relative z-10 max-w-7xl mx-auto px-4 py-24" style="min-height: 600px;">
        <div class="flex flex-col items-center justify-center h-full text-center">
            <div class="backdrop-blur-sm bg-white/10 rounded-3xl p-8 md:p-12 max-w-3xl border border-white/20">
                <h1 class="text-4xl md:text-6xl font-black text-white mb-6 tracking-tight" style="text-shadow: 0 6px 20px rgba(0,0,0,0.8), 0 3px 8px rgba(0,0,0,0.6);">
                    Lezzetin Dijital Adresi
                </h1>
                <p class="text-lg md:text-xl text-white/90 mb-8 leading-relaxed" style="text-shadow: 0 2px 10px rgba(0,0,0,0.8);">
                    En sevdiğiniz restoranların menülerini keşfedin, lezzetli yemekleri inceleyin
                </p>
                <a href="#restaurants" class="inline-flex items-center gap-3 bg-gradient-to-r from-orange-600 to-orange-700 backdrop-blur-md px-8 py-4 rounded-full shadow-2xl hover:from-orange-500 hover:to-orange-600 transition-all duration-300 transform hover:scale-105">
                    <span class="text-white font-bold text-lg">Keşfet</span>
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </a>
            </div>
        </div>
    </div>
</section>
@endif

<!-- Main Content Container -->
<div class="relative bg-gradient-to-b from-white via-gray-50 to-white">
    <div class="max-w-7xl mx-auto px-4 py-16">

        <!-- Categories Section with Swiper -->
        @if($categories->count() > 0)
        <div class="mb-16">
            <!-- Section Header -->
            <div class="flex items-center justify-between mb-8">
                <div>
                    <span class="inline-block px-5 py-2 bg-gradient-to-r from-orange-50 to-slate-50 rounded-full text-orange-600 font-bold text-xs mb-3 tracking-wide border border-orange-100">
                        MENÜ KATEGORİLERİ
                    </span>
                    <h2 class="text-3xl md:text-4xl font-black text-slate-900 tracking-tight">
                        Ne Yemek <span class="text-transparent bg-clip-text bg-gradient-to-r from-orange-600 to-orange-700">İstersin?</span>
                    </h2>
                </div>

                <!-- Navigation Buttons -->
                <div class="flex items-center gap-2">
                    <button class="categories-swiper-prev w-11 h-11 rounded-xl bg-white border-2 border-gray-200 hover:border-orange-500 hover:bg-orange-600 transition-all duration-300 flex items-center justify-center group shadow-sm">
                        <svg class="w-5 h-5 text-slate-600 group-hover:text-white transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                        </svg>
                    </button>
                    <button class="categories-swiper-next w-11 h-11 rounded-xl bg-white border-2 border-gray-200 hover:border-orange-500 hover:bg-orange-600 transition-all duration-300 flex items-center justify-center group shadow-sm">
                        <svg class="w-5 h-5 text-slate-600 group-hover:text-white transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Categories Swiper -->
            <div class="swiper categories-swiper">
                <div class="swiper-wrapper">
                    @foreach($categories as $category)
                    <div class="swiper-slide">
                        <a href="{{ route('categories.show', $category) }}"
                           class="group relative block overflow-hidden bg-white rounded-2xl p-6 hover:shadow-2xl transition-all duration-500 border-2 border-slate-100 hover:border-orange-500 hover:-translate-y-2 h-full">

                            <!-- Background Gradient (appears on hover) -->
                            <div class="absolute inset-0 bg-gradient-to-br from-orange-600 to-slate-800 opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>

                            <!-- Content -->
                            <div class="relative z-10 flex flex-col items-center text-center">
                                <!-- Icon Container -->
                                <div class="w-16 h-16 mb-3 flex items-center justify-center rounded-xl bg-gradient-to-br from-orange-50 to-slate-50 group-hover:bg-white/20 transition-all duration-500 transform group-hover:scale-110 group-hover:rotate-3 shadow-sm">
                                    <div class="text-3xl text-orange-600 group-hover:text-white transition-colors duration-500">
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
                                </div>

                                <!-- Category Name -->
                                <h3 class="font-bold text-slate-900 text-base group-hover:text-white transition-colors duration-500">
                                    {{ $category->name }}
                                </h3>
                            </div>

                            <!-- Decorative Circle -->
                            <div class="absolute -top-8 -right-8 w-24 h-24 bg-gradient-to-br from-orange-400 to-amber-400 rounded-full opacity-0 group-hover:opacity-20 transition-opacity duration-500 blur-2xl"></div>
                        </a>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        @endif

        <!-- Popular Restaurants Section -->
        <div id="restaurants" class="mb-16 pt-12 mt-16">
            <!-- Section Header -->
            <div class="flex items-center justify-between mb-8 mt-8">
                <div>
                    <span class="inline-block px-5 py-2 bg-gradient-to-r from-orange-50 to-amber-50 rounded-full text-orange-600 font-bold text-xs mb-3 tracking-wide border border-orange-100">
                        EN SEVİLENLER
                    </span>
                    <h2 class="text-3xl md:text-4xl font-black text-slate-900 tracking-tight">
                        Favori <span class="text-transparent bg-clip-text bg-gradient-to-r from-orange-600 to-amber-600">Restoranlar</span>
                    </h2>
                </div>

                <!-- Navigation Buttons -->
                <div class="flex items-center gap-2">
                    <button class="restaurants-swiper-prev w-11 h-11 rounded-xl bg-white border-2 border-gray-200 hover:border-orange-500 hover:bg-orange-600 transition-all duration-300 flex items-center justify-center group shadow-sm">
                        <svg class="w-5 h-5 text-slate-600 group-hover:text-white transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                        </svg>
                    </button>
                    <button class="restaurants-swiper-next w-11 h-11 rounded-xl bg-white border-2 border-gray-200 hover:border-orange-500 hover:bg-orange-600 transition-all duration-300 flex items-center justify-center group shadow-sm">
                        <svg class="w-5 h-5 text-slate-600 group-hover:text-white transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </button>
                </div>
            </div>

            @if($popularRestaurants->count() > 0)
            <!-- Restaurants Swiper -->
            <div class="swiper restaurants-swiper">
                <div class="swiper-wrapper">
                @foreach($popularRestaurants as $restaurant)
                <div class="swiper-slide">
                <a href="{{ route('restaurants.menu', $restaurant) }}"
                   class="group relative bg-white rounded-3xl overflow-hidden transition-all duration-500 border border-black/50 hover:border-orange-500 hover:-translate-y-2 block h-full">

                    <!-- Image Container -->
                    <div class="relative overflow-hidden h-64">
                        @if($restaurant->logo)
                        <img src="{{ asset('storage/' . $restaurant->logo) }}"
                             alt="{{ $restaurant->name }}"
                             class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-700">
                        @else
                        <div class="w-full h-full bg-gradient-to-br from-orange-500 via-orange-600 to-slate-700 flex items-center justify-center relative overflow-hidden">
                            <span class="text-7xl font-black text-white/90 z-10">{{ substr($restaurant->name, 0, 1) }}</span>
                            <!-- Animated Background Circles -->
                            <div class="absolute top-0 right-0 w-32 h-32 bg-white/10 rounded-full -translate-y-1/2 translate-x-1/2 animate-pulse"></div>
                            <div class="absolute bottom-0 left-0 w-40 h-40 bg-amber-400/10 rounded-full translate-y-1/2 -translate-x-1/2"></div>
                        </div>
                        @endif

                        <!-- Gradient Overlay -->
                        <div class="absolute inset-0 bg-gradient-to-t from-slate-900/70 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>

                        <!-- Product Count Badge -->
                        <div class="absolute top-4 right-4 bg-white/95 backdrop-blur-md px-4 py-2 rounded-2xl shadow-xl border border-white/50 transform group-hover:scale-110 transition-transform duration-300">
                            <div class="flex items-center gap-2">
                                <div class="w-8 h-8 bg-gradient-to-br from-orange-500 to-orange-700 rounded-full flex items-center justify-center shadow-sm">
                                    <i class="fas fa-utensils text-white text-xs"></i>
                                </div>
                                <span class="text-sm font-bold text-slate-800">
                                    {{ $restaurant->products_count }}
                                </span>
                            </div>
                        </div>

                        <!-- Quick Action on Hover -->
                        <div class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-all duration-500">
                            <div class="bg-gradient-to-r from-orange-600 to-orange-700 backdrop-blur-sm px-8 py-4 rounded-2xl shadow-2xl transform translate-y-4 group-hover:translate-y-0 transition-transform duration-500">
                                <span class="text-white font-bold flex items-center gap-2">
                                    Menüyü Gör
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                                    </svg>
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- Content -->
                    <div class="p-6">
                        <h3 class="text-2xl font-black text-slate-900 mb-3 group-hover:text-orange-600 transition-colors duration-300">
                            {{ $restaurant->name }}
                        </h3>

                        @if($restaurant->description)
                        <p class="text-slate-600 text-sm mb-4 line-clamp-2 leading-relaxed">
                            {{ $restaurant->description }}
                        </p>
                        @else
                        <p class="text-slate-400 text-sm mb-4 italic">
                            Lezzetli yemekleri keşfetmek için menüye göz atın
                        </p>
                        @endif

                        <!-- Bottom Info -->
                        <div class="flex items-center justify-between pt-4 border-t-2 border-slate-100 group-hover:border-orange-100 transition-colors duration-300">
                            <div class="flex items-center gap-2">
                                <div class="w-2 h-2 bg-emerald-500 rounded-full animate-pulse shadow-sm"></div>
                                <span class="text-xs font-bold text-emerald-600 tracking-wide">Aktif</span>
                            </div>
                            <svg class="w-6 h-6 text-orange-600 transform group-hover:translate-x-2 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                            </svg>
                        </div>
                    </div>

                    <!-- Decorative Elements -->
                    <div class="absolute -bottom-16 -right-16 w-32 h-32 bg-gradient-to-br from-orange-400 to-amber-400 rounded-full opacity-0 group-hover:opacity-30 transition-opacity duration-500 blur-3xl"></div>
                </a>
                </div>
                @endforeach
                </div>
            </div>
            @else
            <div class="text-center py-24 bg-gradient-to-br from-slate-50 to-white rounded-3xl border-2 border-dashed border-slate-200">
                <div class="w-24 h-24 mx-auto mb-6 bg-gradient-to-br from-orange-50 to-amber-50 rounded-full flex items-center justify-center shadow-inner">
                    <i class="fas fa-store text-4xl text-orange-600"></i>
                </div>
                <h3 class="text-xl font-bold text-slate-900 mb-2">Henüz Restoran Yok</h3>
                <p class="text-slate-500">Yakında lezzetli restoranlar burada olacak!</p>
            </div>
            @endif
        </div>
    </div>
</div>

@push('scripts')
<script>
    // Modern Slider functionality with smooth transitions
    let currentSlide = 0;
    const slides = document.querySelectorAll('.slider-item');
    const dots = document.querySelectorAll('.slider-dot');
    const totalSlides = slides.length;
    let autoSlideInterval;

    function showSlide(index) {
        slides.forEach((slide, i) => {
            if (i === index) {
                slide.style.display = 'block';
                slide.classList.remove('opacity-0', 'scale-105');
                slide.classList.add('opacity-100', 'scale-100');
            } else {
                slide.style.display = 'none';
                slide.classList.remove('opacity-100', 'scale-100');
                slide.classList.add('opacity-0', 'scale-105');
            }
        });

        dots.forEach((dot, i) => {
            if (i === index) {
                dot.classList.remove('bg-white/40', 'w-2', 'hover:bg-white/70', 'hover:w-8');
                dot.classList.add('bg-white', 'w-12', 'shadow-lg');
            } else {
                dot.classList.remove('bg-white', 'w-12', 'shadow-lg');
                dot.classList.add('bg-white/40', 'w-2', 'hover:bg-white/70', 'hover:w-8');
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
        autoSlideInterval = setInterval(nextSlide, 6000);
    }

    function resetAutoSlide() {
        clearInterval(autoSlideInterval);
        startAutoSlide();
    }

    // Start auto slide if there are slides
    if (totalSlides > 0) {
        startAutoSlide();
    }

    // Pause slider on hover
    const sliderContainer = document.getElementById('slider');
    if (sliderContainer) {
        sliderContainer.addEventListener('mouseenter', () => {
            clearInterval(autoSlideInterval);
        });

        sliderContainer.addEventListener('mouseleave', () => {
            startAutoSlide();
        });
    }

    // Initialize Categories Swiper
    const categoriesSwiper = new Swiper('.categories-swiper', {
        slidesPerView: 2,
        spaceBetween: 16,
        grabCursor: true,
        loop: false,
        navigation: {
            nextEl: '.categories-swiper-next',
            prevEl: '.categories-swiper-prev',
        },
        breakpoints: {
            640: {
                slidesPerView: 3,
                spaceBetween: 20,
            },
            768: {
                slidesPerView: 4,
                spaceBetween: 24,
            },
            1024: {
                slidesPerView: 6,
                spaceBetween: 24,
            },
            1280: {
                slidesPerView: 7,
                spaceBetween: 24,
            }
        }
    });

    // Initialize Restaurants Swiper (2x3 Grid)
    const restaurantsSwiper = new Swiper('.restaurants-swiper', {
        slidesPerView: 1,
        spaceBetween: 24,
        grabCursor: true,
        loop: false,
        autoplay: {
            delay: 5000,
            disableOnInteraction: false,
            pauseOnMouseEnter: true,
        },
        navigation: {
            nextEl: '.restaurants-swiper-next',
            prevEl: '.restaurants-swiper-prev',
        },
        grid: {
            rows: 2,
            fill: 'row',
        },
        breakpoints: {
            640: {
                slidesPerView: 2,
                spaceBetween: 20,
                grid: {
                    rows: 2,
                    fill: 'row',
                },
            },
            1024: {
                slidesPerView: 3,
                spaceBetween: 24,
                grid: {
                    rows: 2,
                    fill: 'row',
                },
            }
        }
    });

    // Force video to play
    const introVideo = document.getElementById('intro-video');
    if (introVideo) {
        // Try to play the video
        const playPromise = introVideo.play();

        if (playPromise !== undefined) {
            playPromise.then(() => {
                // Video started playing successfully
                console.log('Video playing');
            }).catch(error => {
                // Auto-play was prevented, try to play on user interaction
                console.log('Auto-play prevented:', error);
                document.addEventListener('click', function playOnClick() {
                    introVideo.play();
                    document.removeEventListener('click', playOnClick);
                }, { once: true });
            });
        }
    }

    // Add smooth scroll behavior and animations
    document.addEventListener('DOMContentLoaded', () => {
        // Animate elements on scroll
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }
            });
        }, observerOptions);

        // Observe restaurant cards
        document.querySelectorAll('.group').forEach(el => {
            // Skip swiper slides to avoid animation conflicts
            if (!el.closest('.swiper-slide')) {
                el.style.opacity = '0';
                el.style.transform = 'translateY(20px)';
                el.style.transition = 'opacity 0.6s ease-out, transform 0.6s ease-out';
                observer.observe(el);
            }
        });
    });
</script>
@endpush
@endsection
