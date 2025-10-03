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
        Schema::create('firma_electronicas', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid');
            $table->string('estado');
            $table->foreignId('avaluo_id')->constrained();
            $table->mediumText('cadena_original');
            $table->text('cadena_encriptada')->nullable();
            $table->text('observaciones')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('firma_electronicas');
    }
};
