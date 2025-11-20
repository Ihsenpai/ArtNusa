<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Artwork extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'slug',
        'description',
        'story_behind',
        'material',
        'dimensions',
        'year_created',
        'price',
        'image_path',
        'status',
    ];

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function certificate()
    {
        return $this->hasOne(Certificate::class);
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
}
