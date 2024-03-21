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
        Schema::create('series', function (Blueprint $table) {
            $table->id();
            $table->string('ids');
            $table->string('name');
            $table->foreignId('seccion_id')->constrained('seccions')->cascadeOnDelete();
            $table->boolean('administrativo');
            $table->boolean('contable_fiscal');
            $table->boolean('legal');
            $table->integer('tramite');
            $table->integer('concentracion');
            $table->boolean('historico');
            $table->boolean('publico');
            $table->boolean('reservado');
            $table->boolean('confidencial');
            $table->boolean('baja');
            $table->boolean('permanente');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('series');
    }
};
