<?php

namespace App\Livewire\Auth;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Login extends Component
{
    public $email, $password, $role = 'buyer'; // Default login sebagai buyer

    public function login()
    {
        $this->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // 1. Coba Login kredensial (Email & Pass)
        if (Auth::attempt(['email' => $this->email, 'password' => $this->password])) {
            
            // 2. Cek apakah Role yang dipilih sesuai dengan Database
            $user = Auth::user();
            
            if ($user->role !== $this->role && $this->role !== 'admin') { // Admin boleh login di mana aja (opsional)
                Auth::logout();
                session()->flash('error', 'Akun ini tidak terdaftar sebagai ' . ucfirst($this->role) . '.');
                return;
            }

            // 3. Redirect sesuai role (opsional, atau ke home aja)
            return redirect()->intended('/');
        }

        // Jika gagal
        $this->addError('email', 'Email atau password salah.');
    }

    public function render()
    {
        return view('livewire.auth.login');
    }
}