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
        Schema::create('certificates', function (Blueprint $table) {
        $table->id();
        $table->foreignId('artwork_id')->constrained()->onDelete('cascade');
        
        // Kode Unik untuk QR Code 
        $table->uuid('certificate_code')->unique(); 
        $table->timestamp('issued_at'); // Tanggal terbit sertifikat
        $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('certificates');
    }
};
