@extends('layouts.menu')

@section('title', $restaurant->name . ' - Menü')

@section('content')
<!-- Hero Header with Video/Image Background -->
<div class="relative w-full h-[60vh] md:h-[70vh] overflow-hidden {{ !$restaurant->header_video ? 'bg-white' : '' }}">
    @if($restaurant->header_video)
    <!-- Video Background -->
    <video autoplay muted loop playsinline class="absolute inset-0 w-full h-full object-cover" id="headerVideo">
        <source src="{{ asset('storage/' . $restaurant->header_video) }}" type="video/mp4">
    </video>
    <!-- Overlay for video -->
    <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/40 to-black/20"></div>
    @endif

    <!-- Content -->
    <div class="relative h-full flex flex-col justify-end px-4 md:px-8 pb-12 md:pb-16">
        <div class="max-w-6xl mx-auto w-full">
            <!-- Logo Badge -->
            @if($restaurant->logo)
            <div class="mb-6 inline-block">
                <img src="{{ asset('storage/' . $restaurant->logo) }}"
                     alt="{{ $restaurant->name }}"
                     class="w-24 h-24 md:w-32 md:h-32 rounded-3xl object-cover shadow-2xl {{ $restaurant->header_video ? 'border-4 border-white/20' : 'border-4 border-gray-200' }}">
            </div>
            @endif

            <!-- Restaurant Name -->
            <h1 class="text-4xl md:text-6xl lg:text-7xl font-black {{ $restaurant->header_video ? 'text-white drop-shadow-2xl' : 'text-gray-900' }} mb-4 tracking-tight">
                {{ $restaurant->name }}
            </h1>

            <!-- Description -->
            @if($restaurant->description)
            <p class="text-lg md:text-xl {{ $restaurant->header_video ? 'text-white/90 drop-shadow-lg' : 'text-gray-600' }} mb-6 max-w-3xl font-medium">
                {{ $restaurant->description }}
            </p>
            @endif

            <!-- Contact Info -->
            <div class="flex flex-wrap gap-4 md:gap-6">
                @if($restaurant->phone)
                <a href="tel:{{ $restaurant->phone }}"
                   class="inline-flex items-center gap-2 px-5 py-3 {{ $restaurant->header_video ? 'bg-white/10 backdrop-blur-md text-white border-white/20' : 'bg-gray-100 text-gray-900 border-gray-200' }} rounded-full hover:bg-opacity-80 transition-all duration-300 border">
                    <i class="fas fa-phone"></i>
                    <span class="font-semibold">{{ $restaurant->phone }}</span>
                </a>
                @endif

                @if($restaurant->address)
                <div class="inline-flex items-center gap-2 px-5 py-3 {{ $restaurant->header_video ? 'bg-white/10 backdrop-blur-md text-white border-white/20' : 'bg-gray-100 text-gray-900 border-gray-200' }} rounded-full border">
                    <i class="fas fa-location-dot"></i>
                    <span class="font-semibold">{{ $restaurant->address }}</span>
                </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Scroll Indicator -->
    <div class="absolute bottom-6 left-1/2 transform -translate-x-1/2 animate-bounce">
        <i class="fas fa-chevron-down {{ $restaurant->header_video ? 'text-white/70' : 'text-gray-400' }} text-2xl"></i>
    </div>
</div>

<!-- Menu Content Container -->
<div class="min-h-screen bg-gray-50">

    <!-- Categories Grid View (Default) -->
    <div id="categoriesView" class="py-12 md:py-16">
        <div class="max-w-7xl mx-auto px-4 md:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl md:text-4xl font-black text-gray-900 mb-3">Menümüz</h2>
                <p class="text-gray-600">Kategorimizi seçin ve lezzetlerimizi keşfedin</p>
            </div>

            @if($categories->count() > 0)
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 md:gap-8">
                @foreach($categories as $category)
                @php
                    // Use restaurant-specific image if available, otherwise use default category image
                    $categoryImage = $category->restaurantImages->first()?->image ?? $category->image;
                @endphp
                <button onclick="showCategory({{ $category->id }})"
                        class="category-card group relative overflow-hidden rounded-3xl shadow-lg hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2 focus:outline-none focus:ring-4 focus:ring-gray-900/20">

                    @if($categoryImage)
                    <!-- Category with Image -->
                    <div class="relative h-64 md:h-72">
                        <img src="{{ asset('storage/' . $categoryImage) }}"
                             alt="{{ $category->name }}"
                             class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/30 to-transparent"></div>
                        <div class="absolute inset-0 flex flex-col justify-end p-6">
                            <h3 class="text-2xl md:text-3xl font-black text-white mb-2 drop-shadow-lg">
                                {{ $category->name }}
                            </h3>
                            <div class="flex items-center text-white/90 text-sm font-semibold">
                                <i class="fas fa-utensils mr-2"></i>
                                <span>{{ $category->products->count() }} Ürün</span>
                            </div>
                        </div>
                    </div>
                    @else
                    <!-- Category without Image -->
                    <div class="relative h-64 md:h-72 bg-gradient-to-br from-gray-100 to-gray-200 group-hover:from-gray-900 group-hover:to-gray-800 transition-all duration-500">
                        <div class="absolute inset-0 flex flex-col items-center justify-center p-6 text-center">
                            <div class="w-20 h-20 mb-4 rounded-full bg-gray-900 group-hover:bg-white transition-colors duration-500 flex items-center justify-center">
                                <i class="fas fa-utensils text-3xl text-white group-hover:text-gray-900 transition-colors duration-500"></i>
                            </div>
                            <h3 class="text-2xl md:text-3xl font-black text-gray-900 group-hover:text-white mb-2 transition-colors duration-500">
                                {{ $category->name }}
                            </h3>
                            <div class="flex items-center text-gray-600 group-hover:text-white/90 text-sm font-semibold transition-colors duration-500">
                                <span>{{ $category->products->count() }} Ürün</span>
                            </div>
                        </div>
                    </div>
                    @endif

                    <!-- Hover Indicator -->
                    <div class="absolute top-4 right-4 w-10 h-10 bg-white/20 backdrop-blur-sm rounded-full flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                        <i class="fas fa-arrow-right text-white"></i>
                    </div>
                </button>
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
    </div>

    <!-- Products View (Hidden by default) -->
    <div id="productsView" class="hidden">
        <!-- Sticky Header -->
        <div class="sticky top-0 z-40 bg-white border-b border-gray-200 shadow-sm">
            <div class="max-w-7xl mx-auto px-4 md:px-8 py-4">
                <div class="flex items-center gap-4">
                    <button onclick="backToCategories()"
                            class="flex items-center justify-center w-10 h-10 rounded-full bg-gray-100 hover:bg-gray-900 hover:text-white transition-all duration-300 group">
                        <i class="fas fa-arrow-left group-hover:scale-110 transition-transform"></i>
                    </button>
                    <div class="flex-1">
                        <h2 id="selectedCategoryName" class="text-2xl md:text-3xl font-black text-gray-900"></h2>
                        <p id="selectedCategoryCount" class="text-sm text-gray-500 font-medium"></p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Products Grid -->
        <div class="py-12">
            <div class="max-w-7xl mx-auto px-4 md:px-8">
                <div id="productsGrid" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6"></div>
            </div>
        </div>
    </div>
</div>

<!-- Hidden Data for JavaScript -->
<script type="application/json" id="categoriesData">
{!! json_encode($categories->map(function($category) {
    // Use restaurant-specific image if available, otherwise use default category image
    $categoryImage = $category->restaurantImages->first()?->image ?? $category->image;

    return [
        'id' => $category->id,
        'name' => $category->name,
        'image' => $categoryImage,
        'products' => $category->products->map(function($product) {
            return [
                'name' => $product->name,
                'description' => $product->description,
                'price' => $product->price,
                'image' => $product->image,
                'in_stock' => $product->in_stock
            ];
        })
    ];
})) !!}
</script>

<!-- Floating Action Button (Back to Top) -->
<button id="backToTop"
        class="fixed bottom-8 right-8 w-16 h-16 bg-gray-900 text-white rounded-full shadow-2xl opacity-0 pointer-events-none transition-all duration-300 hover:bg-gray-800 hover:scale-110 z-50 flex items-center justify-center">
    <i class="fas fa-arrow-up text-xl"></i>
</button>

@push('scripts')
<script>
    // Load categories data
    const categoriesData = JSON.parse(document.getElementById('categoriesData').textContent);

    // View management
    const categoriesView = document.getElementById('categoriesView');
    const productsView = document.getElementById('productsView');
    const productsGrid = document.getElementById('productsGrid');
    const selectedCategoryName = document.getElementById('selectedCategoryName');
    const selectedCategoryCount = document.getElementById('selectedCategoryCount');

    // Show category products
    function showCategory(categoryId) {
        const category = categoriesData.find(c => c.id === categoryId);
        if (!category) return;

        // Update header
        selectedCategoryName.textContent = category.name;
        selectedCategoryCount.textContent = `${category.products.length} Ürün`;

        // Clear and populate products grid
        productsGrid.innerHTML = '';
        category.products.forEach((product, index) => {
            const productCard = createProductCard(product, index);
            productsGrid.appendChild(productCard);
        });

        // Switch views with animation
        categoriesView.style.opacity = '0';
        setTimeout(() => {
            categoriesView.classList.add('hidden');
            productsView.classList.remove('hidden');
            setTimeout(() => {
                productsView.style.opacity = '1';
                animateProductCards();
            }, 50);
        }, 300);

        // Scroll to top
        window.scrollTo({ top: 0, behavior: 'smooth' });
    }

    // Back to categories
    function backToCategories() {
        productsView.style.opacity = '0';
        setTimeout(() => {
            productsView.classList.add('hidden');
            categoriesView.classList.remove('hidden');
            setTimeout(() => {
                categoriesView.style.opacity = '1';
                animateCategoryCards();
            }, 50);
        }, 300);

        // Scroll to top
        window.scrollTo({ top: 0, behavior: 'smooth' });
    }

    // Create product card
    function createProductCard(product, index) {
        const card = document.createElement('div');
        card.className = 'product-card group bg-white rounded-2xl overflow-hidden shadow-md hover:shadow-2xl transition-all duration-500 border border-gray-200';
        card.style.opacity = '0';
        card.style.transform = 'translateY(30px)';

        const imageHtml = product.image
            ? `<div class="relative h-48 overflow-hidden bg-gray-100">
                    <img src="/storage/${product.image}" alt="${product.name}"
                         class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500"
                         loading="lazy">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/40 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                </div>`
            : `<div class="h-48 bg-gradient-to-br from-gray-50 to-gray-100 flex items-center justify-center">
                    <i class="fas fa-utensils text-5xl text-gray-300"></i>
                </div>`;

        const descriptionHtml = product.description
            ? `<p class="text-gray-600 text-sm mb-4 line-clamp-2 min-h-[2.5rem]">${product.description}</p>`
            : `<div class="mb-4 min-h-[2.5rem]"></div>`;

        const stockHtml = product.in_stock
            ? `<div class="flex items-center gap-1 text-green-600 text-xs font-bold">
                    <i class="fas fa-check-circle"></i>
                    <span>Mevcut</span>
                </div>`
            : `<div class="flex items-center gap-1 text-red-500 text-xs font-bold">
                    <i class="fas fa-times-circle"></i>
                    <span>Tükendi</span>
                </div>`;

        card.innerHTML = `
            ${imageHtml}
            <div class="p-5">
                <h3 class="text-lg font-bold text-gray-900 mb-2 line-clamp-2 min-h-[3rem]">${product.name}</h3>
                ${descriptionHtml}
                <div class="flex items-center justify-between pt-3 border-t border-gray-100">
                    <div class="text-2xl font-black text-gray-900">
                        ${parseFloat(product.price).toFixed(2)}<span class="text-base ml-0.5">₺</span>
                    </div>
                    ${stockHtml}
                </div>
            </div>
        `;

        return card;
    }

    // Animate product cards on load
    function animateProductCards() {
        const cards = document.querySelectorAll('#productsGrid .product-card');
        cards.forEach((card, index) => {
            setTimeout(() => {
                card.style.transition = 'all 0.6s cubic-bezier(0.16, 1, 0.3, 1)';
                card.style.opacity = '1';
                card.style.transform = 'translateY(0)';
            }, index * 75);
        });
    }

    // Animate category cards on load
    function animateCategoryCards() {
        const cards = document.querySelectorAll('.category-card');
        cards.forEach((card, index) => {
            card.style.opacity = '0';
            card.style.transform = 'translateY(30px) scale(0.95)';
            setTimeout(() => {
                card.style.transition = 'all 0.6s cubic-bezier(0.16, 1, 0.3, 1)';
                card.style.opacity = '1';
                card.style.transform = 'translateY(0) scale(1)';
            }, index * 75);
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

    // Video optimization
    const video = document.getElementById('headerVideo');
    if (video) {
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    video.play();
                } else {
                    video.pause();
                }
            });
        }, { threshold: 0.5 });

        observer.observe(video);

        if (navigator.connection && navigator.connection.effectiveType) {
            if (navigator.connection.effectiveType === '2g' || navigator.connection.effectiveType === 'slow-2g') {
                video.style.display = 'none';
            }
        }
    }

    // Initial animation on page load
    document.addEventListener('DOMContentLoaded', () => {
        setTimeout(() => {
            animateCategoryCards();
        }, 300);
    });
</script>
@endpush
@endsection
