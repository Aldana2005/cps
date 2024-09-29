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
        Schema::create('contractors', function (Blueprint $table) {
            $table->id();
            $table->string('nombres');
            $table->string('numero_cedula')->unique();
            $table->date('fecha_expedicion_cedula');
            $table->enum('tipo_contrato', ['Prestacion de servicios profesionales', 'Prestacion de servicios de apoyo en la gestion']);
            $table->enum('tipo_documento', ['Cedula de ciudadania', 'Tarjeta de identidad', 'Cedula de extranjeria']);
            $table->unsignedBigInteger('dependence_id');
            $table->string('archivo_pdf');
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('dependence_id')
                  ->references('id')->on('dependences')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('contractors');
        Schema::enableForeignKeyConstraints();
    }
};

