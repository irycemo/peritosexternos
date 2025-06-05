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
        Schema::create('umas', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('año')->unique();
            $table->decimal('diario', 15,2);
            $table->decimal('mensual', 15,2);
            $table->decimal('anual', 15,2);
            $table->decimal('minimo_rustico', 15,2)->nullable();
            $table->decimal('minimo_urbano', 15,2)->nullable();
            $table->foreignId('creado_por')->nullable()->references('id')->on('users');
            $table->foreignId('actualizado_por')->nullable()->references('id')->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('umas');
    }
};
