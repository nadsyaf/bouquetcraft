<?php
// database/migrations/xxxx_xx_xx_000003_create_wrappers_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('wrappers', function (Blueprint $table) {
            $table->id();
            $table->string('wrapper_color');
            $table->decimal('price', 10, 2);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('wrappers');
    }
};