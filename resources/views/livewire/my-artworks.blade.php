<div class="max-w-7xl mx-auto px-4 py-12">
    <div class="flex justify-between items-center mb-8">
        <div>
            <h1 class="text-3xl font-serif font-bold text-stone-900">Manajemen Karya</h1>
            <p class="text-stone-500">Kelola semua lukisan yang Anda jual.</p>
        </div>
        <a href="/upload" class="bg-stone-900 text-white px-5 py-2 rounded-full hover:bg-amber-800 transition font-bold text-sm">
            <i class="fa-solid fa-plus mr-2"></i> Tambah Baru
        </a>
    </div>

    @if (session('message'))
        <div class="bg-green-100 text-green-800 p-4 rounded-xl mb-6 font-bold">
            <i class="fa-solid fa-check mr-2"></i> {{ session('message') }}
        </div>
    @endif

    <div class="bg-white rounded-2xl shadow-sm border border-stone-200 overflow-hidden">
        @if($artworks->isEmpty())
            <div class="text-center py-16">
                <div class="text-6xl mb-4 text-stone-200">🎨</div>
                <h3 class="text-xl font-bold text-stone-400">Belum ada karya</h3>
                <p class="text-stone-400 mb-6">Mulai upload karya seni pertamamu sekarang.</p>
                <a href="/upload" class="text-amber-700 font-bold hover:underline">Upload Sekarang</a>
            </div>
        @else
            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm">
                    <thead class="bg-stone-50 border-b border-stone-200 text-stone-500 uppercase text-xs">
                        <tr>
                            <th class="px-6 py-4 font-bold">Foto</th>
                            <th class="px-6 py-4 font-bold">Judul & Status</th>
                            <th class="px-6 py-4 font-bold">Harga</th>
                            <th class="px-6 py-4 font-bold text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-stone-100">
                        @foreach($artworks as $art)
                        <tr class="hover:bg-stone-50 transition">
                            <td class="px-6 py-4">
                                <img src="{{ asset('storage/'.$art->image_path) }}" class="w-16 h-16 object-cover rounded-lg border border-stone-200">
                            </td>
                            <td class="px-6 py-4">
                                <div class="font-bold text-stone-900 text-base">{{ $art->title }}</div>
                                <span class="text-xs px-2 py-1 rounded-full font-bold {{ $art->status == 'available' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                    {{ $art->status == 'available' ? 'Tersedia' : 'Terjual' }}
                                </span>
                            </td>
                            <td class="px-6 py-4 font-mono text-stone-600">
                                Rp {{ number_format($art->price, 0, ',', '.') }}
                            </td>
                            <td class="px-6 py-4 text-right space-x-2">
                                <a href="{{ route('artwork.edit', $art->id) }}" class="inline-block bg-stone-100 text-stone-600 hover:bg-amber-100 hover:text-amber-700 px-3 py-2 rounded-lg transition">
                                    <i class="fa-solid fa-pen"></i>
                                </a>
                                
                                <button wire:click="delete({{ $art->id }})" 
                                        onclick="return confirm('Yakin ingin menghapus karya ini?') || event.stopImmediatePropagation()"
                                        class="inline-block bg-red-50 text-red-600 hover:bg-red-100 px-3 py-2 rounded-lg transition">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</div>