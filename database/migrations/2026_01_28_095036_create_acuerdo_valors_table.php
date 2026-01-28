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
        Schema::create('acuerdo_valors', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('año')->nullable();
            $table->string('folio')->nullable();
            $table->string('municipio')->nullable();
            $table->string('localidad')->nullable();
            $table->string('nombre_asentamiento')->nullable();
            $table->mediumText('calles')->nullable();
            $table->decimal('valor_inicial', 8,2)->nullable();
            $table->decimal('valor_actualizado', 8,2)->nullable();
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
        Schema::dropIfExists('acuerdo_valors');
    }
};
