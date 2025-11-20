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
        Schema::create('transactions', function (Blueprint $table) {
        $table->id();
        $table->string('invoice_code')->unique(); // INV-2025-XXX
        $table->foreignId('buyer_id')->constrained('users');
        $table->foreignId('artwork_id')->constrained('artworks');
        
        // Pembagian Hasil (Komisi 10%) 
        $table->decimal('total_price', 15, 2); // Dibayar pembeli
        $table->decimal('platform_fee', 15, 2); // Masuk ke ArtNusa (10%)
        $table->decimal('artist_revenue', 15, 2); // Masuk ke Seniman (90%)
        
        $table->enum('status', ['pending', 'paid', 'cancelled'])->default('pending');
        $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
