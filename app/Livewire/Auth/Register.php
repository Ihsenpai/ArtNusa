<?php

namespace App\Livewire\Auth;

use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class Register extends Component
{
    public $name, $email, $password, $role = 'buyer'; // Default pembeli

    public function register()
    {
        $this->validate([
            'name' => 'required|min:3',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'role' => 'required|in:buyer,artist', // Admin tidak bisa daftar sembarangan
        ]);

        $user = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
            'role' => $this->role,
            'bio' => $this->role == 'artist' ? 'Seniman baru bergabung.' : null,
        ]);

        Auth::login($user);

        return redirect('/');
    }

    public function render()
    {
        return view('livewire.auth.register');
    }
}