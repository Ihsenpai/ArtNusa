<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Artwork;
use App\Models\Cart;
use App\Models\Transaction;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class ArtworkDetail extends Component
{
    public $artwork;
    
    // Variabel untuk Popup Pembayaran
    public $showPaymentModal = false; 
    public $paymentMethod = 'transfer';

    public function mount($id)
    {
        $this->artwork = Artwork::with(['user', 'certificate'])->findOrFail($id);
    }

    // LOGIC 1: MASUK KERANJANG
    public function addToCart()
    {
        // Wajib Login
        if(!Auth::check()) return redirect()->route('login');

        // Proteksi: Seniman tidak boleh beli karya sendiri
        if(Auth::id() == $this->artwork->user_id) {
            session()->flash('error', 'Anda tidak dapat membeli karya Anda sendiri.');
            return;
        }

        // Cek duplikasi di keranjang
        $exists = Cart::where('user_id', Auth::id())
                      ->where('artwork_id', $this->artwork->id)->exists();

        if(!$exists) {
            Cart::create([
                'user_id' => Auth::id(),
                'artwork_id' => $this->artwork->id
            ]);
            
            // Refresh halaman agar badge keranjang di navbar update
            return redirect()->route('artwork.detail', $this->artwork->id);
        }
    }

    // LOGIC 2: BUKA POPUP BAYAR (BELI LANGSUNG)
    public function openPaymentModal()
    {
        if(!Auth::check()) return redirect()->route('login');

        // Proteksi Karya Sendiri
        if(Auth::id() == $this->artwork->user_id) {
            return; 
        }

        $this->showPaymentModal = true;
    }

    // LOGIC 3: PROSES BAYAR (SETELAH PILIH METODE DI POPUP)
    public function processPayment()
    {
        $price = $this->artwork->price;
        
        Transaction::create([
            'invoice_code' => 'INV-' . strtoupper(Str::random(8)),
            'buyer_id' => Auth::id(),
            'artwork_id' => $this->artwork->id,
            'total_price' => $price,
            'platform_fee' => $price * 0.1, // 10% Fee
            'artist_revenue' => $price * 0.9, // 90% Seniman
            'status' => 'pending',
            'payment_method' => $this->paymentMethod,
        ]);

        // Tandai Terjual
        $this->artwork->update(['status' => 'sold']);
        
        $this->showPaymentModal = false;
        
        // Redirect ke Home (atau halaman transaksi jika sudah ada)
        return redirect()->route('home');
    }

    public function render()
    {
        return view('livewire.artwork-detail');
    }
}
