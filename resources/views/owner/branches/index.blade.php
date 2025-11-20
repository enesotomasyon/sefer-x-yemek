@extends('layouts.owner')
@section('title', 'Şubeler')
@section('page-title', 'Şubeler')
@section('content')
<div class="mb-4">
    <a href="{{ route('owner.branches.create') }}" class="px-4 py-2 text-white rounded" style="background-color: var(--primary-yellow);">Yeni Şube Ekle</a>
</div>
<div class="bg-white rounded-lg shadow-md overflow-hidden">
    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Şube Adı</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Restoran</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Adres</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Telefon</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Durum</th>
                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">İşlemler</th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
            @forelse($branches as $branch)
            <tr>
                <td class="px-6 py-4 whitespace-nowrap font-semibold">{{ $branch->name }}</td>
                <td class="px-6 py-4 whitespace-nowrap">{{ $branch->restaurant->name }}</td>
                <td class="px-6 py-4">{{ $branch->address }}</td>
                <td class="px-6 py-4 whitespace-nowrap">{{ $branch->phone }}</td>
                <td class="px-6 py-4 whitespace-nowrap">
                    @if($branch->is_approved)
                    <span class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-800">Onaylandı</span>
                    @else
                    <span class="px-2 py-1 text-xs rounded-full bg-yellow-100 text-yellow-800">Onay Bekliyor</span>
                    @endif
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                    <a href="{{ route('owner.branches.edit', $branch) }}" class="text-blue-600 hover:text-blue-900 mr-3">Düzenle</a>
                    <form action="{{ route('owner.branches.destroy', $branch) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('Emin misiniz?')">Sil</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="px-6 py-4 text-center text-gray-500">Henüz şube bulunmamaktadır.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
<div class="mt-4">{{ $branches->links() }}</div>
@endsection
