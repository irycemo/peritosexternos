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
        Schema::table('construccion_comuns', function (Blueprint $table) {
            $table->string('tipo')->after('valor_construccion_comun');
            $table->string('uso')->after('valor_construccion_comun');
            $table->string('estado')->after('valor_construccion_comun');
            $table->string('calidad')->after('valor_construccion_comun');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('construccion_comuns', function (Blueprint $table) {
            //
        });
    }
};
