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
        Schema::create('condominiocontruccions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('predio_id')->constrained();
            $table->unsignedDecimal('area_comun_construccion', 15, 4)->nullable();
            $table->unsignedDecimal('indiviso_construccion', 15, 4)->nullable();
            $table->unsignedDecimal('valor_clasificacion_construccion', 15, 4)->nullable();
            $table->unsignedDecimal('valor_construccion_comun', 15, 4)->nullable();
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
        Schema::dropIfExists('condominiocontruccions');
    }
};
