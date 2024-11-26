<!DOCTYPE html>
<html lang="en" data-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Hoops & More Basketball Store</title>
    {{-- <link rel="stylesheet" href="{{ asset('app.css') }}"> --}}
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    <style>
        :root {
            --primary: #ff6b00;
            --primary-dark: #e65c00;
            --dark: #1a1a1a;
            --light: #f8f9fa;
            --shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            
            --bg-color: #ffffff;
            --text-color: #1a1a1a;
            --header-bg: var(--dark);
            --card-bg: #ffffff;
        }

        [data-theme="dark"] {
            --bg-color: #121212;
            --text-color: #ffffff;
            --header-bg: #000000;
            --card-bg: #1e1e1e;
        }

        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            line-height: 1.6;
            background-color: var(--bg-color);
            background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M30 30c2-2 2-4 2-6s-0-4-2-6s-4-2-6-2s-4 0-6 2s-2 4-2 6s0 4 2 6s4 2 6 2s4-0 6-2zm0 0c-2 2-4 2-6 2s-4-0-6-2s-2-4-2-6s0-4 2-6s4-2 6-2s4 0 6 2s2 4 2 6s-0 4-2 6z' fill='%23ff6b00' fill-opacity='0.05' fill-rule='evenodd'/%3E%3C/svg%3E");
            color: var(--text-color);
            transition: background-color 0.3s ease;
        }

        header {
            background-color: var(--header-bg);
            padding: 1rem;
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .header-container {
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .site-title {
            margin: 0;
            font-size: 2.2rem;
            font-weight: 600;
            color: var(--primary);
            letter-spacing: -0.5px;
        }

        nav {
            margin: 0;
            display: flex;
            align-items: center;
            gap: 1.5rem;
        }

        .nav-link {
            color: white;
            text-decoration: none;
            padding: 0.5rem 1rem;
            font-weight: 500;
            transition: all 0.2s ease;
            position: relative;
        }

        .nav-link::after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            bottom: 0;
            left: 0;
            background-color: var(--primary);
            transition: width 0.2s ease;
        }

        .nav-link:hover::after {
            width: 100%;
        }

        .btn {
            background-color: var(--primary);
            color: white;
            border: none;
            padding: 0.7rem 1.5rem;
            border-radius: 8px;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
            font-weight: 500;
            transition: all 0.2s ease;
            box-shadow: 0 2px 4px rgba(255, 107, 0, 0.2);
        }

        .btn:hover {
            background-color: var(--primary-dark);
            transform: translateY(-1px);
            box-shadow: 0 4px 6px rgba(255, 107, 0, 0.3);
        }

        main {
            padding: 2.5rem;
            max-width: 1200px;
            margin: 2rem auto 6rem;
            background-color: var(--card-bg);
            border-radius: 16px;
            box-shadow: var(--shadow);
            transition: background-color 0.3s ease;
        }

        .alert {
            padding: 1rem 1.5rem;
            margin-bottom: 1.5rem;
            border-radius: 8px;
            border: none;
            display: flex;
            align-items: center;
        }

        .alert-success {
            background-color: #ecfdf5;
            color: #065f46;
        }

        .alert-error {
            background-color: #fef2f2;
            color: #991b1b;
        }

        footer {
            background-color: var(--dark);
            color: #9ca3af;
            text-align: center;
            padding: 1.5rem;
            position: fixed;
            bottom: 0;
            width: 100%;
            box-shadow: 0 -4px 6px -1px rgba(0, 0, 0, 0.1);
        }

        .theme-toggle {
            background: none;
            border: none;
            color: white;
            cursor: pointer;
            font-size: 1.2rem;
            padding: 0.5rem;
        }

        .mobile-menu-btn {
            display: none;
            background: none;
            border: none;
            color: white;
            font-size: 1.5rem;
            cursor: pointer;
        }

        @media (max-width: 768px) {
            .mobile-menu-btn {
                display: block;
            }

            nav {
                display: none;
                position: absolute;
                top: 100%;
                left: 0;
                right: 0;
                background: var(--header-bg);
                flex-direction: column;
                padding: 1rem;
            }

            nav.active {
                display: flex;
            }
        }
    </style>

    @yield('styles')
</head>

<body>
    <header>
        <div class="header-container">
            <h1 class="site-title">🏀 Hoops & More 🏀</h1>
            <button class="mobile-menu-btn">
                <i class="fas fa-bars"></i>
            </button>
            <nav>
                <a href="/" class="nav-link"><i class="fas fa-home"></i> Home</a>
                <a href="/shop" class="nav-link"><i class="fas fa-store"></i> Shop</a>
                <a href="/news" class="nav-link"><i class="fas fa-newspaper"></i> News</a>

                <button class="theme-toggle" aria-label="Toggle theme">
                    <i class="fas fa-moon"></i>
                </button>

                @guest
                    <a href="/login" class="btn"><i class="fas fa-sign-in-alt"></i> Login</a>
                @endguest

                @auth
                    <a href="/profile" class="nav-link">
                        <i class="fas fa-user"></i> {{ Auth::user()->name }}
                    </a>
                    <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                        @csrf
                        <button type="submit" class="btn">
                            <i class="fas fa-sign-out-alt"></i> Logout
                        </button>
                    </form>
                @endauth
            </nav>
        </div>
    </header>

    <main>
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div class="alert alert-error">
                {{ session('error') }}
            </div>
        @endif
        @if($errors->any())
            <div class="alert alert-error">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @yield('content')
    </main>

    <footer>
        <p style="margin: 0;">© 2024 Hoops & More - Your Premium Basketball Store</p>
    </footer>

    <script>
        // Theme Switcher
        const themeToggle = document.querySelector('.theme-toggle');
        const icon = themeToggle.querySelector('i');

        themeToggle.addEventListener('click', () => {
            const html = document.documentElement;
            const currentTheme = html.getAttribute('data-theme');
            const newTheme = currentTheme === 'light' ? 'dark' : 'light';
            
            html.setAttribute('data-theme', newTheme);
            icon.className = newTheme === 'light' ? 'fas fa-moon' : 'fas fa-sun';
        });

        // Mobile Menu
        const mobileMenuBtn = document.querySelector('.mobile-menu-btn');
        const nav = document.querySelector('nav');

        mobileMenuBtn.addEventListener('click', () => {
            nav.classList.toggle('active');
        });
    </script>
</body>
</html>