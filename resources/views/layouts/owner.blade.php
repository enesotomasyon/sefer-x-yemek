<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'İşletme Paneli') - Dijital Menü</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        :root {
            --primary-orange: #e84e0f;
            --primary-yellow: #f7a600;
            --bg-main: #f5f5f5;
            --text-main: #181818;
            --sidebar-bg: #ffffff;
            --card-bg: #ffffff;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
            background-color: var(--bg-main);
            color: var(--text-main);
        }

        .sidebar-link {
            transition: all 0.2s ease;
        }

        .sidebar-link:hover {
            background-color: rgba(24, 24, 24, 0.05);
            border-left-color: #181818;
        }

        .sidebar-link.active {
            background-color: rgba(24, 24, 24, 0.08);
            border-left-color: #181818;
            font-weight: 600;
        }

        .card {
            background: var(--card-bg);
            border-radius: 12px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.08);
            border: 1px solid rgba(0, 0, 0, 0.06);
        }

        .card:hover {
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.12);
        }

        .restaurant-selector {
            background: #181818;
            border-radius: 12px;
            padding: 1rem;
            margin: 1rem;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }

        .select-modern {
            background: white;
            border: 2px solid transparent;
            transition: all 0.2s ease;
        }

        .select-modern:focus {
            border-color: #181818;
            outline: none;
            box-shadow: 0 0 0 3px rgba(24, 24, 24, 0.1);
        }
    </style>
    @stack('styles')
</head>
<body>
    <div class="flex h-screen">
        <!-- Sidebar -->
        <aside class="w-72 flex-shrink-0" style="background-color: var(--sidebar-bg); border-right: 1px solid rgba(0,0,0,0.06);">
            <div class="p-6 border-b" style="border-color: rgba(0,0,0,0.06);">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-lg bg-gray-900 flex items-center justify-center">
                        <i class="fas fa-utensils text-white text-lg"></i>
                    </div>
                    <div>
                        <h1 class="text-lg font-bold text-gray-900">İşletme Paneli</h1>
                        <p class="text-xs text-gray-500">Dijital Menü</p>
                    </div>
                </div>
            </div>

            <!-- Restaurant Selector -->
            <div class="restaurant-selector">
                <label class="block text-white text-xs font-semibold mb-2">
                    <i class="fas fa-store mr-1"></i> AKTİF İŞLETME
                </label>
                <form action="{{ route('owner.select-restaurant') }}" method="POST" id="restaurantSelectorForm">
                    @csrf
                    <select name="restaurant_id"
                            onchange="document.getElementById('restaurantSelectorForm').submit()"
                            class="select-modern w-full px-3 py-2.5 rounded-lg text-sm font-medium text-gray-800">
                        <option value="">Tüm İşletmeler</option>
                        @foreach(auth()->user()->restaurants as $rest)
                        <option value="{{ $rest->id }}" {{ session('selected_restaurant_id') == $rest->id ? 'selected' : '' }}>
                            {{ $rest->name }}
                        </option>
                        @endforeach
                    </select>
                </form>
            </div>

            <nav class="mt-2 px-3">
                <a href="{{ route('owner.dashboard') }}"
                   class="sidebar-link flex items-center gap-3 px-4 py-3 rounded-lg mb-1 border-l-4 border-transparent {{ request()->routeIs('owner.dashboard') ? 'active' : '' }}">
                    <i class="fas fa-chart-line w-5"></i>
                    <span>Dashboard</span>
                </a>
                <a href="{{ route('owner.restaurants.index') }}"
                   class="sidebar-link flex items-center gap-3 px-4 py-3 rounded-lg mb-1 border-l-4 border-transparent {{ request()->routeIs('owner.restaurants.*') ? 'active' : '' }}">
                    <i class="fas fa-store w-5"></i>
                    <span>Restoranlarım</span>
                </a>
                <a href="{{ route('owner.products.index') }}"
                   class="sidebar-link flex items-center gap-3 px-4 py-3 rounded-lg mb-1 border-l-4 border-transparent {{ request()->routeIs('owner.products.*') ? 'active' : '' }}">
                    <i class="fas fa-box w-5"></i>
                    <span>Ürünler</span>
                </a>
                <a href="{{ route('owner.category-images.index') }}"
                   class="sidebar-link flex items-center gap-3 px-4 py-3 rounded-lg mb-1 border-l-4 border-transparent {{ request()->routeIs('owner.category-images.*') ? 'active' : '' }}">
                    <i class="fas fa-image w-5"></i>
                    <span>Kategori Görselleri</span>
                </a>
                <a href="{{ route('owner.branches.index') }}"
                   class="sidebar-link flex items-center gap-3 px-4 py-3 rounded-lg mb-1 border-l-4 border-transparent {{ request()->routeIs('owner.branches.*') ? 'active' : '' }}">
                    <i class="fas fa-code-branch w-5"></i>
                    <span>Şubeler</span>
                </a>
            </nav>

            <!-- User Section at Bottom -->
            <div class="absolute bottom-0 w-72 p-4 border-t" style="border-color: rgba(0,0,0,0.06); background: var(--sidebar-bg);">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <div class="w-9 h-9 rounded-full bg-gray-900 flex items-center justify-center text-white font-bold text-sm">
                            {{ substr(auth()->user()->name, 0, 1) }}
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-semibold truncate text-gray-900">{{ auth()->user()->name }}</p>
                            <p class="text-xs text-gray-500">İşletme Sahibi</p>
                        </div>
                    </div>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="text-gray-400 hover:text-gray-900 transition-colors" title="Çıkış Yap">
                            <i class="fas fa-sign-out-alt"></i>
                        </button>
                    </form>
                </div>
            </div>
        </aside>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col overflow-hidden">
            <!-- Top Header -->
            <header class="bg-white shadow-sm border-b" style="border-color: rgba(0,0,0,0.06);">
                <div class="flex items-center justify-between px-8 py-4">
                    <div>
                        <h2 class="text-2xl font-bold text-gray-900">@yield('page-title', 'Dashboard')</h2>
                        @if(session('selected_restaurant_id'))
                            <p class="text-sm text-gray-500 mt-0.5">
                                <i class="fas fa-filter text-xs"></i>
                                {{ auth()->user()->restaurants->find(session('selected_restaurant_id'))->name ?? 'Tüm İşletmeler' }}
                            </p>
                        @endif
                    </div>

                    <div class="flex items-center gap-4">
                        <a href="{{ route('home') }}" class="flex items-center gap-2 px-4 py-2 text-gray-600 hover:text-gray-900 transition-colors">
                            <i class="fas fa-globe text-sm"></i>
                            <span class="text-sm">Ana Sayfa</span>
                        </a>
                    </div>
                </div>
            </header>

            <!-- Page Content -->
            <main class="flex-1 overflow-x-hidden overflow-y-auto p-8" style="background-color: var(--bg-main);">
                @if(session('success'))
                <div class="mb-6 px-5 py-4 rounded-lg bg-green-50 border border-green-200 text-green-800 flex items-center gap-3">
                    <i class="fas fa-check-circle text-green-500"></i>
                    <span class="font-medium">{{ session('success') }}</span>
                </div>
                @endif

                @if(session('error'))
                <div class="mb-6 px-5 py-4 rounded-lg bg-red-50 border border-red-200 text-red-800 flex items-center gap-3">
                    <i class="fas fa-exclamation-circle text-red-500"></i>
                    <span class="font-medium">{{ session('error') }}</span>
                </div>
                @endif

                @yield('content')
            </main>
        </div>
    </div>

    @stack('scripts')
</body>
</html>
