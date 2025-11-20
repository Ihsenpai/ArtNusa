<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;

class Certificate extends Model
{
    use HasFactory;

    protected $fillable = [
        'artwork_id',
        'certificate_code',
        'issued_at',
    ];

    protected $casts = [
        'issued_at' => 'datetime',
    ];

    // Auto generate UUID when creating
    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($certificate) {
            if (empty($certificate->certificate_code)) {
                $certificate->certificate_code = Str::uuid();
            }
            if (empty($certificate->issued_at)) {
                $certificate->issued_at = now();
            }
        });
    }

    // Relationships
    public function artwork()
    {
        return $this->belongsTo(Artwork::class);
    }
}
