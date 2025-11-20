<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Admin
        User::create([
            'name' => 'Admin ArtNusa',
            'email' => 'admin@artnusa.com',
            'password' => bcrypt('password'),
            'role' => 'admin',
        ]);

        // Sample Artist
        $artist = User::create([
            'name' => 'Seniman Budi',
            'email' => 'budi@artnusa.com',
            'password' => bcrypt('password'),
            'role' => 'artist',
            'bio' => 'Seniman lukis profesional dengan pengalaman 10 tahun',
            'phone' => '08123456789',
            'bank_name' => 'BCA',
            'bank_account' => '1234567890',
        ]);

        // Sample Buyer
        User::create([
            'name' => 'Kolektor Sari',
            'email' => 'sari@gmail.com',
            'password' => bcrypt('password'),
            'role' => 'buyer',
            'phone' => '08123456788',
        ]);

        // Sample Artwork
        $artwork = \App\Models\Artwork::create([
            'user_id' => $artist->id,
            'title' => 'Pemandangan Nusa Dua',
            'slug' => 'pemandangan-nusa-dua',
            'description' => 'Lukisan pemandangan pantai Nusa Dua yang indah',
            'story_behind' => 'Terinspirasi dari keindahan alam Bali yang mempesona',
            'material' => 'Cat minyak di atas kanvas',
            'dimensions' => '60x40 cm',
            'year_created' => 2024,
            'price' => 2500000.00,
            'image_path' => 'artworks/sample.jpg',
            'status' => 'available',
        ]);

        // Auto create certificate
        \App\Models\Certificate::create([
            'artwork_id' => $artwork->id,
            'certificate_code' => \Illuminate\Support\Str::uuid(),
            'issued_at' => now(),
        ]);
    }
}
