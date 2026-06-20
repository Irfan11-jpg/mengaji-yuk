<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('hafalan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('santri_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('surah_id')->constrained('surah')->onDelete('cascade');
            $table->integer('ayat_mulai');
            $table->integer('ayat_selesai');
            $table->enum('status', ['belum', 'proses', 'selesai'])->default('belum');
            $table->integer('nilai')->nullable()->comment('nilai dari guru, skala 0-100');
            $table->text('catatan_guru')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('hafalan');
    }
};