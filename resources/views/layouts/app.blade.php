<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'ArtNusa - Marketplace Seni Tradisional Indonesia')</title>
    
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Custom Tailwind Config untuk Earth Tones -->
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        earth: {
                            50: '#faf8f3',
                            100: '#f4f0e6',
                            200: '#e8dcc6',
                            300: '#d6c2a1',
                            400: '#c4a473',
                            500: '#b8935a',
                            600: '#a67c4a',
                            700: '#8a6640',
                            800: '#6f5436',
                            900: '#5a452c',
                        },
                        terracotta: {
                            50: '#fdf4f3',
                            100: '#fce7e3',
                            200: '#f7d4cc',
                            300: '#f0b5a8',
                            400: '#e68b75',
                            500: '#d97654',
                            600: '#c45a3c',
                            700: '#a3472f',
                            800: '#873c2a',
                            900: '#703327',
                        },
                        sage: {
                            50: '#f6f7f1',
                            100: '#eaeddd',
                            200: '#d6dcbe',
                            300: '#bbc496',
                            400: '#a1ab71',
                            500: '#8a9556',
                            600: '#6d7642',
                            700: '#565c36',
                            800: '#464b2f',
                            900: '#3c402a',
                        }
                    },
                    fontFamily: {
                        'serif': ['Playfair Display', 'serif'],
                        'sans': ['Inter', 'sans-serif'],
                    }
                }
            }
        }
    </script>
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Playfair+Display:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Font Awesome untuk Icons -->
    <script src="https://kit.fontawesome.com/your-kit-id.js" crossorigin="anonymous"></script>
    
    @stack('styles')
</head>
<body class="bg-earth-50 text-earth-900 font-sans">
    <!-- Navigation -->
    <nav class="bg-white shadow-sm border-b border-earth-200 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <!-- Logo -->
                <div class="flex items-center">
                    <a href="{{ route('home') }}" class="text-2xl font-serif font-bold text-earth-800 hover:text-terracotta-600 transition-colors">
                        ArtNusa
                    </a>
                </div>
                
                <!-- Navigation Links -->
                <div class="hidden md:flex items-center space-x-8">
                    <a href="{{ route('home') }}" class="text-earth-700 hover:text-terracotta-600 font-medium transition-colors">
                        Beranda
                    </a>
                    <a href="{{ route('marketplace') }}" class="text-earth-700 hover:text-terracotta-600 font-medium transition-colors">
                        Marketplace
                    </a>
                    <a href="{{ route('artists') }}" class="text-earth-700 hover:text-terracotta-600 font-medium transition-colors">
                        Seniman
                    </a>
                    <a href="{{ route('about') }}" class="text-earth-700 hover:text-terracotta-600 font-medium transition-colors">
                        Tentang
                    </a>
                </div>
                
                <!-- Auth Buttons -->
                <div class="flex items-center space-x-4">
                    @guest
                        <a href="{{ route('login') }}" class="text-earth-700 hover:text-terracotta-600 font-medium transition-colors">
                            Masuk
                        </a>
                        <a href="{{ route('register') }}" class="bg-terracotta-600 hover:bg-terracotta-700 text-white px-4 py-2 rounded-lg font-medium transition-colors">
                            Daftar
                        </a>
                    @else
                        <div class="relative">
                            <button class="flex items-center space-x-2 text-earth-700 hover:text-terracotta-600 font-medium">
                                <span>{{ Auth::user()->name }}</span>
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </button>
                        </div>
                    @endguest
                </div>
                
                <!-- Mobile menu button -->
                <div class="md:hidden">
                    <button class="text-earth-700 hover:text-terracotta-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-earth-800 text-earth-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <!-- Brand -->
                <div class="col-span-1 md:col-span-2">
                    <h3 class="text-2xl font-serif font-bold text-white mb-4">ArtNusa</h3>
                    <p class="text-earth-300 mb-4 max-w-md">
                        Platform marketplace seni tradisional Indonesia yang menghubungkan seniman dengan kolektor, 
                        dilengkapi sertifikat digital untuk keaslian karya.
                    </p>
                    <div class="flex space-x-4">
                        <a href="#" class="text-earth-300 hover:text-white transition-colors">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"/>
                            </svg>
                        </a>
                        <a href="#" class="text-earth-300 hover:text-white transition-colors">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M22.46 6c-.77.35-1.6.58-2.46.69.88-.53 1.56-1.37 1.88-2.38-.83.5-1.75.85-2.72 1.05C18.37 4.5 17.26 4 16 4c-2.35 0-4.27 1.92-4.27 4.29 0 .34.04.67.11.98C8.28 9.09 5.11 7.38 3 4.79c-.37.63-.58 1.37-.58 2.15 0 1.49.75 2.81 1.91 3.56-.71 0-1.37-.2-1.95-.5v.03c0 2.08 1.48 3.82 3.44 4.21a4.22 4.22 0 0 1-1.93.07 4.28 4.28 0 0 0 4 2.98 8.521 8.521 0 0 1-5.33 1.84c-.34 0-.68-.02-1.02-.06C3.44 20.29 5.7 21 8.12 21 16 21 20.33 14.46 20.33 8.79c0-.19 0-.37-.01-.56.84-.6 1.56-1.36 2.14-2.23z"/>
                            </svg>
                        </a>
                        <a href="#" class="text-earth-300 hover:text-white transition-colors">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12.017 0C5.396 0 .029 5.367.029 11.987c0 5.079 3.158 9.417 7.618 11.174-.105-.949-.199-2.403.041-3.439.219-.937 1.406-5.957 1.406-5.957s-.359-.72-.359-1.781c0-1.663.967-2.911 2.168-2.911 1.024 0 1.518.769 1.518 1.688 0 1.029-.653 2.567-.992 3.992-.285 1.193.6 2.165 1.775 2.165 2.128 0 3.768-2.245 3.768-5.487 0-2.861-2.063-4.869-5.008-4.869-3.41 0-5.409 2.562-5.409 5.199 0 1.033.394 2.143.889 2.741.098.119.112.223.085.345-.09.375-.293 1.199-.334 1.363-.053.225-.172.271-.402.165-1.495-.69-2.433-2.878-2.433-4.646 0-3.776 2.748-7.252 7.92-7.252 4.158 0 7.392 2.967 7.392 6.923 0 4.135-2.607 7.462-6.233 7.462-1.214 0-2.357-.629-2.746-1.378l-.748 2.853c-.271 1.043-1.002 2.35-1.492 3.146C9.57 23.812 10.763 24.009 12.017 24.009c6.624 0 11.99-5.367 11.99-11.988C24.007 5.367 18.641.001 12.017.001z"/>
                            </svg>
                        </a>
                    </div>
                </div>
                
                <!-- Quick Links -->
                <div>
                    <h4 class="font-semibold text-white mb-4">Tautan Cepat</h4>
                    <ul class="space-y-2">
                        <li><a href="{{ route('marketplace') }}" class="text-earth-300 hover:text-white transition-colors">Marketplace</a></li>
                        <li><a href="{{ route('artists') }}" class="text-earth-300 hover:text-white transition-colors">Seniman</a></li>
                        <li><a href="#" class="text-earth-300 hover:text-white transition-colors">Cara Jual</a></li>
                        <li><a href="#" class="text-earth-300 hover:text-white transition-colors">Sertifikat</a></li>
                    </ul>
                </div>
                
                <!-- Support -->
                <div>
                    <h4 class="font-semibold text-white mb-4">Dukungan</h4>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-earth-300 hover:text-white transition-colors">Bantuan</a></li>
                        <li><a href="#" class="text-earth-300 hover:text-white transition-colors">Kontak</a></li>
                        <li><a href="#" class="text-earth-300 hover:text-white transition-colors">Privacy</a></li>
                        <li><a href="#" class="text-earth-300 hover:text-white transition-colors">Terms</a></li>
                    </ul>
                </div>
            </div>
            
            <div class="border-t border-earth-700 mt-8 pt-8 text-center">
                <p class="text-earth-400">
                    &copy; 2025 ArtNusa. Semua hak dilindungi. Made with ❤️ for Indonesian Art.
                </p>
            </div>
        </div>
    </footer>

    @stack('scripts')
</body>
</html>