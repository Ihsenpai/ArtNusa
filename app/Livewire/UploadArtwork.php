<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Artwork;
use App\Models\Certificate;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class UploadArtwork extends Component
{
    use WithFileUploads;

    public $title, $description, $story_behind, $material, $dimensions, $year_created, $price, $photo;

    public function save()
    {
        $this->validate([
            'title' => 'required',
            'price' => 'required|numeric',
            'photo' => 'image|max:5120', // 5MB Max
            'story_behind' => 'required',
        ]);

        // Simpan Gambar
        $path = $this->photo->store('artworks', 'public');

        // User ID (Ambil Auth atau pakai ID 2 dari seeder Seniman Budi)
        $userId = Auth::id() ?? 2; 

        // 1. Create Artwork
        $art = Artwork::create([
            'user_id' => $userId,
            'title' => $this->title,
            'slug' => Str::slug($this->title . '-' . Str::random(5)),
            'description' => $this->description,
            'story_behind' => $this->story_behind,
            'material' => $this->material,
            'dimensions' => $this->dimensions,
            'year_created' => $this->year_created ?? date('Y'),
            'price' => $this->price,
            'image_path' => $path,
            'status' => 'available'
        ]);

        // 2. Create Certificate (Manual trigger jika tidak pakai boot method, tapi boot method kamu sudah aman)
        // Certificate::create([...]) -> Tidak perlu karena sudah ada di Model Certificate::boot()
        // Tapi untuk memastikan relasi 100% (karena boot method kadang tricky di livewire tanpa refresh):
        if(!$art->certificate) {
             Certificate::create([
                'artwork_id' => $art->id,
                'certificate_code' => Str::uuid(),
                'issued_at' => now()
            ]);
        }

        return redirect()->route('home');
    }

    public function render()
    {
        return view('livewire.upload-artwork');
    }
}
