@extends('layouts.owner')
@section('title', 'İşletmelerim')
@section('page-title', 'İşletmelerim')
@section('content')
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    @forelse($restaurants as $restaurant)
    <div class="card overflow-hidden">
        @if($restaurant->logo)
        <img src="{{ asset('storage/' . $restaurant->logo) }}" class="w-full h-48 object-cover">
        @else
        <div class="w-full h-48 bg-gray-100 flex items-center justify-center border-b border-gray-200">
            <i class="fas fa-utensils text-gray-400 text-4xl"></i>
        </div>
        @endif
        <div class="p-6">
            <h3 class="text-xl font-bold mb-2 text-gray-900">{{ $restaurant->name }}</h3>
            <p class="text-gray-600 text-sm mb-4">{{ $restaurant->description }}</p>
            <div class="space-y-2 mb-4">
                <div class="flex items-center justify-between pb-2 border-b border-gray-100">
                    <span class="text-sm text-gray-500 font-medium">Abonelik:</span>
                    <span class="text-sm font-semibold {{ $restaurant->isSubscriptionActive() ? 'text-gray-900' : 'text-red-600' }}">
                        {{ $restaurant->subscription_end_date?->format('d.m.Y') }}
                    </span>
                </div>
                <div class="flex items-center justify-between">
                    <span class="text-sm text-gray-500 font-medium">Durum:</span>
                    @if($restaurant->is_active)
                    <span class="px-2 py-1 text-xs rounded border border-gray-900 text-gray-900 font-semibold">Aktif</span>
                    @else
                    <span class="px-2 py-1 text-xs rounded border border-gray-300 text-gray-500">Pasif</span>
                    @endif
                </div>
            </div>
            <div class="flex gap-2">
                <a href="{{ route('owner.restaurants.edit', $restaurant) }}" class="flex-1 px-4 py-2.5 bg-gray-900 text-white text-sm font-semibold rounded-lg hover:bg-gray-800 text-center transition-colors">
                    <i class="fas fa-edit mr-1"></i> Düzenle
                </a>
                <a href="{{ route('owner.qr.generate', $restaurant) }}" class="flex-1 px-4 py-2.5 border-2 border-gray-900 text-gray-900 text-sm font-semibold rounded-lg hover:bg-gray-50 text-center transition-colors">
                    <i class="fas fa-qrcode mr-1"></i> QR Kod
                </a>
            </div>
        </div>
    </div>
    @empty
    <div class="col-span-3 card p-8 text-center">
        <i class="fas fa-store text-gray-300 text-5xl mb-4"></i>
        <p class="text-gray-500 text-lg">Henüz işletme bulunmamaktadır.</p>
        <p class="text-gray-400 text-sm mt-2">Admin tarafından size işletme atanması bekleniyor.</p>
    </div>
    @endforelse
</div>
<div class="mt-6">{{ $restaurants->links() }}</div>
@endsection
