<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Artwork;
use App\Models\Transaction;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class ArtworkDetail extends Component
{
    public $artwork;
    public $successMessage = '';

    public function mount($id)
    {
        $this->artwork = Artwork::with(['user', 'certificate'])->findOrFail($id);
    }

    public function buyNow()
    {
        // Logic Pembelian Sederhana
        // Kita pakai user dummy ID 2 (Kolektor Sari) dari seeder jika belum login
        // Di real project, ganti Auth::id()
        $buyerId = Auth::id() ?? 3; 

        $price = $this->artwork->price;
        $fee = $price * 0.10; // 10% Platform
        $revenue = $price - $fee; // 90% Artist

        Transaction::create([
            'invoice_code' => 'INV-' . strtoupper(Str::random(8)),
            'buyer_id' => $buyerId,
            'artwork_id' => $this->artwork->id,
            'total_price' => $price,
            'platform_fee' => $fee,
            'artist_revenue' => $revenue,
            'status' => 'pending',
        ]);

        $this->artwork->update(['status' => 'sold']);
        $this->successMessage = "Pesanan berhasil dibuat! Silakan lakukan pembayaran.";
    }

    public function render()
    {
        return view('livewire.artwork-detail');
    }
}
