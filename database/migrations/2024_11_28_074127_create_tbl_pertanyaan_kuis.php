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
        Schema::create('tbl_pertanyaan_kuis', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('kuis_id'); // Foreign key ke tabel kuis
            $table->text('pertanyaan'); // Pertanyaan kuis
            $table->string('jawaban_a'); // Opsi jawaban A
            $table->string('jawaban_b'); // Opsi jawaban B
            $table->string('jawaban_c'); // Opsi jawaban C
            $table->string('jawaban_d'); // Opsi jawaban D
            $table->string('jawaban_e'); // Opsi jawaban E
            $table->string('kunci_jawaban'); // Kunci jawaban (misalnya 'A', 'B', dsb.)
            $table->timestamps();

            // Foreign key constraints
            $table->foreign('kuis_id')->references('id')->on('tbl_kuis')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_pertanyaan_kuis');
    }
};
