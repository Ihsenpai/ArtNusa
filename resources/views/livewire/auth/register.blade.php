<div class="min-h-screen flex items-center justify-center bg-[#FDFBF7] py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full space-y-8 bg-white p-10 rounded-2xl shadow-xl border border-stone-100">
        <div class="text-center">
            <h2 class="text-3xl font-serif font-bold text-stone-900">Daftar Akun Baru</h2>
            <p class="mt-2 text-sm text-stone-600">Bergabung dengan ArtNusa</p>
        </div>

        <form wire:submit.prevent="register" class="mt-8 space-y-6">
            
            <div>
                <label class="block text-sm font-bold text-stone-700 mb-1">Nama Lengkap</label>
                <input wire:model="name" type="text" class="w-full p-3 border border-stone-300 rounded-lg focus:ring-2 focus:ring-amber-500 focus:outline-none" placeholder="Nama Anda">
                @error('name') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block text-sm font-bold text-stone-700 mb-1">Email</label>
                <input wire:model="email" type="email" class="w-full p-3 border border-stone-300 rounded-lg focus:ring-2 focus:ring-amber-500 focus:outline-none" placeholder="email@contoh.com">
                @error('email') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block text-sm font-bold text-stone-700 mb-1">Daftar Sebagai</label>
                <div class="grid grid-cols-2 gap-4">
                    <label class="cursor-pointer">
                        <input type="radio" wire:model="role" value="buyer" class="peer sr-only">
                        <div class="p-3 text-center border-2 border-stone-200 rounded-lg peer-checked:border-amber-600 peer-checked:bg-amber-50 hover:bg-stone-50 transition">
                            <i class="fa-solid fa-bag-shopping mb-1 text-stone-500 peer-checked:text-amber-600"></i>
                            <div class="font-bold text-sm text-stone-600 peer-checked:text-amber-800">Pembeli</div>
                        </div>
                    </label>

                    <label class="cursor-pointer">
                        <input type="radio" wire:model="role" value="artist" class="peer sr-only">
                        <div class="p-3 text-center border-2 border-stone-200 rounded-lg peer-checked:border-amber-600 peer-checked:bg-amber-50 hover:bg-stone-50 transition">
                            <i class="fa-solid fa-palette mb-1 text-stone-500 peer-checked:text-amber-600"></i>
                            <div class="font-bold text-sm text-stone-600 peer-checked:text-amber-800">Seniman</div>
                        </div>
                    </label>
                </div>
            </div>

            <div>
                <label class="block text-sm font-bold text-stone-700 mb-1">Password</label>
                <input wire:model="password" type="password" class="w-full p-3 border border-stone-300 rounded-lg focus:ring-2 focus:ring-amber-500 focus:outline-none" placeholder="********">
                @error('password') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>

            <button type="submit" class="w-full flex justify-center py-3 px-4 border border-transparent rounded-xl shadow-sm text-sm font-bold text-white bg-stone-900 hover:bg-stone-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-stone-500 transition">
                Daftar Sekarang
            </button>
        </form>

        <div class="text-center mt-4 text-sm">
            <span class="text-stone-500">Sudah punya akun?</span>
            <a href="/login" class="font-bold text-amber-700 hover:text-amber-600">Masuk di sini</a>
        </div>
    </div>
</div>