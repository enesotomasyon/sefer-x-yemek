<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dijital Menü')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">
    <style>
        :root {
            --primary-orange: #FF6B35;
            --primary-orange-dark: #F7931E;
            --slate-dark: #1E293B;
            --slate-darker: #0F172A;
            --accent-gold: #FFA500;
            --accent-gold-dark: #FF8C00;
            --gray-light: #F1F5F9;
            --gray: #64748B;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
            background-color: #FFFFFF;
            color: var(--slate-dark);
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--primary-orange) 0%, var(--primary-orange-dark) 100%);
            color: white;
            padding: 0.75rem 2rem;
            border-radius: 0.75rem;
            transition: all 0.3s;
            font-weight: 600;
            box-shadow: 0 4px 6px -1px rgba(255, 107, 53, 0.2);
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 15px -3px rgba(255, 107, 53, 0.3);
        }

        .btn-secondary {
            background: linear-gradient(135deg, var(--accent-gold) 0%, var(--accent-gold-dark) 100%);
            color: white;
            padding: 0.75rem 2rem;
            border-radius: 0.75rem;
            transition: all 0.3s;
            font-weight: 600;
            box-shadow: 0 4px 6px -1px rgba(255, 165, 0, 0.2);
        }

        .btn-secondary:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 15px -3px rgba(255, 165, 0, 0.3);
        }

        .text-primary {
            color: var(--primary-orange);
        }

        .text-secondary {
            color: var(--accent-gold);
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
    <nav class="bg-white shadow-sm relative z-50">
        <div class="container mx-auto px-4">
            <div class="flex justify-between items-center py-4">
                <a href="{{ route('home') }}" class="flex items-center">
                    @php
                        $logo = \App\Models\Setting::get('site_logo');
                    @endphp
                    @if($logo)
                        <img src="{{ asset('storage/' . $logo) }}" alt="Logo" class="h-16 md:h-20 object-contain">
                    @else
                        <span class="text-2xl font-bold text-primary">Dijital Menü</span>
                    @endif
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

    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    @stack('scripts')
</body>
</html>
