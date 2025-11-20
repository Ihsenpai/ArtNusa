<div class="max-w-6xl mx-auto px-4 py-12">
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
        
        <div>
            <div class="rounded-2xl overflow-hidden shadow-2xl border border-stone-200 bg-white p-2">
                <img src="{{ asset('storage/'.$artwork->image_path) }}" class="w-full rounded-xl">
            </div>

            <div class="mt-6 bg-amber-50 border border-amber-200 rounded-xl p-4 flex items-center gap-4">
                <div class="bg-white p-3 rounded-full shadow-sm text-amber-600">
                    <i class="fa-solid fa-shield-halved text-2xl"></i>
                </div>
                <div>
                    <h4 class="font-bold text-stone-800">Keaslian Terjamin</h4>
                    <p class="text-sm text-stone-600">
                        Dilengkapi Sertifikat Digital (UUID: <span class="font-mono bg-amber-100 px-1 rounded">{{ substr($artwork->certificate->certificate_code ?? 'Generating...', 0, 8) }}...</span>)
                    </p>
                </div>
            </div>
        </div>

        <div class="space-y-8">
            <div>
                <h1 class="text-4xl font-serif font-bold text-stone-900 mb-2">{{ $artwork->title }}</h1>
                <p class="text-lg text-stone-500">Karya oleh <span class="text-stone-900 font-semibold">{{ $artwork->user->name }}</span></p>
            </div>

            <div class="grid grid-cols-2 gap-4 py-6 border-y border-stone-200">
                <div>
                    <span class="block text-stone-400 text-xs uppercase tracking-wider">Material</span>
                    <span class="font-medium">{{ $artwork->material }}</span>
                </div>
                <div>
                    <span class="block text-stone-400 text-xs uppercase tracking-wider">Dimensi</span>
                    <span class="font-medium">{{ $artwork->dimensions }}</span>
                </div>
                <div>
                    <span class="block text-stone-400 text-xs uppercase tracking-wider">Tahun</span>
                    <span class="font-medium">{{ $artwork->year_created }}</span>
                </div>
                <div>
                    <span class="block text-stone-400 text-xs uppercase tracking-wider">ID Sertifikat</span>
                    <span class="font-medium text-xs truncate">{{ $artwork->certificate->certificate_code ?? '-' }}</span>
                </div>
            </div>

            <div>
                <h3 class="font-serif font-bold text-lg mb-2">Filosofi Karya</h3>
                <p class="text-stone-600 leading-relaxed">{{ $artwork->story_behind }}</p>
                
                <h3 class="font-serif font-bold text-lg mt-4 mb-2">Deskripsi Fisik</h3>
                <p class="text-stone-600 leading-relaxed">{{ $artwork->description }}</p>
            </div>

            <div class="bg-white p-6 rounded-2xl border border-stone-200 shadow-lg">
                @if($successMessage)
                    <div class="bg-green-100 text-green-800 p-4 rounded-xl mb-4 text-center">
                        <i class="fa-solid fa-check-circle mr-2"></i> {{ $successMessage }}
                    </div>
                @elseif($artwork->status == 'sold')
                    <button disabled class="w-full bg-stone-300 text-stone-500 font-bold py-4 rounded-xl cursor-not-allowed">
                        Karya Sudah Terjual
                    </button>
                @else
                    <div class="flex justify-between items-end mb-6">
                        <span class="text-stone-500">Harga</span>
                        <span class="text-3xl font-bold text-stone-900">Rp {{ number_format($artwork->price, 0, ',', '.') }}</span>
                    </div>
                    <button wire:click="buyNow" class="w-full bg-stone-900 text-white font-bold py-4 rounded-xl hover:bg-amber-700 transition shadow-lg hover:shadow-amber-900/20">
                        Beli Sekarang
                    </button>
                    <p class="text-xs text-center text-stone-400 mt-3">
                        <i class="fa-solid fa-lock mr-1"></i> Transaksi Aman & Terpercaya
                    </p>
                @endif
            </div>
        </div>
    </div>
</div>