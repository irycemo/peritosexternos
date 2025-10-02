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
        Schema::create('bloques', function (Blueprint $table) {
            $table->id();
            $table->foreignId('avaluo_id')->constrained();
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
            $table->string('uso')->nullable();
            $table->text('observaciones')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bloques');
    }
};
