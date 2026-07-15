<?php
// database/migrations/xxxx_xx_xx_000002_create_flowers_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('flowers', function (Blueprint $table) {
            $table->id();
            $table->string('flower_name');
            $table->decimal('price_per_stem', 10, 2);
            $table->string('image')->nullable(); // simpan path/filename gambar
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('flowers');
    }
};