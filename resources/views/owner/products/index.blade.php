@extends('layouts.owner')
@section('title', 'Ürünler')
@section('page-title', 'Ürünler')
@section('content')

<!-- Percentage Increase Form -->
<div class="card p-6 mb-6">
    <div class="flex items-center justify-between">
        <div>
            <h3 class="text-lg font-bold text-gray-900 mb-1">
                <i class="fas fa-percentage text-gray-400 mr-2"></i>
                Toplu Fiyat Artırma
            </h3>
            <p class="text-sm text-gray-500">Tüm ürünlerin fiyatlarını yüzde ile artırın</p>
        </div>
        <form action="{{ route('owner.products.increase-percentage') }}" method="POST" class="flex items-center gap-3">
            @csrf
            <div class="flex items-center gap-2">
                <span class="text-sm font-medium text-gray-700">%</span>
                <input type="number" name="percentage" step="0.01" min="0" max="100" placeholder="10"
                       class="w-24 px-3 py-2 border border-gray-300 rounded-lg focus:border-gray-900 focus:ring-2 focus:ring-gray-900/10 text-sm font-semibold"
                       required>
            </div>
            <button type="submit" class="px-5 py-2 bg-gray-900 text-white font-semibold rounded-lg hover:bg-gray-800 transition-colors">
                <i class="fas fa-arrow-up mr-2"></i>Artır
            </button>
        </form>
    </div>
</div>

<!-- Bulk Price Update Form -->
<form action="{{ route('owner.products.bulk-update') }}" method="POST" id="bulkPriceForm">
    @csrf

    <div class="flex items-center justify-between mb-6">
        <div>
            <a href="{{ route('owner.products.create') }}" class="inline-flex items-center gap-2 px-5 py-2.5 bg-gray-900 text-white font-semibold rounded-lg hover:bg-gray-800 transition-colors">
                <i class="fas fa-plus"></i>
                <span>Yeni Ürün Ekle</span>
            </a>
        </div>
        <button type="submit" class="inline-flex items-center gap-2 px-5 py-2.5 border-2 border-gray-900 text-gray-900 font-semibold rounded-lg hover:bg-gray-50 transition-colors">
            <i class="fas fa-save"></i>
            <span>Fiyatları Kaydet</span>
        </button>
    </div>

    @forelse($products as $categoryName => $categoryProducts)
    <div class="card p-6 mb-6">
        <div class="flex items-center gap-3 mb-5 pb-4 border-b border-gray-200">
            <div class="w-10 h-10 rounded-lg bg-gray-900 flex items-center justify-center">
                <i class="fas fa-utensils text-white text-sm"></i>
            </div>
            <div>
                <h3 class="text-xl font-bold text-gray-900">{{ $categoryName }}</h3>
                <p class="text-sm text-gray-500">{{ $categoryProducts->count() }} ürün</p>
            </div>
        </div>

        <div class="space-y-3">
            @foreach($categoryProducts as $product)
            <div class="flex items-center justify-between p-4 rounded-lg border border-gray-200 hover:border-gray-300 hover:shadow-sm transition-all">
                <div class="flex items-center gap-4 flex-1">
                    @if($product->image)
                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-16 h-16 rounded-lg object-cover border border-gray-200">
                    @else
                    <div class="w-16 h-16 rounded-lg bg-gray-100 flex items-center justify-center border border-gray-200">
                        <i class="fas fa-utensils text-gray-400"></i>
                    </div>
                    @endif

                    <div class="flex-1 min-w-0">
                        <h4 class="font-semibold text-gray-900">{{ $product->name }}</h4>
                        <div class="flex items-center gap-3 mt-1">
                            <span class="text-sm text-gray-500">{{ $product->restaurant->name }}</span>
                            <span class="text-xs px-2 py-0.5 rounded border {{ $product->is_active ? 'border-gray-900 text-gray-900 font-semibold' : 'border-gray-300 text-gray-500' }}">
                                {{ $product->is_active ? 'Aktif' : 'Pasif' }}
                            </span>
                            <span class="text-xs px-2 py-0.5 rounded border {{ $product->in_stock ? 'border-gray-900 text-gray-900 font-semibold' : 'border-gray-300 text-gray-500' }}">
                                {{ $product->in_stock ? 'Stokta' : 'Tükendi' }}
                            </span>
                        </div>
                    </div>
                </div>

                <div class="flex items-center gap-3">
                    <div class="flex items-center gap-2">
                        <input type="number"
                               name="prices[{{ $product->id }}]"
                               value="{{ $product->price }}"
                               step="0.01"
                               min="0"
                               class="w-28 px-3 py-2 border border-gray-300 rounded-lg focus:border-gray-900 focus:ring-2 focus:ring-gray-900/10 font-bold text-gray-900">
                        <span class="font-bold text-gray-900">₺</span>
                    </div>
                    <a href="{{ route('owner.products.edit', $product) }}"
                       class="w-9 h-9 flex items-center justify-center rounded-lg border border-gray-300 hover:border-gray-900 hover:bg-gray-50 transition-all"
                       title="Düzenle">
                        <i class="fas fa-edit text-gray-600"></i>
                    </a>
                    <button type="button"
                            onclick="if(confirm('Bu ürünü silmek istediğinizden emin misiniz?')) { document.getElementById('delete-form-{{ $product->id }}').submit(); }"
                            class="w-9 h-9 flex items-center justify-center rounded-lg border border-red-300 hover:border-red-600 hover:bg-red-50 transition-all"
                            title="Sil">
                        <i class="fas fa-trash text-red-600"></i>
                    </button>
                </div>
            </div>

            <form id="delete-form-{{ $product->id }}" action="{{ route('owner.products.destroy', $product) }}" method="POST" class="hidden">
                @csrf
                @method('DELETE')
            </form>
            @endforeach
        </div>
    </div>
    @empty
    <div class="card p-8 text-center">
        <i class="fas fa-box-open text-gray-300 text-5xl mb-4"></i>
        <p class="text-gray-500 text-lg mb-4">Henüz ürün bulunmamaktadır.</p>
        <a href="{{ route('owner.products.create') }}" class="inline-flex items-center gap-2 px-5 py-2.5 bg-gray-900 text-white font-semibold rounded-lg hover:bg-gray-800 transition-colors">
            <i class="fas fa-plus"></i>
            <span>İlk Ürününüzü Ekleyin</span>
        </a>
    </div>
    @endforelse
</form>

@push('scripts')
<script>
// Confirm before submitting bulk price update
document.getElementById('bulkPriceForm').addEventListener('submit', function(e) {
    if (!confirm('Tüm fiyat değişiklikleri kaydedilecek. Emin misiniz?')) {
        e.preventDefault();
    }
});
</script>
@endpush

@endsection
