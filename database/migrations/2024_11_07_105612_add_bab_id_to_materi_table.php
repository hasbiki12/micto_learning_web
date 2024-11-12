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
        Schema::table('materi', function (Blueprint $table) {
            $table->unsignedBigInteger('bab_id')->nullable();

            // Menambahkan foreign key
            $table->foreign('bab_id')->references('id')->on('bab')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('materi', function (Blueprint $table) {
            $table->dropForeign(['bab_id']); // Drop foreign key
            $table->dropColumn('bab_id'); // Drop kolom bab_id
        });
    }
};
