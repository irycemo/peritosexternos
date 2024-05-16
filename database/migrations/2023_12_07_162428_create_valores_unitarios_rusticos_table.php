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
        Schema::create('valores_unitarios_rusticos', function (Blueprint $table) {
            $table->id();
            $table->string('concepto');
            $table->unsignedDecimal('valor', 10, 2);
            $table->unsignedDecimal('valor_aterior', 10, 2)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('valores_unitarios_rusticos');
    }
};
