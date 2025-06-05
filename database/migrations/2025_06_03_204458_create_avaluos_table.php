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
        Schema::create('avaluos', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid');
            $table->foreignId('predio_id')->constrained();
            $table->unsignedInteger('año');
            $table->unsignedInteger('folio');
            $table->unsignedInteger('usuario');
            $table->string('estado');
            $table->string('clasificacion_zona')->nullable();
            $table->string('construccion_dominante')->nullable();
            $table->boolean('agua')->default(0);
            $table->boolean('drenaje')->default(0);
            $table->boolean('pavimento')->default(0);
            $table->boolean('energia_electrica')->default(0);
            $table->boolean('alumbrado_publico')->default(0);
            $table->boolean('banqueta')->default(0);
            $table->string('cimentacion')->nullable();
            $table->string('estructura')->nullable();
            $table->string('muros')->nullable();
            $table->string('entrepiso')->nullable();
            $table->string('techo')->nullable();
            $table->string('plafones')->nullable();
            $table->string('vidrieria')->nullable();
            $table->string('lambrines')->nullable();
            $table->string('pisos')->nullable();
            $table->string('herreria')->nullable();
            $table->string('pintura')->nullable();
            $table->string('carpinteria')->nullable();
            $table->string('recubrimiento_especial')->nullable();
            $table->string('aplanados')->nullable();
            $table->string('hidraulica')->nullable();
            $table->string('sanitaria')->nullable();
            $table->string('electrica')->nullable();
            $table->string('gas')->nullable();
            $table->string('especiales')->nullable();
            $table->boolean('como_urbano')->default(0);
            $table->text('observaciones')->nullable();
            $table->date('impreso_en')->nullable();
            $table->foreignId('creado_por')->nullable()->references('id')->on('users');
            $table->foreignId('actualizado_por')->nullable()->references('id')->on('users');
            $table->timestamps();

            $table->unique(['año', 'folio', 'usuario']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('avaluos');
    }
};
