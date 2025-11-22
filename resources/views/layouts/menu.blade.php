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
            --primary-orange: #181818;
            --primary-yellow: #181818;
            --gray: #9d9d9c;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            min-height: 100vh;
        }

        .glass-effect {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.15);
        }

        .category-sticky {
            position: sticky;
            top: 0;
            z-index: 10;
            background: rgba(255, 255, 255, 0.98);
            backdrop-filter: blur(10px);
        }

        .product-card {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
        }

        .price-badge {
            background: linear-gradient(135deg, var(--primary-orange), var(--primary-yellow));
            color: white;
            font-weight: bold;
        }

        .category-icon {
            background: linear-gradient(135deg, var(--primary-orange), var(--primary-yellow));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
    </style>
    @stack('styles')
</head>
<body>
    <main>
        @yield('content')
    </main>

    @stack('scripts')
</body>
</html>
