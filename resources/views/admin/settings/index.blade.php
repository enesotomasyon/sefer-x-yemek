@extends('layouts.admin')

@section('title', 'Site Ayarları')
@section('page-title', 'Site Ayarları')

@section('content')
<div class="max-w-3xl">
    @if(session('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
        <span class="block sm:inline">{{ session('success') }}</span>
    </div>
    @endif

    @if(session('error'))
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
        <span class="block sm:inline">{{ session('error') }}</span>
    </div>
    @endif

    <!-- Logo Ayarları -->
    <div class="bg-white rounded-lg shadow-md p-6">
        <h2 class="text-xl font-bold mb-4 text-gray-800">Site Logosu</h2>

        @if($logo)
        <div class="mb-6">
            <p class="text-sm text-gray-600 mb-2">Mevcut Logo:</p>
            <div class="flex items-center gap-4">
                <img src="{{ asset('storage/' . $logo) }}" alt="Site Logo" class="h-16 object-contain bg-gray-100 p-2 rounded">
                <form method="POST" action="{{ route('admin.settings.deleteLogo') }}" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-red-600 hover:text-red-800 text-sm font-medium" onclick="return confirm('Logoyu silmek istediğinize emin misiniz?')">
                        <i class="fas fa-trash mr-1"></i> Logoyu Sil
                    </button>
                </form>
            </div>
        </div>
        @endif

        <form method="POST" action="{{ route('admin.settings.update') }}" enctype="multipart/form-data">
            @csrf

            <div class="mb-4">
                <label for="logo" class="block text-sm font-medium text-gray-700 mb-2">
                    {{ $logo ? 'Yeni Logo Yükle' : 'Logo Yükle' }}
                </label>
                <input type="file"
                       name="logo"
                       id="logo"
                       accept="image/jpeg,image/png,image/jpg,image/svg+xml"
                       class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none focus:border-blue-500">
                <p class="mt-1 text-sm text-gray-500">PNG, JPG, JPEG veya SVG (Maks. 2MB)</p>
                @error('logo')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex justify-end">
                <button type="submit" class="btn-primary">
                    <i class="fas fa-save mr-2"></i>
                    {{ $logo ? 'Logoyu Güncelle' : 'Logoyu Kaydet' }}
                </button>
            </div>
        </form>

        <div class="mt-6 p-4 bg-blue-50 rounded-lg">
            <p class="text-sm text-blue-800">
                <i class="fas fa-info-circle mr-2"></i>
                <strong>Not:</strong> Logo, sitenin sol üst köşesinde ve navigation bar'da görüntülenecektir.
                En iyi görünüm için şeffaf arkaplan (PNG) ve yatay düzende bir logo kullanmanız önerilir.
            </p>
        </div>
    </div>

    <!-- Tanıtım Videosu Ayarları -->
    <div class="bg-white rounded-lg shadow-md p-6 mt-6">
        <h2 class="text-xl font-bold mb-4 text-gray-800">Tanıtım Videosu</h2>

        @if($introVideo)
        <div class="mb-6">
            <p class="text-sm text-gray-600 mb-2">Mevcut Video:</p>
            <div class="flex items-center gap-4">
                <video class="h-32 rounded-lg" controls>
                    <source src="{{ asset('storage/' . $introVideo) }}" type="video/mp4">
                </video>
                <form method="POST" action="{{ route('admin.settings.deleteVideo') }}" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-red-600 hover:text-red-800 text-sm font-medium" onclick="return confirm('Videoyu silmek istediğinize emin misiniz?')">
                        <i class="fas fa-trash mr-1"></i> Videoyu Sil
                    </button>
                </form>
            </div>
        </div>
        @endif

        <form method="POST" action="{{ route('admin.settings.update') }}" enctype="multipart/form-data">
            @csrf

            <div class="mb-4">
                <label for="intro_video" class="block text-sm font-medium text-gray-700 mb-2">
                    {{ $introVideo ? 'Yeni Video Yükle' : 'Video Yükle' }}
                </label>
                <input type="file"
                       name="intro_video"
                       id="intro_video"
                       accept="video/mp4,video/webm,video/ogg"
                       class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none focus:border-blue-500">
                <p class="mt-1 text-sm text-gray-500">MP4, WebM veya OGG (Maks. 100MB)</p>
                @error('intro_video')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex justify-end">
                <button type="submit" class="btn-primary">
                    <i class="fas fa-save mr-2"></i>
                    {{ $introVideo ? 'Videoyu Güncelle' : 'Videoyu Kaydet' }}
                </button>
            </div>
        </form>

        <div class="mt-6 p-4 bg-blue-50 rounded-lg">
            <p class="text-sm text-blue-800">
                <i class="fas fa-info-circle mr-2"></i>
                <strong>Not:</strong> Video, ana sayfada slider'dan sonra otomatik olarak loop (döngü) şeklinde oynatılacaktır.
                En iyi görünüm için yatay (landscape) düzende ve 1920x1080 (Full HD) çözünürlükte video kullanmanız önerilir.
            </p>
        </div>
    </div>
</div>
@endsection
