<div class="min-h-screen flex items-center justify-center bg-[#FDFBF7] py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full bg-white p-10 rounded-2xl shadow-xl border border-stone-100">
        <div class="text-center mb-8">
            <h2 class="text-3xl font-serif font-bold text-stone-900">Selamat Datang</h2>
            <p class="mt-2 text-sm text-stone-600">Masuk ke akun ArtNusa Anda</p>
        </div>

        @if (session()->has('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4 text-sm">
                {{ session('error') }}
            </div>
        @endif

        <form wire:submit.prevent="login" class="space-y-6">
            
            <div>
                <label class="block text-sm font-bold text-stone-700 mb-2 text-center">Masuk Sebagai</label>
                <div class="flex justify-center space-x-4 p-1 bg-stone-100 rounded-lg">
                    <button type="button" wire:click="$set('role', 'buyer')" class="flex-1 py-2 px-4 rounded-md text-sm font-bold transition {{ $role === 'buyer' ? 'bg-white shadow text-amber-700' : 'text-stone-500 hover:text-stone-700' }}">
                        Pembeli
                    </button>
                    <button type="button" wire:click="$set('role', 'artist')" class="flex-1 py-2 px-4 rounded-md text-sm font-bold transition {{ $role === 'artist' ? 'bg-white shadow text-amber-700' : 'text-stone-500 hover:text-stone-700' }}">
                        Seniman
                    </button>
                    <button type="button" wire:click="$set('role', 'admin')" class="flex-1 py-2 px-4 rounded-md text-sm font-bold transition {{ $role === 'admin' ? 'bg-white shadow text-red-700' : 'text-stone-500 hover:text-stone-700' }}">
                        Admin
                    </button>
                </div>
            </div>

            <div>
                <label class="block text-sm font-bold text-stone-700 mb-1">Email</label>
                <input wire:model="email" type="email" class="w-full p-3 border border-stone-300 rounded-lg focus:ring-2 focus:ring-amber-500 focus:outline-none">
                @error('email') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block text-sm font-bold text-stone-700 mb-1">Password</label>
                <input wire:model="password" type="password" class="w-full p-3 border border-stone-300 rounded-lg focus:ring-2 focus:ring-amber-500 focus:outline-none">
                @error('password') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>

            <button type="submit" class="w-full flex justify-center py-3 px-4 border border-transparent rounded-xl shadow-sm text-sm font-bold text-white bg-stone-900 hover:bg-stone-800 focus:outline-none transition">
                Masuk
            </button>
        </form>

        <div class="text-center mt-6 text-sm">
            <span class="text-stone-500">Belum punya akun?</span>
            <a href="/register" class="font-bold text-amber-700 hover:text-amber-600">Daftar Sekarang</a>
        </div>
    </div>
</div>