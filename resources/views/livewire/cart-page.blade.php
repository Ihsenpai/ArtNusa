<div class="max-w-4xl mx-auto px-4 py-12">
    <h1 class="text-3xl font-serif font-bold mb-8">Keranjang Belanja</h1>

    @if($carts->isEmpty())
        <div class="text-center py-12 bg-white rounded-xl border border-stone-200">
            <i class="fa-solid fa-basket-shopping text-4xl text-stone-300 mb-4"></i>
            <p class="text-stone-500">Keranjang Anda masih kosong.</p>
            <a href="/" class="text-amber-700 font-bold text-sm hover:underline mt-2 block">Cari Lukisan</a>
        </div>
    @else
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <div class="lg:col-span-2 space-y-4">
                @foreach($carts as $item)
                <div class="flex gap-4 bg-white p-4 rounded-xl border border-stone-200">
                    <img src="{{ asset('storage/'.$item->artwork->image_path) }}" class="w-20 h-20 object-cover rounded-lg">
                    <div class="flex-1">
                        <h3 class="font-bold text-stone-800">{{ $item->artwork->title }}</h3>
                        <p class="text-sm text-stone-500">{{ $item->artwork->user->name }}</p>
                        <p class="text-amber-700 font-bold mt-1">Rp {{ number_format($item->artwork->price, 0, ',', '.') }}</p>
                    </div>
                    <button wire:click="remove({{ $item->id }})" class="text-stone-400 hover:text-red-600 self-start"><i class="fa-solid fa-trash"></i></button>
                </div>
                @endforeach
            </div>

            <div class="bg-white p-6 rounded-xl border border-stone-200 h-fit">
                <h3 class="font-bold text-lg mb-4">Ringkasan</h3>
                <div class="flex justify-between mb-2 text-stone-600"><span>Total Item</span><span>{{ $carts->count() }}</span></div>
                <div class="flex justify-between mb-6 text-xl font-bold text-stone-900"><span>Total Harga</span><span>Rp {{ number_format($total, 0, ',', '.') }}</span></div>
                <button wire:click="openCheckout" class="w-full bg-stone-900 text-white py-3 rounded-xl font-bold hover:bg-amber-800 transition">Checkout Sekarang</button>
            </div>
        </div>
    @endif

    @if($showCheckoutModal)
    <div class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 backdrop-blur-sm p-4">
        <div class="bg-white rounded-2xl shadow-2xl w-full max-w-md overflow-hidden animate-fade-in-up">
            <div class="bg-stone-50 px-6 py-4 border-b border-stone-200 flex justify-between items-center">
                <h3 class="font-bold text-lg text-stone-800">Konfirmasi Checkout</h3>
                <button wire:click="$set('showCheckoutModal', false)" class="text-stone-400 hover:text-red-500"><i class="fa-solid fa-xmark text-xl"></i></button>
            </div>
            <div class="p-6 space-y-4">
                <p class="text-sm text-stone-500">Pembayaran untuk <span class="font-bold text-stone-800">{{ $carts->count() }} karya seni</span>.</p>
                    <div class="space-y-3">
                    <label class="flex items-center gap-3 p-3 border-2 border-stone-200 rounded-xl cursor-pointer bg-white transition-all
                                  hover:border-stone-300
                                  has-[:checked]:border-amber-500 has-[:checked]:bg-amber-50 has-[:checked]:text-amber-900">
                        
                        <input type="radio" wire:model="paymentMethod" name="paymentMethod" value="transfer" class="accent-amber-600 w-4 h-4">
                        
                        <div class="flex-1">
                            <div class="font-bold text-sm">Transfer Bank</div>
                            <div class="text-xs text-stone-400">BCA, BRI, Mandiri</div>
                        </div>
                        <i class="fa-solid fa-building-columns text-stone-300"></i>
                    </label>
                    <label class="flex items-center gap-3 p-3 border-2 border-stone-200 rounded-xl cursor-pointer bg-white transition-all
                                  hover:border-stone-300
                                  has-[:checked]:border-amber-500 has-[:checked]:bg-amber-50 has-[:checked]:text-amber-900">
                        
                        <input type="radio" wire:model="paymentMethod" name="paymentMethod" value="ewallet" class="accent-amber-600 w-4 h-4">
                        
                        <div class="flex-1">
                            <div class="font-bold text-sm">E-Wallet / QRIS</div>
                            <div class="text-xs text-stone-400">GoPay, OVO, Dana</div>
                        </div>
                        <i class="fa-solid fa-qrcode text-stone-300"></i>
                    </label>
                </div>
                <div class="flex justify-between items-center pt-4 border-t border-stone-100">
                    <span class="text-sm font-bold text-stone-600">Tagihan</span>
                    <span class="text-xl font-bold text-amber-700">Rp {{ number_format($total, 0, ',', '.') }}</span>
                </div>
            </div>
            <div class="p-4 bg-stone-50 border-t border-stone-200">
                <button wire:click="processCheckout" class="w-full bg-stone-900 text-white py-3 rounded-xl font-bold hover:bg-stone-800 transition">Bayar Sekarang</button>
            </div>
        </div>
    </div>
    @endif
</div>