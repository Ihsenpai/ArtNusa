<div class="max-w-6xl mx-auto px-4 py-12">
    <div class="mb-8">
        <h1 class="text-3xl font-serif font-bold text-stone-900">Riwayat Pembelian</h1>
        <p class="text-stone-500">Laporan transaksi dan status pembayaran Anda.</p>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-stone-200 overflow-hidden">
        
        @if($transactions->isEmpty())
            <div class="text-center py-20">
                <div class="w-20 h-20 bg-stone-100 rounded-full flex items-center justify-center mx-auto mb-4 text-stone-400">
                    <i class="fa-solid fa-receipt text-3xl"></i>
                </div>
                <h3 class="text-lg font-bold text-stone-800">Belum ada transaksi</h3>
                <p class="text-stone-500 mb-6">Anda belum membeli karya seni apapun.</p>
                <a href="/" class="inline-block bg-stone-900 text-white px-6 py-2 rounded-full font-bold text-sm hover:bg-amber-700 transition">
                    Mulai Belanja
                </a>
            </div>
        @else
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead class="bg-stone-50 text-stone-500 text-xs uppercase font-bold border-b border-stone-200">
                        <tr>
                            <th class="px-6 py-4">Invoice & Tanggal</th>
                            <th class="px-6 py-4">Detail Karya</th>
                            <th class="px-6 py-4">Metode Bayar</th>
                            <th class="px-6 py-4">Total Bayar</th>
                            <th class="px-6 py-4 text-center">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-stone-100 text-sm">
                        @foreach($transactions as $trx)
                        <tr class="hover:bg-stone-50 transition">
                            
                            <td class="px-6 py-4">
                                <div class="font-mono font-bold text-stone-800">#{{ $trx->invoice_code }}</div>
                                <div class="text-stone-500 text-xs mt-1">
                                    <i class="fa-regular fa-calendar mr-1"></i>
                                    {{ $trx->created_at->format('d M Y, H:i') }} WIB
                                </div>
                            </td>

                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    @if($trx->artwork)
                                        <img src="{{ asset('storage/'.$trx->artwork->image_path) }}" class="w-12 h-12 rounded-lg object-cover border border-stone-200">
                                        <div>
                                            <div class="font-bold text-stone-800">{{ $trx->artwork->title }}</div>
                                            <div class="text-xs text-stone-500">Oleh: {{ $trx->artwork->user->name ?? 'Seniman' }}</div>
                                        </div>
                                    @else
                                        <span class="text-red-500 italic text-xs">(Data Karya Dihapus)</span>
                                    @endif
                                </div>
                            </td>

                            <td class="px-6 py-4">
                                @if($trx->payment_method == 'transfer')
                                    <div class="flex items-center gap-2 text-stone-700 font-medium">
                                        <div class="w-8 h-8 rounded-full bg-blue-50 text-blue-600 flex items-center justify-center">
                                            <i class="fa-solid fa-building-columns"></i>
                                        </div>
                                        <div>
                                            <div class="text-xs font-bold">Transfer Bank</div>
                                            <div class="text-[10px] text-stone-400">Manual Check</div>
                                        </div>
                                    </div>
                                @else
                                    <div class="flex items-center gap-2 text-stone-700 font-medium">
                                        <div class="w-8 h-8 rounded-full bg-purple-50 text-purple-600 flex items-center justify-center">
                                            <i class="fa-solid fa-qrcode"></i>
                                        </div>
                                        <div>
                                            <div class="text-xs font-bold">E-Wallet / QRIS</div>
                                            <div class="text-[10px] text-stone-400">Auto Check</div>
                                        </div>
                                    </div>
                                @endif
                            </td>

                            <td class="px-6 py-4 font-bold text-amber-700 font-mono text-base">
                                Rp {{ number_format($trx->total_price, 0, ',', '.') }}
                            </td>

                            <td class="px-6 py-4 text-center">
                                @if($trx->status == 'pending')
                                    <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full bg-amber-100 text-amber-700 text-xs font-bold">
                                        <i class="fa-solid fa-clock"></i> Pending
                                    </span>
                                @elseif($trx->status == 'paid')
                                    <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full bg-green-100 text-green-700 text-xs font-bold">
                                        <i class="fa-solid fa-check-circle"></i> Lunas
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full bg-red-100 text-red-700 text-xs font-bold">
                                        <i class="fa-solid fa-xmark"></i> Batal
                                    </span>
                                @endif
                            </td>

                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</div>