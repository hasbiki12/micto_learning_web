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
        Schema::create('tbl_kuis', function (Blueprint $table) {
            $table->id();
            $table->string('judul_kuis');
            $table->unsignedBigInteger('materi_id')->nullable();
            $table->unsignedBigInteger('created_by'); // Guru yang membuat kuis
            $table->time('durasi'); // Durasi pengerjaan kuis dalam format HH:MM:SS
            $table->timestamps();
    
            // Foreign key constraints
            $table->foreign('materi_id')->references('id')->on('materi')->onDelete('set null');
            $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_kuis');
    }
};
