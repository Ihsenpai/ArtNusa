<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// --- IMPORT SEMUA LIVEWIRE COMPONENTS ---
use App\Livewire\Home;
use App\Livewire\ArtworkDetail;
use App\Livewire\CertificateVerify;
use App\Livewire\Auth\Login;
use App\Livewire\Auth\Register;
use App\Livewire\UserProfile;    // Profil & Ganti Password
use App\Livewire\UploadArtwork;  // Upload Karya Baru
use App\Livewire\MyArtworks;     // Daftar Karya Saya (Seniman)
use App\Livewire\EditArtwork;    // Edit Karya (Seniman)
use App\Livewire\CartPage;       // Keranjang Belanja
use App\Livewire\MyTransactions; // Riwayat Transaksi

/*
|--------------------------------------------------------------------------
| 1. PUBLIC ROUTES (Bisa diakses TANPA Login)
|--------------------------------------------------------------------------
*/
// Halaman depan (Galeri)
Route::get('/', Home::class)->name('home'); 

// Halaman Cek Sertifikat (Bisa terima parameter code dari QR Scan)
Route::get('/verify/{code?}', CertificateVerify::class)->name('certificate.verify'); 

/*
|--------------------------------------------------------------------------
| 2. GUEST ROUTES (Hanya untuk yang BELUM Login)
|--------------------------------------------------------------------------
*/
Route::middleware('guest')->group(function () {
    Route::get('/login', Login::class)->name('login');
    Route::get('/register', Register::class)->name('register');
});

/*
|--------------------------------------------------------------------------
| 3. AUTH ROUTES (WAJIB LOGIN untuk akses ini)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    
    // --- FITUR UMUM (Buyer & Artist) ---

    // Detail Karya (Wajib login untuk lihat detail & beli)
    Route::get('/karya/{id}', ArtworkDetail::class)->name('artwork.detail');

    // Halaman Profil (Edit Biodata, Password, Hapus Akun)
    Route::get('/profile', UserProfile::class)->name('profile');

    // Keranjang Belanja
    Route::get('/cart', CartPage::class)->name('cart');

    // Riwayat Pembelian (Laporan Transaksi)
    Route::get('/my-transactions', MyTransactions::class)->name('my.transactions');


    // --- FITUR KHUSUS SENIMAN ---
    
    // Form Upload Karya Baru
    Route::get('/upload', UploadArtwork::class)->name('artwork.upload');
    
    // Daftar "Karya Saya" (Manajemen Stok)
    Route::get('/my-artworks', MyArtworks::class)->name('my.artworks');
    
    // Form Edit Karya
    Route::get('/karya/{id}/edit', EditArtwork::class)->name('artwork.edit');


    // --- LOGIC LOGOUT ---
    Route::post('/logout', function () {
        Auth::logout();
        session()->invalidate();
        session()->regenerateToken();
        return redirect('/');
    })->name('logout');
});