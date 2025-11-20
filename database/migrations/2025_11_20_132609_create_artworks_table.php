<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('artworks', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Pemilik karya (Seniman)
        
        $table->string('title');
        $table->string('slug'); // Untuk URL cantik (seo)
        
        // Detail Fisik & Filosofi 
        $table->text('description'); // Deskripsi singkat
        $table->text('story_behind'); // Filosofi / Cerita di balik karya
        $table->string('material'); // Contoh: Kanvas, Cat Minyak Ramah Lingkungan
        $table->string('dimensions'); // Contoh: 120x80 cm
        $table->year('year_created');
        
        // Penjualan
        $table->decimal('price', 15, 2); // Harga (Rupiah)
        $table->string('image_path'); // Lokasi file gambar
        $table->enum('status', ['available', 'sold'])->default('available');
        
        $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('artworks');
    }
};
