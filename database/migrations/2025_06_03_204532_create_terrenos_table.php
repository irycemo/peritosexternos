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
        Schema::create('terrenos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('predio_id')->constrained();
            $table->decimal('superficie', 15,4);
            $table->decimal('demerito', 15,4)->nullable();
            $table->decimal('valor_demeritado', 15,4)->nullable();
            $table->decimal('valor_unitario', 15,4);
            $table->decimal('valor_terreno', 15,4);
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
        Schema::dropIfExists('terrenos');
    }
};
