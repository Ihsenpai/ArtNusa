<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Cart;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class CartPage extends Component
{
    public $showCheckoutModal = false; // Kontrol Popup
    public $paymentMethod = 'transfer'; // Pilihan Metode Bayar

    // Hapus Item dari Keranjang
    public function remove($cartId)
    {
        Cart::destroy($cartId);
    }

    // 1. BUKA POPUP CHECKOUT
    public function openCheckout()
    {
        $this->showCheckoutModal = true;
    }

    // 2. PROSES BAYAR FINAL (LOOPING ITEM KERANJANG)
    public function processCheckout()
    {
        $carts = Cart::where('user_id', Auth::id())->with('artwork')->get();

        if($carts->isEmpty()) return;

        foreach ($carts as $item) {
            // Pastikan barang masih available (takutnya udah dibeli orang lain pas di keranjang)
            if ($item->artwork->status == 'available') {
                $price = $item->artwork->price;
                
                Transaction::create([
                    'invoice_code' => 'INV-' . strtoupper(Str::random(8)),
                    'buyer_id' => Auth::id(),
                    'artwork_id' => $item->artwork->id,
                    'total_price' => $price,
                    'platform_fee' => $price * 0.1,
                    'artist_revenue' => $price * 0.9,
                    'status' => 'pending',
                ]);

                // Tandai Sold
                $item->artwork->update(['status' => 'sold']);
            }
        }

        // Kosongkan Keranjang setelah checkout
        Cart::where('user_id', Auth::id())->delete();
        
        $this->showCheckoutModal = false;
        
        // Redirect ke Home (atau riwayat transaksi)
        return redirect()->route('home'); 
    }

    public function render()
    {
        $carts = Cart::where('user_id', Auth::id())->with('artwork')->get();
        $total = $carts->sum(fn($c) => $c->artwork->price);

        return view('livewire.cart-page', compact('carts', 'total'));
    }
}