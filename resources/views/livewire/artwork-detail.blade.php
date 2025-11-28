<div class="max-w-6xl mx-auto px-4 py-12">
    
    @if (session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-6 font-bold text-center">
            {{ session('error') }}
        </div>
    @endif

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
                    <p class="text-sm text-stone-600">Dilengkapi Sertifikat Digital ArtNusa.</p>
                </div>
            </div>
        </div>

        <div class="space-y-8">
            <div>
                <h1 class="text-4xl font-serif font-bold text-stone-900 mb-2">{{ $artwork->title }}</h1>
                <p class="text-lg text-stone-500">Karya oleh <span class="text-stone-900 font-semibold">{{ $artwork->user->name }}</span></p>
            </div>

            <div class="grid grid-cols-2 gap-4 py-6 border-y border-stone-200">
                <div><span class="block text-stone-400 text-xs uppercase">Material</span><span class="font-medium">{{ $artwork->material }}</span></div>
                <div><span class="block text-stone-400 text-xs uppercase">Dimensi</span><span class="font-medium">{{ $artwork->dimensions }}</span></div>
                <div><span class="block text-stone-400 text-xs uppercase">Tahun</span><span class="font-medium">{{ $artwork->year_created }}</span></div>
                <div><span class="block text-stone-400 text-xs uppercase">ID Sertifikat</span><span class="font-medium text-xs truncate">{{ $artwork->certificate->certificate_code ?? 'Generating...' }}</span></div>
            </div>

            <div>
                <h3 class="font-serif font-bold text-lg mb-2">Filosofi Karya</h3>
                <p class="text-stone-600 leading-relaxed">{{ $artwork->story_behind }}</p>
                
                <h3 class="font-serif font-bold text-lg mt-4 mb-2">Deskripsi Fisik</h3>
                <p class="text-stone-600 leading-relaxed">{{ $artwork->description }}</p>
            </div>

            <div class="bg-white p-6 rounded-2xl border border-stone-200 shadow-lg sticky bottom-4">
                
                @if($artwork->status == 'sold')
                    <button disabled class="w-full bg-stone-300 text-stone-500 font-bold py-4 rounded-xl cursor-not-allowed">
                        Karya Sudah Terjual
                    </button>

                @elseif(Auth::check() && Auth::id() == $artwork->user_id)
                    <div class="bg-amber-50 border border-amber-200 text-amber-800 p-4 rounded-xl text-center">
                        <i class="fa-solid fa-user-lock text-2xl mb-2"></i>
                        <p class="font-bold">Ini adalah karya Anda sendiri.</p>
                        <p class="text-sm mb-2">Anda tidak dapat membeli karya milik sendiri.</p>
                        <a href="{{ route('artwork.edit', $artwork->id) }}" class="inline-block px-4 py-2 bg-white border border-amber-300 rounded-lg text-sm font-bold hover:bg-amber-100">
                            <i class="fa-solid fa-pen mr-1"></i> Edit Karya Ini
                        </a>
                    </div>

                @else
                    <div class="flex justify-between items-end mb-6">
                        <span class="text-stone-500">Harga</span>
                        <span class="text-3xl font-bold text-stone-900">Rp {{ number_format($artwork->price, 0, ',', '.') }}</span>
                    </div>
                    
                    <div class="flex gap-3">
                        <button wire:click="addToCart" class="flex-1 border-2 border-stone-900 text-stone-900 font-bold py-3 rounded-xl hover:bg-stone-50 transition">
                            <i class="fa-solid fa-cart-plus mr-2"></i> Keranjang
                        </button>
                        
                        <button wire:click="openPaymentModal" class="flex-1 bg-stone-900 text-white font-bold py-3 rounded-xl hover:bg-amber-700 transition shadow-lg">
                            Beli Sekarang
                        </button>
                    </div>
                @endif
            </div>
        </div>
    </div>

    @if($showPaymentModal)
    <div class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 backdrop-blur-sm p-4">
        <div class="bg-white rounded-2xl shadow-2xl w-full max-w-md overflow-hidden animate-fade-in-up">
            
            <div class="bg-stone-50 px-6 py-4 border-b border-stone-200 flex justify-between items-center">
                <h3 class="font-bold text-lg text-stone-800">Pilih Pembayaran</h3>
                <button wire:click="$set('showPaymentModal', false)" class="text-stone-400 hover:text-red-500">
                    <i class="fa-solid fa-xmark text-xl"></i>
                </button>
            </div>

            <div class="p-6 space-y-4">
                <p class="text-sm text-stone-500">Anda akan membeli karya <span class="font-bold text-stone-800">"{{ $artwork->title }}"</span>.</p>

                <x-payment-selector :paymentMethod="$paymentMethod" />

                <div class="flex justify-between items-center pt-4 border-t border-stone-100">
                    <span class="text-sm font-bold text-stone-600">Total Tagihan</span>
                    <span class="text-xl font-bold text-amber-700">Rp {{ number_format($artwork->price, 0, ',', '.') }}</span>
                </div>
            </div>

            <div class="p-4 bg-stone-50 border-t border-stone-200">
                <button wire:click="processPayment" class="w-full bg-stone-900 text-white py-3 rounded-xl font-bold hover:bg-stone-800 transition flex justify-center items-center gap-2">
                    <span>Bayar Sekarang</span>
                    <i class="fa-solid fa-arrow-right text-xs"></i>
                </button>
            </div>
        </div>
    </div>
    @endif
</div>