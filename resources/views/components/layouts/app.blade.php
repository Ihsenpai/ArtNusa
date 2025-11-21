<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ArtNusa - Buy Art, Save Culture</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=Inter:wght@300;400;500&display=swap" rel="stylesheet">
    
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    
    <style>
        body { font-family: 'Inter', sans-serif; }
        h1, h2, h3, .font-serif { font-family: 'Playfair Display', serif; }
        [x-cloak] { display: none !important; }
    </style>
</head>
<body class="bg-[#FDFBF7] text-stone-800 antialiased flex flex-col min-h-screen">

    <nav class="bg-white/90 backdrop-blur-md border-b border-stone-200 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-20 items-center gap-4">
                
                <a href="/" class="flex items-center gap-2 text-2xl font-serif font-bold text-stone-900 hover:text-amber-700 transition shrink-0">
                    <i class="fa-solid fa-palette text-amber-700"></i>
                    <span class="hidden md:block">ArtNusa</span>
                </a>

                <div class="flex-1 max-w-lg mx-auto hidden md:block">
                    <form action="/" method="GET" class="relative">
                        <input type="text" name="search" placeholder="Cari lukisan atau seniman..." value="{{ request('search') }}"
                            class="w-full bg-stone-50 border border-stone-300 rounded-full py-2 pl-5 pr-12 text-sm focus:outline-none focus:border-amber-500 focus:ring-1 focus:ring-amber-500 transition">
                        <button type="submit" class="absolute right-2 top-1/2 -translate-y-1/2 bg-stone-200 text-stone-600 hover:text-amber-700 w-8 h-8 rounded-full flex items-center justify-center transition">
                            <i class="fa-solid fa-magnifying-glass text-xs"></i>
                        </button>
                    </form>
                </div>

                <div class="flex items-center gap-4 shrink-0">
                    
                    <a href="/" class="hover:text-amber-700 transition text-stone-600 text-sm font-medium hidden lg:block">Galeri</a>
                    <a href="/verify" class="hover:text-amber-700 transition text-stone-600 text-sm font-medium hidden lg:block">Cek Sertifikat</a>

                    @guest
                        <div class="flex items-center gap-2 pl-4 border-l border-stone-200">
                            <a href="{{ route('login') }}" class="text-sm font-bold text-stone-600 hover:text-amber-700 px-3 py-2">Masuk</a>
                            <a href="{{ route('register') }}" class="text-sm font-bold bg-stone-900 text-white px-5 py-2.5 rounded-full hover:bg-stone-700 transition shadow-sm">Daftar</a>
                        </div>
                    @else
                        @if(Auth::user()->role == 'artist')
                            <a href="{{ route('my.artworks') }}" class="hidden md:block text-sm font-bold text-stone-600 hover:text-amber-700 mr-2" title="Kelola Karya Saya">
                                <i class="fa-solid fa-images mr-1"></i> <span class="hidden lg:inline">Karya Saya</span>
                            </a>

                            <a href="/upload" class="hidden md:flex bg-amber-700 text-white px-4 py-2 rounded-full text-xs font-bold hover:bg-amber-800 transition items-center gap-2 shadow-sm mr-2">
                                <i class="fa-solid fa-plus"></i> Jual
                            </a>
                        @endif

                        <div class="relative" x-data="{ open: false }">
                            <button @click="open = !open" class="flex items-center gap-2 focus:outline-none bg-stone-50 px-2 py-1 rounded-full hover:bg-stone-100 transition border border-transparent hover:border-stone-200">
                                <div class="text-right hidden md:block pr-1">
                                    <div class="text-sm font-bold text-stone-800">{{ Auth::user()->name }}</div>
                                    <div class="text-[10px] font-bold uppercase tracking-wider text-amber-600 leading-none">{{ Auth::user()->role }}</div>
                                </div>
                                <div class="w-9 h-9 bg-white rounded-full flex items-center justify-center border border-stone-300 text-stone-500">
                                    <i class="fa-solid fa-user"></i>
                                </div>
                                <i class="fa-solid fa-chevron-down text-xs text-stone-400 pr-1 transition-transform duration-200" :class="open ? 'rotate-180' : ''"></i>
                            </button>

                            <div x-show="open" @click.outside="open = false" x-cloak
                                 class="absolute right-0 mt-2 w-56 bg-white rounded-xl shadow-xl border border-stone-100 py-2 z-50 animate-fade-in-down">
                                
                                <div class="px-4 py-3 border-b border-stone-100 md:hidden bg-stone-50 mb-1">
                                    <div class="font-bold text-stone-800">{{ Auth::user()->name }}</div>
                                </div>
                                
                                <a href="{{ route('profile') }}" class="block px-4 py-2 text-sm text-stone-700 hover:bg-amber-50 hover:text-amber-700 transition">
                                    <i class="fa-solid fa-gear w-6 text-center mr-2"></i> Pengaturan Akun
                                </a>

                                <div class="md:hidden border-t border-stone-100 my-1"></div>
                                <a href="/" class="block px-4 py-2 text-sm text-stone-700 hover:bg-amber-50 hover:text-amber-700 md:hidden">
                                    <i class="fa-solid fa-shop w-6 text-center mr-2"></i> Galeri
                                </a>
                                @if(Auth::user()->role == 'artist')
                                    <a href="{{ route('my.artworks') }}" class="block px-4 py-2 text-sm text-stone-700 hover:bg-amber-50 hover:text-amber-700 md:hidden">
                                        <i class="fa-solid fa-images w-6 text-center mr-2"></i> Karya Saya
                                    </a>
                                @endif

                                <div class="border-t border-stone-100 my-1"></div>
                                
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50 font-bold transition rounded-b-xl">
                                        <i class="fa-solid fa-right-from-bracket w-6 text-center mr-2"></i> Keluar
                                    </button>
                                </form>
                            </div>
                        </div>

                        <a href="{{ route('cart') }}" class="relative text-stone-600 hover:text-amber-700 transition p-2 ml-2 border-l border-stone-200 pl-4" title="Keranjang Belanja">
                            <i class="fa-solid fa-cart-shopping text-xl"></i>
                            
                            @php
                                $cartCount = \App\Models\Cart::where('user_id', Auth::id())->count();
                            @endphp
                            @if($cartCount > 0)
                                <span class="absolute -top-1 -right-1 bg-red-600 text-white text-[10px] font-bold w-5 h-5 flex items-center justify-center rounded-full border-2 border-white animate-bounce">
                                    {{ $cartCount }}
                                </span>
                            @endif
                        </a>

                    @endguest
                </div>
            </div>
        </div>
    </nav>

    <main class="flex-grow">
        {{ $slot }}
    </main>

    <footer class="bg-stone-900 text-stone-400 py-10 text-center mt-auto border-t border-stone-800">
        <div class="max-w-7xl mx-auto px-4">
            <p class="font-serif text-white text-xl mb-2">ArtNusa</p>
            <p class="text-sm mb-6 text-stone-500">Platform Digital Penjualan Karya Lukis Tradisional Indonesia.</p>
            
            <div class="flex justify-center gap-6 mb-8">
                <a href="#" class="hover:text-white transition"><i class="fa-brands fa-instagram text-xl"></i></a>
                <a href="#" class="hover:text-white transition"><i class="fa-brands fa-facebook text-xl"></i></a>
                <a href="#" class="hover:text-white transition"><i class="fa-brands fa-twitter text-xl"></i></a>
            </div>

            <p class="text-xs text-stone-600 pt-6 border-t border-stone-800">
                &copy; {{ date('Y') }} Kelompok 4 Kewirausahaan - Universitas Jenderal Soedirman.
            </p>
        </div>
    </footer>

</body>
</html>   