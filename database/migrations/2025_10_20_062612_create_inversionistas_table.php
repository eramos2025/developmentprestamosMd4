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
        Schema::create('inversionistas', function (Blueprint $table) {
            $table->id();

            $table->string('nro_documento',20)->unique();
            $table->string('nombre',200);
            $table->string('apellido',200);
            $table->string('estado_civil',20)->nullable();
            $table->string('email',200);
            $table->string('telefono',20);
            $table->string('telefono_ref',20)->nullable();
            $table->text('direccion');
            //$table->string('pais',100)->nullable();
            $table->string('departamento',100)->nullable(); // x configurar el seeder
            $table->string('provincia',100)->nullable();    // x configurar el seeder
            $table->string('distrito',100)->nullable();     // x configurar el seeder
            //$table->string('codigo_postal',10)->nullable(); // x configurar el seeder
            $table->string('nro_cuenta_principal',20)->nullable();    // x configurar
            //$table->text('ocupacion')->nullable();                  // x configurar el seeder
            $table->decimal('monto_inversion',10,2)->nullable(); // x configurar
            $table->text('comentarios')->nullable();                // x configurar
            $table->text('foto')->nullable();                   
            $table->text('adjuntos')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inversionistas');
    }
};
