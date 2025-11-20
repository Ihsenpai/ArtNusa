<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// Import Livewire Components
use App\Livewire\Home;
use App\Livewire\ArtworkDetail;
use App\Livewire\UploadArtwork;
use App\Livewire\CertificateVerify;
use App\Livewire\UserProfile; // <-- JANGAN LUPA IMPORT INI
use App\Livewire\Auth\Login;
use App\Livewire\Auth\Register;

/*
|--------------------------------------------------------------------------
| 1. PUBLIC ROUTES (Bisa diakses TANPA Login)
|--------------------------------------------------------------------------
*/
Route::get('/', Home::class)->name('home'); 
Route::get('/verify', CertificateVerify::class)->name('certificate.verify'); 

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
    
    // Detail Karya (User wajib login untuk lihat detail/beli)
    Route::get('/karya/{id}', ArtworkDetail::class)->name('artwork.detail');

    // Menu Upload (Hanya user login)
    Route::get('/upload', UploadArtwork::class)->name('artwork.upload');
    
    // Menu Profil (BARU DITAMBAHKAN)
    Route::get('/profile', UserProfile::class)->name('profile');

    // Logic Logout
    Route::post('/logout', function () {
        Auth::logout();
        session()->invalidate();
        session()->regenerateToken();
        return redirect('/');
    })->name('logout');
});