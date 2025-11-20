@extends('layouts.admin')
@section('title', 'İşletme Sahipleri')
@section('page-title', 'İşletme Sahipleri')
@section('content')
<div class="mb-4">
    <a href="{{ route('admin.owners.create') }}" class="px-4 py-2 text-white rounded" style="background-color: var(--primary-orange);">Yeni İşletme Sahibi Ekle</a>
</div>

@if(session('success'))
<div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded">
    {{ session('success') }}
</div>
@endif

@if(session('error'))
<div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded">
    {{ session('error') }}
</div>
@endif

<div class="bg-white rounded-lg shadow-md overflow-hidden">
    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Ad Soyad</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">E-posta</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Restoran Sayısı</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Kayıt Tarihi</th>
                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">İşlemler</th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
            @forelse($owners as $owner)
            <tr>
                <td class="px-6 py-4 whitespace-nowrap font-semibold">{{ $owner->name }}</td>
                <td class="px-6 py-4 whitespace-nowrap">{{ $owner->email }}</td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <span class="px-2 py-1 text-xs rounded bg-blue-100 text-blue-800">
                        {{ $owner->restaurants->count() }} Restoran
                    </span>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">{{ $owner->created_at->format('d.m.Y') }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                    <a href="{{ route('admin.owners.edit', $owner) }}" class="text-blue-600 hover:text-blue-900 mr-3">Düzenle</a>
                    <form action="{{ route('admin.owners.destroy', $owner) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('Emin misiniz?')">Sil</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="px-6 py-4 text-center text-gray-500">Henüz işletme sahibi bulunmamaktadır.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
<div class="mt-4">{{ $owners->links() }}</div>
@endsection
