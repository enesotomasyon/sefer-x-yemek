@extends('layouts.owner')
@section('title', 'Ürünler')
@section('page-title', 'Ürünler')
@section('content')
<div class="mb-4">
    <a href="{{ route('owner.products.create') }}" class="px-4 py-2 text-white rounded" style="background-color: var(--primary-yellow);">Yeni Ürün Ekle</a>
</div>
<div class="bg-white rounded-lg shadow-md overflow-hidden">
    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Görsel</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Ürün Adı</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Restoran</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Kategori</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Fiyat</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Durum</th>
                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">İşlemler</th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
            @forelse($products as $product)
            <tr>
                <td class="px-6 py-4 whitespace-nowrap">
                    @if($product->image)
                    <img src="{{ asset('storage/' . $product->image) }}" class="w-16 h-16 rounded object-cover">
                    @else
                    <div class="w-16 h-16 bg-gray-200 rounded flex items-center justify-center">
                        <span class="text-gray-400">🍽️</span>
                    </div>
                    @endif
                </td>
                <td class="px-6 py-4 whitespace-nowrap font-semibold">{{ $product->name }}</td>
                <td class="px-6 py-4 whitespace-nowrap">{{ $product->restaurant->name }}</td>
                <td class="px-6 py-4 whitespace-nowrap">
                    @if($product->category)
                    <span class="px-2 py-1 text-xs rounded bg-gray-100">{{ $product->category->name }}</span>
                    @else
                    <span class="px-2 py-1 text-xs rounded bg-yellow-100 text-yellow-800">Kategorisiz</span>
                    @endif
                </td>
                <td class="px-6 py-4 whitespace-nowrap font-bold">{{ number_format($product->price, 2) }} ₺</td>
                <td class="px-6 py-4 whitespace-nowrap">
                    @if($product->is_available)
                    <span class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-800">Mevcut</span>
                    @else
                    <span class="px-2 py-1 text-xs rounded-full bg-red-100 text-red-800">Tükendi</span>
                    @endif
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                    <a href="{{ route('owner.products.edit', $product) }}" class="text-blue-600 hover:text-blue-900 mr-3">Düzenle</a>
                    <form action="{{ route('owner.products.destroy', $product) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('Emin misiniz?')">Sil</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="7" class="px-6 py-4 text-center text-gray-500">Henüz ürün bulunmamaktadır.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
<div class="mt-4">{{ $products->links() }}</div>
@endsection
