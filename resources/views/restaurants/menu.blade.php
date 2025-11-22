@extends('layouts.menu')

@section('title', $restaurant->name . ' - Menü')

@section('content')
<!-- Modern Restaurant Header -->
<div class="relative bg-gradient-to-br from-orange-50 via-white to-amber-50 border-b border-orange-100 overflow-hidden">
    @if($restaurant->header_video)
    <!-- Background Video -->
    <video
        id="restaurant-header-video"
        autoplay
        loop
        muted
        playsinline
        preload="auto"
        class="absolute inset-0 w-full h-full object-cover"
        style="z-index: 0;">
        <source src="{{ asset('storage/' . $restaurant->header_video) }}" type="video/mp4">
    </video>

    <!-- Gradient Overlays -->
    <div class="absolute inset-0 bg-gradient-to-br from-orange-500/40 via-transparent to-amber-500/30" style="z-index: 1;"></div>
    <div class="absolute inset-0 bg-gradient-to-t from-black/50 via-transparent to-black/30" style="z-index: 1;"></div>
    @endif

    <div class="relative z-10 max-w-7xl mx-auto px-4 py-8 md:py-12">
        <div class="flex flex-col md:flex-row gap-6 items-start md:items-center">
            <!-- Logo -->
            @if($restaurant->logo)
            <div class="flex-shrink-0">
                <div class="w-24 h-24 md:w-32 md:h-32 rounded-3xl overflow-hidden shadow-xl border-4 border-white {{ $restaurant->header_video ? 'backdrop-blur-sm' : '' }}">
                    <img src="{{ asset('storage/' . $restaurant->logo) }}"
                         alt="{{ $restaurant->name }}"
                         class="w-full h-full object-cover">
                </div>
            </div>
            @else
            <div class="flex-shrink-0">
                <div class="w-24 h-24 md:w-32 md:h-32 rounded-3xl bg-gradient-to-br from-orange-500 to-orange-600 flex items-center justify-center shadow-xl border-4 border-white">
                    <span class="text-4xl md:text-5xl font-black text-white">{{ substr($restaurant->name, 0, 1) }}</span>
                </div>
            </div>
            @endif

            <!-- Restaurant Info -->
            <div class="flex-1">
                <!-- Name -->
                <h1 class="text-3xl md:text-5xl font-black {{ $restaurant->header_video ? 'text-white' : 'text-slate-900' }} mb-3 tracking-tight" style="{{ $restaurant->header_video ? 'text-shadow: 0 6px 20px rgba(0,0,0,0.8), 0 3px 8px rgba(0,0,0,0.6);' : '' }}">
                    {{ $restaurant->name }}
                </h1>

                <!-- Description -->
                @if($restaurant->description)
                <p class="text-base md:text-lg {{ $restaurant->header_video ? 'text-white/95' : 'text-slate-600' }} mb-4 max-w-3xl leading-relaxed" style="{{ $restaurant->header_video ? 'text-shadow: 0 2px 10px rgba(0,0,0,0.8);' : '' }}">
                    {{ $restaurant->description }}
                </p>
                @endif

                <!-- Contact Info -->
                <div class="flex flex-wrap gap-3">
                    @if($restaurant->phone)
                    <a href="tel:{{ $restaurant->phone }}"
                       class="inline-flex items-center gap-2 px-4 py-2 bg-white hover:bg-orange-50 rounded-xl transition-all duration-300 border border-orange-200 shadow-sm hover:shadow-md group {{ $restaurant->header_video ? 'backdrop-blur-md' : '' }}">
                        <div class="w-8 h-8 rounded-lg bg-orange-100 flex items-center justify-center group-hover:bg-orange-200 transition-colors">
                            <i class="fas fa-phone text-orange-600 text-sm"></i>
                        </div>
                        <span class="font-semibold text-slate-900 text-sm">{{ $restaurant->phone }}</span>
                    </a>
                    @endif

                    @if($restaurant->address)
                    <div class="inline-flex items-center gap-2 px-4 py-2 {{ $restaurant->header_video ? 'bg-white/95 backdrop-blur-md' : 'bg-white' }} rounded-xl border border-slate-200 shadow-sm">
                        <div class="w-8 h-8 rounded-lg bg-slate-100 flex items-center justify-center">
                            <i class="fas fa-location-dot text-slate-600 text-sm"></i>
                        </div>
                        <span class="font-semibold text-slate-700 text-sm">{{ $restaurant->address }}</span>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Menu Content Container -->
<div class="min-h-screen bg-white">
    @if($categories->count() > 0)
    <!-- Sticky Category Tabs -->
    <div class="sticky top-0 z-40 bg-white border-b border-gray-200 shadow-sm">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex overflow-x-auto scrollbar-hide gap-2 py-4" id="categoryTabs">
                @foreach($categories as $index => $category)
                <button onclick="showCategory({{ $category->id }})"
                        data-category="{{ $category->id }}"
                        class="category-tab flex-shrink-0 px-6 py-3 rounded-full font-bold text-sm transition-all duration-300 whitespace-nowrap {{ $index === 0 ? 'bg-orange-600 text-black shadow-lg' : 'bg-gray-100 text-black hover:bg-gray-200' }}">
                    {{ $category->name }}
                    <span class="ml-2 text-xs {{ $index === 0 ? 'text-black/50' : 'text-black/60' }}">({{ $category->products->count() }})</span>
                </button>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Products List -->
    <div class="max-w-7xl mx-auto px-4 py-8">
        @foreach($categories as $category)
        <div class="category-products {{ $loop->first ? '' : 'hidden' }}" data-category="{{ $category->id }}">
            <!-- Category Title -->
            <div class="mb-6">
                <h2 class="text-3xl font-black text-slate-900 mb-2">{{ $category->name }}</h2>
                <p class="text-slate-600">{{ $category->products->count() }} ürün</p>
            </div>

            @if($category->products->count() > 0)
            <!-- Products List -->
            <div class="space-y-4">
                @foreach($category->products as $product)
                <div class="group flex gap-4 bg-white border border-gray-200 rounded-2xl p-4 hover:border-orange-500 hover:shadow-lg transition-all duration-300">
                    <!-- Product Image -->
                    <div class="flex-shrink-0 w-32 h-32 rounded-xl overflow-hidden bg-gray-100">
                        @if($product->image)
                        <img src="{{ asset('storage/' . $product->image) }}"
                             alt="{{ $product->name }}"
                             class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                        @else
                        <div class="w-full h-full flex items-center justify-center">
                            <i class="fas fa-utensils text-4xl text-gray-300"></i>
                        </div>
                        @endif
                    </div>

                    <!-- Product Info -->
                    <div class="flex-1 min-w-0 flex flex-col justify-between">
                        <div>
                            <h3 class="text-xl font-bold text-slate-900 mb-2 group-hover:text-orange-600 transition-colors">
                                {{ $product->name }}
                            </h3>
                            @if($product->description)
                            <p class="text-sm text-slate-600 line-clamp-2 leading-relaxed">
                                {{ $product->description }}
                            </p>
                            @endif
                        </div>

                        <!-- Stock Status -->
                        <div class="mt-2">
                            @if($product->in_stock)
                            <span class="inline-flex items-center gap-1 text-xs font-semibold text-emerald-600">
                                <i class="fas fa-check-circle"></i>
                                Mevcut
                            </span>
                            @else
                            <span class="inline-flex items-center gap-1 text-xs font-semibold text-red-500">
                                <i class="fas fa-times-circle"></i>
                                Tükendi
                            </span>
                            @endif
                        </div>
                    </div>

                    <!-- Price -->
                    <div class="flex-shrink-0 flex items-center">
                        <div class="text-right">
                            <div class="text-2xl font-black text-orange-600">
                                {{ number_format($product->price, 2) }}<span class="text-lg ml-0.5">₺</span>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            @else
            <!-- Empty Category -->
            <div class="text-center py-12 bg-gray-50 rounded-2xl">
                <i class="fas fa-utensils text-5xl text-gray-300 mb-4"></i>
                <p class="text-gray-500">Bu kategoride henüz ürün bulunmuyor.</p>
            </div>
            @endif
        </div>
        @endforeach
    </div>
    @else
    <!-- Empty State -->
    <div class="text-center py-24">
        <div class="inline-block p-12 bg-white rounded-3xl shadow-xl border border-gray-100">
            <i class="fas fa-utensils text-7xl text-gray-200 mb-6"></i>
            <p class="text-gray-400 text-xl font-semibold">Bu restoranda henüz kategori bulunmamaktadır.</p>
        </div>
    </div>
    @endif
</div>

<!-- Floating Action Button (Back to Top) -->
<button id="backToTop"
        class="fixed bottom-8 right-8 w-14 h-14 bg-orange-600 text-white rounded-full shadow-2xl opacity-0 pointer-events-none transition-all duration-300 hover:bg-orange-700 hover:scale-110 z-50 flex items-center justify-center">
    <i class="fas fa-arrow-up text-lg"></i>
</button>

@push('styles')
<style>
    .scrollbar-hide::-webkit-scrollbar {
        display: none;
    }
    .scrollbar-hide {
        -ms-overflow-style: none;
        scrollbar-width: none;
    }
</style>
@endpush

@push('scripts')
<script>
    // Force header video to play
    const headerVideo = document.getElementById('restaurant-header-video');
    if (headerVideo) {
        const playPromise = headerVideo.play();

        if (playPromise !== undefined) {
            playPromise.then(() => {
                console.log('Header video playing');
            }).catch(error => {
                console.log('Auto-play prevented:', error);
                document.addEventListener('click', function playOnClick() {
                    headerVideo.play();
                    document.removeEventListener('click', playOnClick);
                }, { once: true });
            });
        }
    }

    // Show category products
    function showCategory(categoryId) {
        // Update tab active state
        const tabs = document.querySelectorAll('.category-tab');
        tabs.forEach(tab => {
            const countSpan = tab.querySelector('span');
            if (tab.getAttribute('data-category') == categoryId) {
                tab.classList.remove('bg-gray-100', 'hover:bg-gray-200');
                tab.classList.add('bg-orange-600', 'shadow-lg');
                if (countSpan) {
                    countSpan.classList.remove('text-black/60');
                    countSpan.classList.add('text-black/50');
                }
            } else {
                tab.classList.remove('bg-orange-600', 'shadow-lg');
                tab.classList.add('bg-gray-100', 'hover:bg-gray-200');
                if (countSpan) {
                    countSpan.classList.remove('text-black/50');
                    countSpan.classList.add('text-black/60');
                }
            }
        });

        // Show/hide products
        const productSections = document.querySelectorAll('.category-products');
        productSections.forEach(section => {
            if (section.getAttribute('data-category') == categoryId) {
                section.classList.remove('hidden');
                // Smooth scroll to section
                setTimeout(() => {
                    section.scrollIntoView({ behavior: 'smooth', block: 'start' });
                }, 100);
            } else {
                section.classList.add('hidden');
            }
        });
    }

    // Back to top button
    const backToTop = document.getElementById('backToTop');
    window.addEventListener('scroll', () => {
        if (window.scrollY > 300) {
            backToTop.classList.remove('opacity-0', 'pointer-events-none');
            backToTop.classList.add('opacity-100', 'pointer-events-auto');
        } else {
            backToTop.classList.add('opacity-0', 'pointer-events-none');
            backToTop.classList.remove('opacity-100', 'pointer-events-auto');
        }
    });

    backToTop.addEventListener('click', () => {
        window.scrollTo({ top: 0, behavior: 'smooth' });
    });

    // Horizontal scroll for tabs on mobile
    const tabsContainer = document.getElementById('categoryTabs');
    if (tabsContainer) {
        let isDown = false;
        let startX;
        let scrollLeft;

        tabsContainer.addEventListener('mousedown', (e) => {
            isDown = true;
            tabsContainer.style.cursor = 'grabbing';
            startX = e.pageX - tabsContainer.offsetLeft;
            scrollLeft = tabsContainer.scrollLeft;
        });

        tabsContainer.addEventListener('mouseleave', () => {
            isDown = false;
            tabsContainer.style.cursor = 'grab';
        });

        tabsContainer.addEventListener('mouseup', () => {
            isDown = false;
            tabsContainer.style.cursor = 'grab';
        });

        tabsContainer.addEventListener('mousemove', (e) => {
            if (!isDown) return;
            e.preventDefault();
            const x = e.pageX - tabsContainer.offsetLeft;
            const walk = (x - startX) * 2;
            tabsContainer.scrollLeft = scrollLeft - walk;
        });
    }
</script>
@endpush
@endsection
