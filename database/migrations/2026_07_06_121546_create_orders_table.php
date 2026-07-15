<?php
// database/migrations/xxxx_xx_xx_000004_create_orders_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();

            // Nullable dulu karena fitur login/auth belum dibangun di tahap ini.
            // Begitu sistem login sudah jadi, kolom ini diisi dari Auth::id().
            $table->foreignId('user_id')
                  ->nullable()
                  ->constrained('users')
                  ->onDelete('set null');

            $table->foreignId('wrapper_id')
                  ->constrained('wrappers')
                  ->onDelete('restrict');

            $table->text('greeting_card_text')->nullable();
            $table->decimal('total_price', 10, 2);
            $table->enum('status', ['pending', 'processing', 'completed'])->default('pending');
            $table->string('payment_proof')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};