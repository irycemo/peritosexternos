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
        Schema::create('valor_unitario_construccions', function (Blueprint $table) {
            $table->id();
            $table->unsignedTinyInteger('tipo');
            $table->unsignedTinyInteger('uso');
            $table->unsignedTinyInteger('calidad');
            $table->unsignedTinyInteger('estado');
            $table->decimal('valor', 10, 2);
            $table->decimal('valor_aterior', 10, 2)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('valor_unitario_construccions');
    }
};
