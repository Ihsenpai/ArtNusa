<div>
    <div class="bg-stone-800 text-white py-16 text-center px-4 relative overflow-hidden">
        <div class="absolute inset-0 opacity-20 bg-[url('https://www.transparenttextures.com/patterns/batik-2.png')]"></div>
        <div class="relative z-10 max-w-3xl mx-auto">
            <h1 class="text-4xl md:text-5xl font-bold mb-4">Seni Tradisional, <span class="text-amber-500">Akses Global</span></h1>
            <p class="text-stone-300 text-lg">Temukan karya autentik seniman Indonesia dengan jaminan Sertifikat Digital.</p>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 py-12">
        <h2 class="text-3xl font-serif font-bold text-stone-900 mb-8 border-l-4 border-amber-600 pl-4">Koleksi Terbaru</h2>

        <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-8">
            @foreach($artworks as $art)
            <a href="{{ route('artwork.detail', $art->id) }}" class="group bg-white rounded-xl shadow-sm hover:shadow-xl transition duration-300 border border-stone-100 overflow-hidden">
                <div class="aspect-[4/5] overflow-hidden relative bg-stone-200">
                    <img src="{{ asset('storage/'.$art->image_path) }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                    <div class="absolute top-3 right-3 bg-white/90 backdrop-blur px-2 py-1 rounded-md text-xs font-bold text-amber-700 shadow-sm">
                        <i class="fa-solid fa-certificate mr-1"></i> Verified
                    </div>
                </div>

                <div class="p-5">
                    <h3 class="text-lg font-serif font-bold text-stone-900 truncate mb-1">{{ $art->title }}</h3>
                    <p class="text-sm text-stone-500 mb-3">Oleh: {{ $art->user->name }}</p>
                    
                    <div class="flex justify-between items-center border-t border-stone-100 pt-3">
                        <span class="text-lg font-bold text-stone-900">Rp {{ number_format($art->price, 0, ',', '.') }}</span>
                        <span class="text-xs text-stone-400 group-hover:text-amber-600 transition">Lihat Detail &rarr;</span>
                    </div>
                </div>
            </a>
            @endforeach
        </div>
    </div>
</div>