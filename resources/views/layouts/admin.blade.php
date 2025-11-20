<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Panel') - Dijital Menü</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        :root {
            --primary-orange: #e84e0f;
            --primary-yellow: #f7a600;
            --gray: #9d9d9c;
        }
    </style>
    @stack('styles')
</head>
<body class="bg-gray-100">
    <div class="flex h-screen">
        <!-- Sidebar -->
        <aside class="w-64 bg-gray-800 text-white flex-shrink-0">
            <div class="p-6">
                <h1 class="text-2xl font-bold" style="color: var(--primary-orange);">Admin Panel</h1>
            </div>

            <nav class="mt-6">
                <a href="{{ route('admin.dashboard') }}"
                   class="block px-6 py-3 hover:bg-gray-700 {{ request()->routeIs('admin.dashboard') ? 'bg-gray-700 border-l-4' : '' }}"
                   style="{{ request()->routeIs('admin.dashboard') ? 'border-color: var(--primary-orange);' : '' }}">
                    Dashboard
                </a>
                <a href="{{ route('admin.restaurants.index') }}"
                   class="block px-6 py-3 hover:bg-gray-700 {{ request()->routeIs('admin.restaurants.*') ? 'bg-gray-700 border-l-4' : '' }}"
                   style="{{ request()->routeIs('admin.restaurants.*') ? 'border-color: var(--primary-orange);' : '' }}">
                    Restoranlar
                </a>
                <a href="{{ route('admin.categories.index') }}"
                   class="block px-6 py-3 hover:bg-gray-700 {{ request()->routeIs('admin.categories.*') ? 'bg-gray-700 border-l-4' : '' }}"
                   style="{{ request()->routeIs('admin.categories.*') ? 'border-color: var(--primary-orange);' : '' }}">
                    Kategoriler
                </a>
                <a href="{{ route('admin.sliders.index') }}"
                   class="block px-6 py-3 hover:bg-gray-700 {{ request()->routeIs('admin.sliders.*') ? 'bg-gray-700 border-l-4' : '' }}"
                   style="{{ request()->routeIs('admin.sliders.*') ? 'border-color: var(--primary-orange);' : '' }}">
                    Slider Yönetimi
                </a>
                <a href="{{ route('admin.branches.index') }}"
                   class="block px-6 py-3 hover:bg-gray-700 {{ request()->routeIs('admin.branches.*') ? 'bg-gray-700 border-l-4' : '' }}"
                   style="{{ request()->routeIs('admin.branches.*') ? 'border-color: var(--primary-orange);' : '' }}">
                    Şube Onayları
                </a>
            </nav>
        </aside>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col overflow-hidden">
            <!-- Top Navigation -->
            <header class="bg-white shadow-sm">
                <div class="flex items-center justify-between px-6 py-4">
                    <h2 class="text-xl font-semibold text-gray-800">@yield('page-title', 'Dashboard')</h2>

                    <div class="flex items-center space-x-4">
                        <a href="{{ route('home') }}" class="text-gray-600 hover:text-gray-800">
                            Ana Sayfa
                        </a>
                        <span class="text-gray-600">{{ auth()->user()->name }}</span>
                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button type="submit" class="text-gray-600 hover:text-gray-800">
                                Çıkış Yap
                            </button>
                        </form>
                    </div>
                </div>
            </header>

            <!-- Page Content -->
            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-100 p-6">
                @if(session('success'))
                <div class="mb-4 px-4 py-3 rounded bg-green-100 text-green-700">
                    {{ session('success') }}
                </div>
                @endif

                @if(session('error'))
                <div class="mb-4 px-4 py-3 rounded bg-red-100 text-red-700">
                    {{ session('error') }}
                </div>
                @endif

                @yield('content')
            </main>
        </div>
    </div>

    @stack('scripts')
</body>
</html>
