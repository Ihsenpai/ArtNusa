<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Artwork;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class MyArtworks extends Component
{
    public function delete($id)
    {
        $artwork = Artwork::where('id', $id)->where('user_id', Auth::id())->first();

        if ($artwork) {
            // Hapus gambar fisik jika ada
            if ($artwork->image_path) {
                Storage::disk('public')->delete($artwork->image_path);
            }
            
            // Hapus data di database
            $artwork->delete();
            session()->flash('message', 'Karya berhasil dihapus.');
        }
    }

    public function render()
    {
        // Ambil karya HANYA milik seniman yang sedang login
        $artworks = Artwork::where('user_id', Auth::id())->latest()->get();
        return view('livewire.my-artworks', compact('artworks'));
    }
}
