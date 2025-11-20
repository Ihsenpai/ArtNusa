<div class="max-w-3xl mx-auto px-4 py-12">
    <div class="bg-white p-8 rounded-2xl shadow-xl border border-stone-100">
        <div class="flex justify-between items-center mb-8">
            <h2 class="text-3xl font-serif font-bold text-stone-900">Edit Karya</h2>
            <a href="{{ route('my.artworks') }}" class="text-sm text-stone-500 hover:text-stone-900 font-bold">&larr; Kembali</a>
        </div>

        <form wire:submit.prevent="update" class="space-y-6">
            <div>
                <label class="block text-sm font-bold mb-2">Judul Karya</label>
                <input type="text" wire:model="title" class="w-full p-3 border border-stone-300 rounded-lg focus:ring-2 focus:ring-amber-500 focus:outline-none">
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-bold mb-2">Filosofi / Cerita</label>
                    <textarea wire:model="story_behind" rows="4" class="w-full p-3 border border-stone-300 rounded-lg focus:ring-2 focus:ring-amber-500"></textarea>
                </div>
                <div>
                    <label class="block text-sm font-bold mb-2">Deskripsi Visual</label>
                    <textarea wire:model="description" rows="4" class="w-full p-3 border border-stone-300 rounded-lg focus:ring-2 focus:ring-amber-500"></textarea>
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-bold mb-2">Material</label>
                    <input type="text" wire:model="material" class="w-full p-3 border border-stone-300 rounded-lg">
                </div>
                <div>
                    <label class="block text-sm font-bold mb-2">Dimensi</label>
                    <input type="text" wire:model="dimensions" class="w-full p-3 border border-stone-300 rounded-lg">
                </div>
            </div>

            <div>
                <label class="block text-sm font-bold mb-2">Harga (Rp)</label>
                <input type="number" wire:model="price" class="w-full p-3 border border-stone-300 rounded-lg font-bold">
            </div>

            <div class="bg-stone-50 p-4 rounded-xl border border-stone-200">
                <label class="block text-sm font-bold mb-2">Foto Karya</label>
                <div class="flex gap-4 items-center">
                    <div class="w-20 h-20 rounded-lg overflow-hidden border border-stone-300 bg-white">
                        @if ($photo)
                            <img src="{{ $photo->temporaryUrl() }}" class="w-full h-full object-cover">
                        @else
                            <img src="{{ asset('storage/'.$existingPhoto) }}" class="w-full h-full object-cover opacity-80">
                        @endif
                    </div>
                    
                    <div class="flex-1">
                        <input type="file" wire:model="photo" class="w-full text-sm text-stone-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-stone-200 file:text-stone-700 hover:file:bg-stone-300">
                        <p class="text-xs text-stone-400 mt-1">Kosongkan jika tidak ingin mengubah foto.</p>
                    </div>
                </div>
            </div>

            <button type="submit" class="w-full bg-amber-700 text-white font-bold py-4 rounded-xl hover:bg-amber-800 transition mt-4">
                Simpan Perubahan
            </button>
        </form>
    </div>
</div>