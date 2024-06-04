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
            $table->unsignedDecimal('superficie', 10, 4);
            $table->unsignedDecimal('demerito', 10, 4)->nullable();
            $table->unsignedDecimal('valor_demeritado', 10, 4)->nullable();
            $table->unsignedDecimal('valor_unitario', 10, 4);
            $table->unsignedDecimal('valor_terreno', 10, 4);
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
