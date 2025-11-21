<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('QR Code - ') . $restaurant->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="text-center">
                        <h3 class="text-2xl font-bold mb-4">{{ $restaurant->name }}</h3>
                        <p class="text-gray-600 mb-6">Müşterileriniz bu QR kodu taratarak menünüze ulaşabilir</p>

                        <div class="flex justify-center mb-6">
                            <div class="p-4 bg-white border-4 border-gray-800 rounded-lg">
                                {!! QrCode::size(300)->generate($url) !!}
                            </div>
                        </div>

                        <div class="bg-gray-50 p-4 rounded-lg mb-6">
                            <p class="text-sm text-gray-600 mb-2">Menü URL:</p>
                            <a href="{{ $url }}" target="_blank" class="text-blue-600 hover:underline">
                                {{ $url }}
                            </a>
                        </div>

                        <div class="flex justify-center gap-4">
                            <a href="{{ route('owner.restaurants.show', $restaurant) }}"
                               class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                                Geri Dön
                            </a>
                            <button onclick="window.print()"
                                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                QR Kodu Yazdır
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        @media print {
            body * {
                visibility: hidden;
            }
            .p-4.bg-white.border-4, .p-4.bg-white.border-4 * {
                visibility: visible;
            }
            .p-4.bg-white.border-4 {
                position: absolute;
                left: 50%;
                top: 50%;
                transform: translate(-50%, -50%);
            }
        }
    </style>
</x-app-layout>
