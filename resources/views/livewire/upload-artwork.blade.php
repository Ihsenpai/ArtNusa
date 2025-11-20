<div class="max-w-3xl mx-auto px-4 py-12">
    <div class="bg-white p-8 rounded-2xl shadow-xl border border-stone-100">
        <h2 class="text-3xl font-serif font-bold mb-2 text-stone-900">Upload Karya Baru</h2>
        <p class="text-stone-500 mb-8">Lengkapi detail karya untuk mendapatkan Sertifikat Digital Otomatis.</p>

        <form wire:submit.prevent="save" class="space-y-6">
            
            <div>
                <label class="block text-sm font-bold mb-2">Judul Karya</label>
                <input type="text" wire:model="title" class="w-full p-3 border border-stone-300 rounded-lg focus:ring-2 focus:ring-amber-500 focus:outline-none">
                @error('title') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-bold mb-2">Filosofi / Cerita (Storytelling)</label>
                    <textarea wire:model="story_behind" rows="4" class="w-full p-3 border border-stone-300 rounded-lg focus:ring-2 focus:ring-amber-500"></textarea>
                    <p class="text-xs text-stone-400 mt-1">Ceritakan makna mendalam karya ini.</p>
                </div>
                <div>
                    <label class="block text-sm font-bold mb-2">Deskripsi Visual</label>
                    <textarea wire:model="description" rows="4" class="w-full p-3 border border-stone-300 rounded-lg focus:ring-2 focus:ring-amber-500"></textarea>
                </div>
            </div>

            <div class="grid grid-cols-3 gap-4">
                <div>
                    <label class="block text-sm font-bold mb-2">Material</label>
                    <input type="text" wire:model="material" placeholder="Contoh: Kanvas" class="w-full p-3 border border-stone-300 rounded-lg">
                </div>
                <div>
                    <label class="block text-sm font-bold mb-2">Dimensi</label>
                    <input type="text" wire:model="dimensions" placeholder="50x50 cm" class="w-full p-3 border border-stone-300 rounded-lg">
                </div>
                <div>
                    <label class="block text-sm font-bold mb-2">Tahun</label>
                    <input type="number" wire:model="year_created" class="w-full p-3 border border-stone-300 rounded-lg">
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-bold mb-2">Harga (Rupiah)</label>
                    <div class="relative">
                        <span class="absolute left-3 top-3 text-stone-500">Rp</span>
                        <input type="number" wire:model="price" class="w-full p-3 pl-10 border border-stone-300 rounded-lg font-bold">
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-bold mb-2">Foto Karya</label>
                    <input type="file" wire:model="photo" class="w-full text-sm text-stone-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-stone-100 file:text-stone-700 hover:file:bg-stone-200">
                    <div wire:loading wire:target="photo" class="text-sm text-amber-600 mt-1">Uploading...</div>
                </div>
            </div>

            <button type="submit" class="w-full bg-stone-900 text-white font-bold py-4 rounded-xl hover:bg-stone-800 transition mt-4">
                <i class="fa-solid fa-upload mr-2"></i> Terbitkan & Generate Sertifikat
            </button>
        </form>
    </div>
</div>