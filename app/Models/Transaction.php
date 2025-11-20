<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'invoice_code',
        'buyer_id',
        'artwork_id',
        'total_price',
        'platform_fee',
        'artist_revenue',
        'status',
    ];

    protected $casts = [
        'total_price' => 'decimal:2',
        'platform_fee' => 'decimal:2',
        'artist_revenue' => 'decimal:2',
    ];

    // Relationships
    public function buyer()
    {
        return $this->belongsTo(User::class, 'buyer_id');
    }

    public function artwork()
    {
        return $this->belongsTo(Artwork::class);
    }
}
