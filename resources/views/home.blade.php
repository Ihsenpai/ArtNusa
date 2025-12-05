@extends('layouts.app')

@section('title', 'ArtNusa - Marketplace Seni Tradisional Indonesia')

@section('content')
<!-- Hero Section -->
<section class="relative bg-gradient-to-br from-earth-100 via-earth-50 to-sage-100 py-20 overflow-hidden">
    <!-- Background Pattern -->
    <div class="absolute inset-0 opacity-5">
        <div class="absolute inset-0" style="background-image: url('data:image/svg+xml,<svg width="60" height="60" viewBox="0 0 60 60" xmlns="http://www.w3.org/2000/svg"><g fill="none" fill-rule="evenodd"><g fill="%23000000" fill-opacity="1"><circle cx="30" cy="30" r="2"/></g></svg>');"></div>
    </div>
    
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            <!-- Content -->
            <div class="text-center lg:text-left">
                <h1 class="text-4xl lg:text-6xl font-serif font-bold text-earth-900 mb-6 leading-tight">
                    Temukan Karya
                    <span class="text-terracotta-600">Seni Tradisional</span>
                    Indonesia
                </h1>
                <p class="text-xl text-earth-700 mb-8 leading-relaxed">
                    Platform marketplace yang menghubungkan seniman lokal dengan kolektor seni, 
                    dilengkapi sertifikat digital untuk menjamin keaslian setiap karya.
                </p>
                
                <!-- CTA Buttons -->
                <div class="flex flex-col sm:flex-row gap-4 justify-center lg:justify-start">
                    <a href="{{ route('marketplace') }}" class="bg-terracotta-600 hover:bg-terracotta-700 text-white px-8 py-4 rounded-xl font-semibold text-lg transition-all transform hover:scale-105 shadow-lg">
                        Jelajahi Karya Seni
                    </a>
                    <a href="{{ route('register') }}" class="border-2 border-earth-400 hover:border-terracotta-600 text-earth-800 hover:text-terracotta-600 px-8 py-4 rounded-xl font-semibold text-lg transition-all">
                        Daftar Sebagai Seniman
                    </a>
                </div>
                
                <!-- Stats -->
                <div class="grid grid-cols-3 gap-8 mt-12 pt-8 border-t border-earth-200">
                    <div class="text-center">
                        <div class="text-3xl font-bold text-terracotta-600 mb-2">{{ $stats['artists'] ?? '50+' }}</div>
                        <div class="text-earth-600 font-medium">Seniman</div>
                    </div>
                    <div class="text-center">
                        <div class="text-3xl font-bold text-terracotta-600 mb-2">{{ $stats['artworks'] ?? '200+' }}</div>
                        <div class="text-earth-600 font-medium">Karya Seni</div>
                    </div>
                    <div class="text-center">
                        <div class="text-3xl font-bold text-terracotta-600 mb-2">{{ $stats['sold'] ?? '150+' }}</div>
                        <div class="text-earth-600 font-medium">Terjual</div>
                    </div>
                </div>
            </div>
            
            <!-- Hero Image -->
            <div class="relative">
                <div class="relative bg-white rounded-2xl shadow-2xl p-8 transform rotate-3 hover:rotate-0 transition-transform duration-500">
                    <img src="/images/hero-artwork.jpg" alt="Contoh Karya Seni" class="w-full h-80 object-cover rounded-xl">
                    <div class="absolute -top-4 -left-4 bg-terracotta-600 text-white px-4 py-2 rounded-lg font-semibold shadow-lg">
                        Bersertifikat Digital
                    </div>
                </div>
                
                <!-- Floating Cards -->
                <div class="absolute -bottom-6 -left-6 bg-white rounded-xl shadow-lg p-4 max-w-xs">
                    <div class="flex items-center space-x-3">
                        <img src="/images/artist-avatar.jpg" alt="Seniman" class="w-12 h-12 rounded-full object-cover">
                        <div>
                            <div class="font-semibold text-earth-900">Made Sutrisna</div>
                            <div class="text-sm text-earth-600">Seniman Bali</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Featured Artworks -->
<section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl lg:text-4xl font-serif font-bold text-earth-900 mb-4">
                Karya Pilihan
            </h2>
            <p class="text-xl text-earth-600 max-w-2xl mx-auto">
                Temukan koleksi karya seni tradisional Indonesia terbaik dari seniman-seniman berbakat
            </p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($featuredArtworks as $artwork)
            <div class="bg-white rounded-2xl shadow-lg hover:shadow-xl transition-shadow duration-300 overflow-hidden group">
                <div class="relative overflow-hidden">
                    <img src="{{ $artwork->image_path ?? '/images/placeholder-artwork.jpg' }}" 
                         alt="{{ $artwork->title }}" 
                         class="w-full h-64 object-cover group-hover:scale-110 transition-transform duration-500">
                    <div class="absolute top-4 right-4">
                        <span class="bg-sage-600 text-white px-3 py-1 rounded-full text-sm font-medium">
                            {{ $artwork->status == 'available' ? 'Tersedia' : 'Terjual' }}
                        </span>
                    </div>
                </div>
                
                <div class="p-6">
                    <h3 class="font-serif font-bold text-xl text-earth-900 mb-2">{{ $artwork->title }}</h3>
                    <p class="text-earth-600 mb-3 line-clamp-2">{{ $artwork->description }}</p>
                    
                    <!-- Artist Info -->
                    <div class="flex items-center space-x-3 mb-4">
                        <img src="/images/artist-placeholder.jpg" alt="{{ $artwork->user->name }}" class="w-8 h-8 rounded-full object-cover">
                        <span class="text-earth-700 font-medium">{{ $artwork->user->name }}</span>
                    </div>
                    
                    <!-- Price & Action -->
                    <div class="flex items-center justify-between">
                        <div>
                            <span class="text-2xl font-bold text-terracotta-600">
                                Rp {{ number_format($artwork->price, 0, ',', '.') }}
                            </span>
                        </div>
                        <a href="{{ route('artwork.show', $artwork->slug) }}" 
                           class="bg-earth-600 hover:bg-earth-700 text-white px-4 py-2 rounded-lg font-medium transition-colors">
                            Lihat Detail
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        
        <div class="text-center mt-12">
            <a href="{{ route('marketplace') }}" class="inline-flex items-center bg-terracotta-600 hover:bg-terracotta-700 text-white px-8 py-4 rounded-xl font-semibold text-lg transition-colors">
                Lihat Semua Karya
                <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                </svg>
            </a>
        </div>
    </div>
</section>

<!-- Why Choose ArtNusa -->
<section class="py-16 bg-earth-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl lg:text-4xl font-serif font-bold text-earth-900 mb-4">
                Mengapa Memilih ArtNusa?
            </h2>
            <p class="text-xl text-earth-600 max-w-2xl mx-auto">
                Platform terpercaya untuk seni tradisional Indonesia dengan jaminan keaslian
            </p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Feature 1 -->
            <div class="text-center group">
                <div class="bg-terracotta-100 w-20 h-20 rounded-2xl flex items-center justify-center mx-auto mb-6 group-hover:bg-terracotta-200 transition-colors">
                    <svg class="w-10 h-10 text-terracotta-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-earth-900 mb-3">Sertifikat Digital</h3>
                <p class="text-earth-600">Setiap karya dilengkapi sertifikat digital dengan QR code untuk menjamin keaslian</p>
            </div>
            
            <!-- Feature 2 -->
            <div class="text-center group">
                <div class="bg-sage-100 w-20 h-20 rounded-2xl flex items-center justify-center mx-auto mb-6 group-hover:bg-sage-200 transition-colors">
                    <svg class="w-10 h-10 text-sage-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-earth-900 mb-3">Komunitas Seniman</h3>
                <p class="text-earth-600">Bergabung dengan komunitas seniman tradisional Indonesia yang saling mendukung</p>
            </div>
            
            <!-- Feature 3 -->
            <div class="text-center group">
                <div class="bg-earth-100 w-20 h-20 rounded-2xl flex items-center justify-center mx-auto mb-6 group-hover:bg-earth-200 transition-colors">
                    <svg class="w-10 h-10 text-earth-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-earth-900 mb-3">Komisi Fair</h3>
                <p class="text-earth-600">Seniman mendapat 90% dari penjualan, komisi platform hanya 10%</p>
            </div>
        </div>
    </div>
</section>

<!-- Featured Artists -->
<section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl lg:text-4xl font-serif font-bold text-earth-900 mb-4">
                Seniman Pilihan
            </h2>
            <p class="text-xl text-earth-600 max-w-2xl mx-auto">
                Kenali para seniman berbakat yang mempertahankan tradisi seni Indonesia
            </p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($featuredArtists as $artist)
            <div class="bg-gradient-to-br from-earth-50 to-sage-50 rounded-2xl p-8 text-center hover:shadow-lg transition-shadow duration-300">
                <img src="/images/artist-placeholder.jpg" alt="{{ $artist->name }}" class="w-24 h-24 rounded-full object-cover mx-auto mb-6 border-4 border-white shadow-lg">
                <h3 class="text-xl font-bold text-earth-900 mb-2">{{ $artist->name }}</h3>
                <p class="text-earth-600 mb-4 line-clamp-3">{{ $artist->bio }}</p>
                <div class="text-sm text-terracotta-600 font-medium mb-4">
                    {{ $artist->artworks->count() }} Karya Tersedia
                </div>
                <a href="{{ route('artist.profile', $artist->id) }}" class="inline-flex items-center text-terracotta-600 hover:text-terracotta-700 font-medium">
                    Lihat Profil
                    <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                    </svg>
                </a>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="py-16 bg-gradient-to-r from-terracotta-600 to-terracotta-700">
    <div class="max-w-4xl mx-auto text-center px-4 sm:px-6 lg:px-8">
        <h2 class="text-3xl lg:text-4xl font-serif font-bold text-white mb-6">
            Siap Menjual Karya Seni Anda?
        </h2>
        <p class="text-xl text-terracotta-100 mb-8">
            Bergabunglah dengan puluhan seniman lainnya dan mulai menjual karya Anda hari ini
        </p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="{{ route('register') }}" class="bg-white hover:bg-earth-50 text-terracotta-700 px-8 py-4 rounded-xl font-semibold text-lg transition-colors">
                Daftar Sebagai Seniman
            </a>
            <a href="{{ route('about') }}" class="border-2 border-white hover:bg-white hover:text-terracotta-700 text-white px-8 py-4 rounded-xl font-semibold text-lg transition-colors">
                Pelajari Lebih Lanjut
            </a>
        </div>
    </div>
</section>
@endsection