<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Tabel ini untuk relasi many-to-many antara resep dan item
        Schema::create('item_recipe', function (Blueprint $table) {
            $table->id();
            $table->foreignId('recipe_id')->constrained()->onDelete('cascade');
            $table->foreignId('item_id')->constrained()->onDelete('cascade');
            $table->decimal('quantity_per_portion', 8, 4); // e.g., 0.1500 kg
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('item_recipe');
    }
};
