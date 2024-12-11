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
        Schema::create('tbl_kuis_siswa', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('kuis_id');
            $table->unsignedBigInteger('user_id'); // Siswa yang mengerjakan kuis
            $table->integer('score')->nullable(); // Nilai yang diperoleh siswa
            $table->timestamps();
    
            // Foreign key constraints
            $table->foreign('kuis_id')->references('id')->on('tbl_kuis')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_kuis_siswa');
    }
};
