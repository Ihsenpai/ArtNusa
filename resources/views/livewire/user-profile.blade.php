<div class="max-w-4xl mx-auto px-4 py-12">
    
    <h1 class="text-3xl font-serif font-bold text-stone-900 mb-2">Pengaturan Akun</h1>
    <p class="text-stone-500 mb-8">Kelola informasi profil dan keamanan akun Anda.</p>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

        <div class="lg:col-span-2 space-y-8">
            
            <div class="bg-white p-8 rounded-2xl shadow-sm border border-stone-100">
                <h2 class="text-xl font-bold text-stone-900 mb-6 pb-4 border-b border-stone-100">Edit Profil</h2>
                
                @if (session('message'))
                    <div class="bg-green-100 text-green-800 p-3 rounded-lg mb-4 text-sm font-bold">
                        <i class="fa-solid fa-check mr-2"></i> {{ session('message') }}
                    </div>
                @endif

                <form wire:submit.prevent="updateProfile" class="space-y-5">
                    <div>
                        <label class="block text-sm font-bold text-stone-700 mb-1">Nama Lengkap</label>
                        <input wire:model="name" type="text" class="w-full p-3 border border-stone-300 rounded-lg focus:ring-2 focus:ring-amber-500 focus:outline-none">
                        @error('name') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-bold text-stone-700 mb-1">Email</label>
                            <input wire:model="email" type="email" class="w-full p-3 border border-stone-300 rounded-lg focus:ring-2 focus:ring-amber-500 focus:outline-none">
                            @error('email') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-stone-700 mb-1">No. WhatsApp / HP</label>
                            <input wire:model="phone" type="text" class="w-full p-3 border border-stone-300 rounded-lg focus:ring-2 focus:ring-amber-500 focus:outline-none">
                            @error('phone') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-stone-700 mb-1">Bio / Tentang Saya</label>
                        <textarea wire:model="bio" rows="3" class="w-full p-3 border border-stone-300 rounded-lg focus:ring-2 focus:ring-amber-500"></textarea>
                        @error('bio') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    @if(Auth::user()->role == 'artist')
                        <div class="bg-stone-50 p-4 rounded-xl border border-stone-200">
                            <h3 class="text-sm font-bold text-amber-800 mb-3 uppercase tracking-wide">Rekening Penerimaan Dana</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-xs font-bold text-stone-500 mb-1">Nama Bank</label>
                                    <input wire:model="bank_name" type="text" placeholder="Cth: BCA" class="w-full p-2 border border-stone-300 rounded bg-white">
                                    @error('bank_name') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                                </div>
                                <div>
                                    <label class="block text-xs font-bold text-stone-500 mb-1">Nomor Rekening</label>
                                    <input wire:model="bank_account" type="text" placeholder="1234xxxx" class="w-full p-2 border border-stone-300 rounded bg-white">
                                    @error('bank_account') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>
                    @endif

                    <button type="submit" class="bg-stone-900 text-white px-6 py-3 rounded-xl font-bold hover:bg-stone-700 transition">
                        Simpan Perubahan
                    </button>
                </form>
            </div>

            <div class="bg-red-50 p-8 rounded-2xl border border-red-100">
                <h2 class="text-xl font-bold text-red-800 mb-4">Zona Bahaya</h2>
                <p class="text-sm text-red-600 mb-6">Menghapus akun akan menghilangkan semua data Anda secara permanen. Tindakan ini tidak dapat dibatalkan.</p>
                
                <button onclick="confirm('Yakin ingin menghapus akun permanen?') || event.stopImmediatePropagation()" 
                        wire:click="deleteAccount" 
                        class="bg-white border border-red-300 text-red-600 px-5 py-2 rounded-lg font-bold text-sm hover:bg-red-600 hover:text-white transition">
                    Hapus Akun Saya
                </button>
            </div>

        </div>

        <div class="lg:col-span-1">
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-stone-100 sticky top-24">
                <h2 class="text-lg font-bold text-stone-900 mb-6 pb-2 border-b border-stone-100">Ganti Password</h2>

                @if (session('password_message'))
                    <div class="bg-green-100 text-green-800 p-3 rounded-lg mb-4 text-xs font-bold">
                        {{ session('password_message') }}
                    </div>
                @endif

                <form wire:submit.prevent="updatePassword" class="space-y-4">
                    <div>
                        <label class="block text-xs font-bold text-stone-500 mb-1">Password Lama</label>
                        <input wire:model="current_password" type="password" class="w-full p-2 border border-stone-300 rounded-lg text-sm">
                        @error('current_password') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-stone-500 mb-1">Password Baru</label>
                        <input wire:model="new_password" type="password" class="w-full p-2 border border-stone-300 rounded-lg text-sm">
                        @error('new_password') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-stone-500 mb-1">Konfirmasi Password Baru</label>
                        <input wire:model="new_password_confirmation" type="password" class="w-full p-2 border border-stone-300 rounded-lg text-sm">
                    </div>

                    <button type="submit" class="w-full bg-amber-700 text-white px-4 py-2.5 rounded-lg font-bold text-sm hover:bg-amber-800 transition">
                        Update Password
                    </button>
                </form>
            </div>
        </div>

    </div>
</div>