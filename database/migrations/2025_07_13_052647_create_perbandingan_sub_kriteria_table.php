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
        Schema::create('perbandingan_sub_kriteria', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sub_kriteria_id_1')->constrained('sub_kriteria')->onDelete('cascade');
            $table->foreignId('sub_kriteria_id_2')->constrained('sub_kriteria')->onDelete('cascade');
            $table->decimal('nilai', 8, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('perbandingan_sub_kriteria');
    }
};
