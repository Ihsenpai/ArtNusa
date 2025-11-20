<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Certificate;

class CertificateVerify extends Component
{
    public $code;
    public $result = null;
    public $notFound = false;

    public function verify()
    {
        $this->result = Certificate::with('artwork.user')
            ->where('certificate_code', $this->code)
            ->first();

        $this->notFound = $this->result ? false : true;
    }

    public function render()
    {
        return view('livewire.certificate-verify');
    }
}