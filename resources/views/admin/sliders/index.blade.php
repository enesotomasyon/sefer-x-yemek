@extends('layouts.admin')
@section('title', 'Slider Yönetimi')
@section('page-title', 'Slider Yönetimi')
@section('content')
<div class="mb-4">
    <a href="{{ route('admin.sliders.create') }}" class="px-4 py-2 text-white rounded" style="background-color: var(--primary-orange);">Yeni Slider Ekle</a>
</div>
<div class="bg-white rounded-lg shadow-md overflow-hidden">
    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Görsel</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Başlık</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Link Tipi</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Sıra</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Durum</th>
                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">İşlemler</th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
            @forelse($sliders as $slider)
            <tr>
                <td class="px-6 py-4 whitespace-nowrap">
                    <img src="{{ asset('storage/' . $slider->image) }}" class="w-20 h-12 object-cover rounded">
                </td>
                <td class="px-6 py-4 whitespace-nowrap font-semibold">{{ $slider->title }}</td>
                <td class="px-6 py-4 whitespace-nowrap">
                    @if($slider->link_type === 'restaurant')
                        <span class="text-blue-600">Restoran</span>
                    @elseif($slider->link_type === 'product')
                        <span class="text-green-600">Ürün</span>
                    @else
                        <span class="text-gray-600">Dış Link</span>
                    @endif
                </td>
                <td class="px-6 py-4 whitespace-nowrap">{{ $slider->order }}</td>
                <td class="px-6 py-4 whitespace-nowrap">
                    @if($slider->is_active)
                    <span class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-800">Aktif</span>
                    @else
                    <span class="px-2 py-1 text-xs rounded-full bg-gray-100 text-gray-800">Pasif</span>
                    @endif
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                    <a href="{{ route('admin.sliders.edit', $slider) }}" class="text-blue-600 hover:text-blue-900 mr-3">Düzenle</a>
                    <form action="{{ route('admin.sliders.destroy', $slider) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('Emin misiniz?')">Sil</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="px-6 py-4 text-center text-gray-500">Henüz slider bulunmamaktadır.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
<div class="mt-4">{{ $sliders->links() }}</div>
@endsection
