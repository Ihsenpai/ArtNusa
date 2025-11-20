<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Artwork;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class EditArtwork extends Component
{
    use WithFileUploads;

    public $artworkId;
    public $title, $description, $story_behind, $material, $dimensions, $price, $photo;
    public $existingPhoto; // Untuk preview foto lama

    public function mount($id)
    {
        // Pastikan yang diedit adalah milik user login
        $artwork = Artwork::where('id', $id)->where('user_id', Auth::id())->firstOrFail();

        $this->artworkId = $artwork->id;
        $this->title = $artwork->title;
        $this->description = $artwork->description;
        $this->story_behind = $artwork->story_behind;
        $this->material = $artwork->material;
        $this->dimensions = $artwork->dimensions;
        $this->price = $artwork->price;
        $this->existingPhoto = $artwork->image_path;
    }

    public function update()
    {
        $this->validate([
            'title' => 'required',
            'price' => 'required|numeric',
            'photo' => 'nullable|image|max:5120', // Foto opsional saat edit
        ]);

        $artwork = Artwork::find($this->artworkId);

        // Update Data Dasar
        $data = [
            'title' => $this->title,
            'slug' => Str::slug($this->title . '-' . Str::random(5)),
            'description' => $this->description,
            'story_behind' => $this->story_behind,
            'material' => $this->material,
            'dimensions' => $this->dimensions,
            'price' => $this->price,
        ];

        // Cek jika ada upload foto baru
        if ($this->photo) {
            // Hapus foto lama biar gak nyampah
            if ($artwork->image_path) {
                Storage::disk('public')->delete($artwork->image_path);
            }
            // Upload baru
            $data['image_path'] = $this->photo->store('artworks', 'public');
        }

        $artwork->update($data);

        return redirect()->route('my.artworks')->with('message', 'Data karya berhasil diperbarui!');
    }

    public function render()
    {
        return view('livewire.edit-artwork');
    }
}