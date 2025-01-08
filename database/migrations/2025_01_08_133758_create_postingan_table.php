<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('postingan', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->string('slug')->unique();
            $table->longText('konten');
            $table->foreignId('kategori_id')->constrained('kategori')->onDelete('cascade');
            // $table->foreignId('kategori_id')->constrained()->cascadeOnDelete();
            $table->boolean('published')->default(false);
            $table->string('sampul')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('postingan');
    }
};