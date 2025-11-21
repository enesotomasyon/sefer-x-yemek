<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dijital Menü')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        :root {
            --primary-orange: #e84e0f;
            --primary-yellow: #f7a600;
            --gray: #9d9d9c;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: #f8f9fa;
        }

        .btn-primary {
            background-color: var(--primary-orange);
            color: white;
            padding: 0.5rem 1.5rem;
            border-radius: 0.5rem;
            transition: all 0.3s;
        }

        .btn-primary:hover {
            background-color: #c93d0a;
        }

        .btn-secondary {
            background-color: var(--primary-yellow);
            color: white;
            padding: 0.5rem 1.5rem;
            border-radius: 0.5rem;
            transition: all 0.3s;
        }

        .btn-secondary:hover {
            background-color: #d89400;
        }

        .text-primary {
            color: var(--primary-orange);
        }

        .text-secondary {
            color: var(--primary-yellow);
        }

        .text-gray {
            color: var(--gray);
        }

        .border-primary {
            border-color: var(--primary-orange);
        }
    </style>
    @stack('styles')
</head>
<body>
    <!-- Navigation -->
    <nav class="bg-white shadow-sm">
        <div class="container mx-auto px-4">
            <div class="flex justify-between items-center py-4">
                <a href="{{ route('home') }}" class="text-2xl font-bold text-primary">
                    Dijital Menü
                </a>

                <div class="flex items-center space-x-4">
                    @auth
                        @if(auth()->user()->hasRole('admin'))
                            <a href="{{ route('admin.dashboard') }}" class="text-gray-700 hover:text-primary">
                                Admin Panel
                            </a>
                        @elseif(auth()->user()->hasRole('owner'))
                            <a href="{{ route('owner.dashboard') }}" class="text-gray-700 hover:text-primary">
                                İşletme Paneli
                            </a>
                        @endif

                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button type="submit" class="text-gray-700 hover:text-primary">
                                Çıkış Yap
                            </button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="text-gray-700 hover:text-primary">
                            Giriş Yap
                        </a>
                        <a href="{{ route('register') }}" class="btn-primary">
                            Kayıt Ol
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white mt-12">
        <div class="container mx-auto px-4 py-8">
            <div class="text-center">
                <p>&copy; {{ date('Y') }} Dijital Menü. Tüm hakları saklıdır.</p>
            </div>
        </div>
    </footer>

    @stack('scripts')
</body>
</html>
