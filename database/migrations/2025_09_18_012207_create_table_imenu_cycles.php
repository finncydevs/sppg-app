<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('menu_cycles', function (Blueprint $table) {
            $table->id();
            $table->date('menu_date')->unique(); // Hanya boleh ada 1 menu per tanggal
            $table->foreignId('recipe_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('menu_cycles');
    }
};
