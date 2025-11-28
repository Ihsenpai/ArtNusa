<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;

class MyTransactions extends Component
{
    public function render()
    {
        // Ambil transaksi milik pembeli yang sedang login
        // Diurutkan dari yang terbaru (latest)
        $transactions = Transaction::where('buyer_id', Auth::id())
                        ->with('artwork') // Kita butuh data lukisannya juga
                        ->latest()
                        ->get();

        return view('livewire.my-transactions', compact('transactions'));
    }
}