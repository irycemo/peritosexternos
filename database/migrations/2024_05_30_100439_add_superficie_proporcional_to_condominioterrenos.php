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
        Schema::table('condominioterrenos', function (Blueprint $table) {
            $table->unsignedDecimal('superficie_proporcional', 10, 2)->nullable()->after('indiviso_terreno');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('condominioterrenos', function (Blueprint $table) {
            //
        });
    }
};
