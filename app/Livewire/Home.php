<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Artwork;

class Home extends Component
{
    public function render()
    {
        $search = request('search'); // Tangkap input dari Navbar

        $artworks = Artwork::with('user')
            ->where('status', 'available')
            ->when($search, function($query) use ($search) {
                // Cari berdasarkan Judul Karya ATAU Nama Seniman
                $query->where('title', 'like', '%'.$search.'%')
                      ->orWhereHas('user', function($q) use ($search){
                          $q->where('name', 'like', '%'.$search.'%');
                      });
            })
            ->latest()
            ->get();

        return view('livewire.home', compact('artworks'));
    }
}
