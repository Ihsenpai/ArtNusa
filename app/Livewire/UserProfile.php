<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use App\Models\User;

class UserProfile extends Component
{
    // Data Profil
    public $name, $email, $phone, $bio;
    public $bank_name, $bank_account;
    
    // Data Ganti Password
    public $current_password, $new_password, $new_password_confirmation;

    public function mount()
    {
        $user = Auth::user();
        $this->name = $user->name;
        $this->email = $user->email;
        $this->phone = $user->phone;
        $this->bio = $user->bio;
        $this->bank_name = $user->bank_name;
        $this->bank_account = $user->bank_account;
    }

    public function updateProfile()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        $this->validate([
            'name' => 'required|string|max:255',
            'email' => ['required', 'email', Rule::unique('users')->ignore($user->id)],
            'phone' => 'nullable|string|max:20',
            'bio'   => 'nullable|string|max:1000',
            // Validasi bank hanya jika user adalah artist
            'bank_name' => $user->role == 'artist' ? 'required|string' : 'nullable',
            'bank_account' => $user->role == 'artist' ? 'required|string' : 'nullable',
        ]);

        // Update data (updated_at otomatis berubah di database Laravel)
        $user->update([
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'bio' => $this->bio,
            'bank_name' => $this->bank_name,
            'bank_account' => $this->bank_account,
        ]);

        session()->flash('message', 'Profil berhasil diperbarui.');
    }

    public function updatePassword()
    {
        $this->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:8|confirmed',
        ]);

        /** @var \App\Models\User $user */
        $user = Auth::user();

        if (!Hash::check($this->current_password, $user->password)) {
            $this->addError('current_password', 'Password lama salah.');
            return;
        }

        $user->update([
            'password' => Hash::make($this->new_password)
        ]);

        $this->reset(['current_password', 'new_password', 'new_password_confirmation']);
        session()->flash('password_message', 'Password berhasil diganti.');
    }

    public function deleteAccount()
    {
        $user = User::find(Auth::id()); // Ambil fresh user
        Auth::logout();
        $user->delete(); // Hapus permanen

        session()->invalidate();
        session()->regenerateToken();

        return redirect('/');
    }

    public function render()
    {
        return view('livewire.user-profile');
    }
}
