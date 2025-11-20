@extends('layouts.admin')
@section('title', 'Restoranlar')
@section('page-title', 'Restoranlar')
@section('content')
<div class="mb-4">
    <a href="{{ route('admin.restaurants.create') }}" class="px-4 py-2 text-white rounded" style="background-color: var(--primary-orange);">Yeni Restoran Ekle</a>
</div>
<div class="bg-white rounded-lg shadow-md overflow-hidden">
    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Logo</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Restoran Adı</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Sahibi</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Telefon</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Abonelik</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Durum</th>
                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">İşlemler</th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
            @forelse($restaurants as $restaurant)
            <tr>
                <td class="px-6 py-4 whitespace-nowrap">
                    @if($restaurant->logo)
                    <img src="{{ asset('storage/' . $restaurant->logo) }}" class="w-12 h-12 rounded-full object-cover">
                    @else
                    <div class="w-12 h-12 rounded-full bg-gradient-to-br from-orange-400 to-yellow-400 flex items-center justify-center text-white font-bold">
                        {{ substr($restaurant->name, 0, 1) }}
                    </div>
                    @endif
                </td>
                <td class="px-6 py-4 whitespace-nowrap font-semibold">{{ $restaurant->name }}</td>
                <td class="px-6 py-4 whitespace-nowrap">{{ $restaurant->owner->name }}</td>
                <td class="px-6 py-4 whitespace-nowrap">{{ $restaurant->phone ?? '-' }}</td>
                <td class="px-6 py-4 whitespace-nowrap">
                    @if($restaurant->subscription_end_date)
                        <span class="@if($restaurant->isSubscriptionActive()) text-green-600 @else text-red-600 @endif">
                            {{ $restaurant->subscription_end_date->format('d.m.Y') }}
                        </span>
                    @else
                        -
                    @endif
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                    @if($restaurant->is_active)
                    <span class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-800">Aktif</span>
                    @else
                    <span class="px-2 py-1 text-xs rounded-full bg-red-100 text-red-800">Pasif</span>
                    @endif
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                    <a href="{{ route('admin.restaurants.edit', $restaurant) }}" class="text-blue-600 hover:text-blue-900 mr-3">Düzenle</a>
                    <form action="{{ route('admin.restaurants.destroy', $restaurant) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('Emin misiniz?')">Sil</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="7" class="px-6 py-4 text-center text-gray-500">Henüz restoran bulunmamaktadır.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
<div class="mt-4">
    {{ $restaurants->links() }}
</div>
@endsection
