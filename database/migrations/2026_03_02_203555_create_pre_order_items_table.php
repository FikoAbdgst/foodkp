<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('pre_order_items', function (Blueprint $table) {
            $table->id();

            // Tambahkan 'pre_orders' secara eksplisit
            $table->foreignId('pre_order_id')->constrained('pre_orders')->onDelete('cascade');

            // Tambahkan 'foods' secara eksplisit
            $table->foreignId('food_id')->constrained('foods')->onDelete('cascade');

            $table->integer('quantity');
            $table->integer('price');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pre_order_items');
    }
};
