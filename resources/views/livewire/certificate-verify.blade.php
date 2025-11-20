<div class="max-w-2xl mx-auto px-4 py-16">
    <div class="text-center mb-10">
        <h1 class="text-3xl font-serif font-bold text-stone-900 mb-2">Verifikasi Keaslian</h1>
        <p class="text-stone-500">Masukkan Kode Unik (UUID) yang tertera pada sertifikat digital ArtNusa.</p>
    </div>

    <div class="bg-white p-8 rounded-2xl shadow-lg border-t-4 border-amber-600">
        <form wire:submit.prevent="verify" class="flex gap-4 mb-8">
            <input type="text" wire:model="code" placeholder="Contoh: 550e8400-e29b..." class="flex-1 p-3 border border-stone-300 rounded-lg focus:ring-2 focus:ring-amber-500">
            <button type="submit" class="bg-stone-900 text-white px-6 py-3 rounded-lg font-bold hover:bg-stone-800">
                Cek
            </button>
        </form>

        @if($result)
            <div class="bg-green-50 border border-green-200 rounded-xl p-6 animate-fade-in-up">
                <div class="flex items-center gap-3 mb-4 border-b border-green-200 pb-4">
                    <div class="bg-green-500 text-white w-10 h-10 rounded-full flex items-center justify-center">
                        <i class="fa-solid fa-check"></i>
                    </div>
                    <div>
                        <h3 class="font-bold text-green-800 text-lg">Sertifikat Valid</h3>
                        <p class="text-green-600 text-sm">Terdaftar resmi di database ArtNusa</p>
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-4 text-sm">
                    <div>
                        <span class="block text-stone-400">Judul Karya</span>
                        <span class="font-bold text-stone-800">{{ $result->artwork->title }}</span>
                    </div>
                    <div>
                        <span class="block text-stone-400">Seniman</span>
                        <span class="font-bold text-stone-800">{{ $result->artwork->user->name }}</span>
                    </div>
                    <div class="col-span-2">
                        <span class="block text-stone-400">Tanggal Terbit</span>
                        <span class="font-mono">{{ $result->issued_at->format('d M Y, H:i') }}</span>
                    </div>
                </div>
            </div>
        @elseif($notFound)
            <div class="bg-red-50 border border-red-200 rounded-xl p-6 text-center text-red-700">
                <i class="fa-solid fa-circle-xmark text-3xl mb-2"></i>
                <h3 class="font-bold">Data Tidak Ditemukan</h3>
                <p class="text-sm">Kode sertifikat tidak valid atau belum terdaftar.</p>
            </div>
        @endif
    </div>
</div>