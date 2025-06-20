<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Pitstop')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
</head>
<body class="bg-midnight text-white font-sans antialiased">
    <!-- Navigation -->
    <nav class="fixed top-0 w-full z-50 bg-black/80 backdrop-blur-md ">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                <!-- Logo -->
                <div class="flex-shrink-0">
                    <a href="/" class="text-2xl font-bold tracking-widest text-white hover:text-gray-300 transition-colors duration-300">
                        PITSTOP
                    </a>
                </div>

                <!-- Desktop Navigation -->
                <div class="hidden md:block">
                    <div class="ml-10 flex items-baseline space-x-8">
                        <a href="/" class="text-chiffon hover:text-pblue px-3 py-2 text-sm font-medium uppercase tracking-wider transition-colors duration-300">
                            Home
                        </a>
                        @if(Auth::guard('mechanic')->check())
                            <a href="{{ route('service.index') }}" class="text-gray-300 hover:text-white px-3 py-2 text-sm font-medium uppercase tracking-wider transition-colors duration-300">
                                Service
                            </a>
                            <a href="{{ route('profile') }}" class="text-gray-300 hover:text-white px-3 py-2 text-sm font-medium uppercase tracking-wider transition-colors duration-300">
                                Account
                            </a>
                            <form method="POST" action="{{ route('logout') }}" class="inline">
                                @csrf
                                <button type="submit" class="text-gray-300 hover:text-white px-3 py-2 text-sm font-medium uppercase tracking-wider transition-colors duration-300">
                                    Logout
                                </button>
                            </form>
                        @elseif(Auth::guard('web')->check())
                            <a href="{{ route('cars.index') }}" class="text-gray-300 hover:text-white px-3 py-2 text-sm font-medium uppercase tracking-wider transition-colors duration-300">
                                Wagens
                            </a>
                            <a href="{{ route('mechanics.index') }}" class="text-gray-300 hover:text-white px-3 py-2 text-sm font-medium uppercase tracking-wider transition-colors duration-300">
                                Mechaniekers
                            </a>
                            <a href="{{ route('service.index') }}" class="text-gray-300 hover:text-white px-3 py-2 text-sm font-medium uppercase tracking-wider transition-colors duration-300">
                                Service
                            </a>
                            <a href="{{ route('profile') }}" class="text-gray-300 hover:text-white px-3 py-2 text-sm font-medium uppercase tracking-wider transition-colors duration-300">
                                Account
                            </a>
                            <form method="POST" action="{{ route('logout') }}" class="inline">
                                @csrf
                                <button type="submit" class="text-gray-300 hover:text-white px-3 py-2 text-sm font-medium uppercase tracking-wider transition-colors duration-300">
                                    Logout
                                </button>
                            </form>
                        @else
                            <a href="{{ route('login') }}" class="text-gray-300 hover:text-white px-3 py-2 text-sm font-medium uppercase tracking-wider transition-colors duration-300">
                                Login
                            </a>
                            <a href="{{ route('register') }}" class="bg-caribbean text-white px-6 py-2 text-sm font-medium uppercase tracking-wider hover:bg-gray-200 transition-colors duration-300">
                                Register
                            </a>
                        @endif
                    </div>
                </div>

                <!-- Mobile menu button -->
                <div class="md:hidden">
                    <button type="button" class="text-gray-300 hover:text-white focus:outline-none focus:text-white" id="mobile-menu-button">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile menu -->
        <div class="md:hidden hidden" id="mobile-menu">
            <div class="px-2 pt-2 pb-3 space-y-1 bg-black/95 backdrop-blur-md">
                <a href="/" class="text-white block px-3 py-2 text-base font-medium uppercase tracking-wider">Home</a>
                @if(Auth::guard('mechanic')->check())
                    <a href="{{ route('service.index') }}" class="text-gray-300 hover:text-white block px-3 py-2 text-base font-medium uppercase tracking-wider">Service</a>
                    <a href="{{ route('profile') }}" class="text-gray-300 hover:text-white block px-3 py-2 text-base font-medium uppercase tracking-wider">Account</a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="text-gray-300 hover:text-white block px-3 py-2 text-base font-medium uppercase tracking-wider w-full text-left">Logout</button>
                    </form>
                @elseif(Auth::guard('web')->check())
                    <a href="{{ route('cars.index') }}" class="text-gray-300 hover:text-white block px-3 py-2 text-base font-medium uppercase tracking-wider">Wagens</a>
                    <a href="{{ route('mechanics.index') }}" class="text-gray-300 hover:text-white block px-3 py-2 text-base font-medium uppercase tracking-wider">Mechaniekers</a>
                    <a href="{{ route('service.index') }}" class="text-gray-300 hover:text-white block px-3 py-2 text-base font-medium uppercase tracking-wider">Service</a>
                    <a href="{{ route('profile') }}" class="text-gray-300 hover:text-white block px-3 py-2 text-base font-medium uppercase tracking-wider">Account</a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="text-gray-300 hover:text-white block px-3 py-2 text-base font-medium uppercase tracking-wider w-full text-left">Logout</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="text-gray-300 hover:text-white block px-3 py-2 text-base font-medium uppercase tracking-wider">Login</a>
                    <a href="{{ route('register') }}" class="text-gray-300 hover:text-white block px-3 py-2 text-base font-medium uppercase tracking-wider">Register</a>
                @endif
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="pt-16">
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        @yield('content')
    </div>

    <!-- Footer -->
    <footer class="bg-black border-t border-gray-800">
        <div class="max-w-7xl mx-auto px-6 lg:px-8 py-12">
            <div class="text-center">
                <p class="text-gray-400 text-sm uppercase tracking-wider mb-2">
                    &copy; Pitstop 2025-{{ date('Y') }}. Alle rechten voorbehouden.
                </p>
                <p class="text-gray-500 text-xs mb-6">
                    De slimme manier om bestuurders en monteurs te verbinden.
                </p>
                <div class="flex justify-center space-x-8">
                    <a href="/contact" class="text-gray-400 hover:text-white text-sm uppercase tracking-wider transition-colors duration-300">
                        Contact
                    </a>
                    <a href="/about" class="text-gray-400 hover:text-white text-sm uppercase tracking-wider transition-colors duration-300">
                        Over ons
                    </a>
                </div>

            </div>
        </div>
    </footer>

    <script>
        // Mobile menu toggle
        const mobileMenuButton = document.getElementById('mobile-menu-button');
        const mobileMenu = document.getElementById('mobile-menu');
        
        if (mobileMenuButton && mobileMenu) {
            mobileMenuButton.addEventListener('click', () => {
                mobileMenu.classList.toggle('hidden');
            });
        }

        // Hero split animation
        const heroSection = document.getElementById('hero-section');
        const heroTop = document.getElementById('hero-top');
        const heroBottom = document.getElementById('hero-bottom');
        
        if (heroSection && heroTop && heroBottom) {
            window.addEventListener('scroll', () => {
                const scrollY = window.scrollY;
                const windowHeight = window.innerHeight;
                const progress = Math.min(scrollY / windowHeight, 1);
                
                // Split animation - move halves apart vertically
                const translateAmount = progress * 100;
                heroTop.style.transform = `translateY(-${translateAmount}%)`;
                heroBottom.style.transform = `translateY(${translateAmount}%)`;
                
                // Fade out
                const opacity = 1 - progress;
                heroSection.style.opacity = opacity;
                
                // Hide completely when fully scrolled
                if (progress >= 1) {
                    heroSection.style.display = 'none';
                } else {
                    heroSection.style.display = 'block';
                }
            });
        }
    </script>
</body>
</html>
