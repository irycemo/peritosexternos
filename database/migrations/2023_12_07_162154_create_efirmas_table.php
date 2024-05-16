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
        Schema::create('efirmas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->datetime('vigencia');
            $table->string('estado');
            $table->string('pem_privada');
            $table->string('pem_publica');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('efirmas');
    }
};
