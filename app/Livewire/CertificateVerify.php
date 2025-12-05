<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Certificate;

class CertificateVerify extends Component
{
    public $code;       // Kode inputan user
    public $result;     // Hasil pencarian
    public $notFound = false;

    // Fungsi ini jalan otomatis saat halaman dibuka
    public function mount($code = null)
    {
        // LOGIC PINTAR:
        // 1. Cek apakah kode ada di Route (/verify/kode)
        // 2. Kalau tidak ada, cek di Query String (?code=kode) <- Ini penting buat Scan QR
        $this->code = $code ?? request()->query('code');

        // Jika kode ditemukan otomatis, langsung jalankan verifikasi
        if ($this->code) {
            $this->verify();
        }
    }

    public function verify()
    {
        // Validasi: Jangan cari kalau kode kosong
        if (!$this->code) return;

        // Cari sertifikat berdasarkan kode unik
        $this->result = Certificate::with('artwork.user')
            ->where('certificate_code', $this->code)
            ->first();

        // Tentukan status ketemu atau tidak
        $this->notFound = $this->result ? false : true;
    }

    public function render()
    {
        return view('livewire.certificate-verify');
    }
}