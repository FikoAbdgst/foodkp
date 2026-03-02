<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('foods', function (Blueprint $table) {
            // Field ini menyimpan berapa hari makanan bertahan (opsional jika ada makanan yg tidak bisa basi)
            $table->integer('masa_tahan_hari')->nullable()->after('stok');
            // Field boolean default false
            $table->boolean('is_expired')->default(false)->after('masa_tahan_hari');
        });
    }

    public function down(): void
    {
        Schema::table('foods', function (Blueprint $table) {
            $table->dropColumn(['masa_tahan_hari', 'is_expired']);
        });
    }
};
