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
        // Jika ada kode di URL (hasil scan QR), langsung verifikasi!
        if ($code) {
            $this->code = $code;
            $this->verify();
        }
    }

    public function verify()
    {
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