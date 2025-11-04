<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('departamentos', function (Blueprint $table) {
            $table->increments('idDepa'); // AUTO_INCREMENT y PK
            $table->string('Departamento', 50);
        });

        // Insertar registros iniciales
        DB::table('departamentos')->insert([
            ['idDepa' => 1, 'Departamento' => 'AMAZONAS'],
            ['idDepa' => 2, 'Departamento' => 'ANCASH'],
            ['idDepa' => 3, 'Departamento' => 'APURIMAC'],
            ['idDepa' => 4, 'Departamento' => 'AREQUIPA'],
            ['idDepa' => 5, 'Departamento' => 'AYACUCHO'],
            ['idDepa' => 6, 'Departamento' => 'CAJAMARCA'],
            ['idDepa' => 7, 'Departamento' => 'CALLAO'],
            ['idDepa' => 8, 'Departamento' => 'CUSCO'],
            ['idDepa' => 9, 'Departamento' => 'HUANCAVELICA'],
            ['idDepa' => 10, 'Departamento' => 'HUANUCO'],
            ['idDepa' => 11, 'Departamento' => 'ICA'],
            ['idDepa' => 12, 'Departamento' => 'JUNIN'],
            ['idDepa' => 13, 'Departamento' => 'LA LIBERTAD'],
            ['idDepa' => 14, 'Departamento' => 'LAMBAYEQUE'],
            ['idDepa' => 15, 'Departamento' => 'LIMA'],
            ['idDepa' => 16, 'Departamento' => 'LORETO'],
            ['idDepa' => 17, 'Departamento' => 'MADRE DE DIOS'],
            ['idDepa' => 18, 'Departamento' => 'MOQUEGUA'],
            ['idDepa' => 19, 'Departamento' => 'PASCO'],
            ['idDepa' => 20, 'Departamento' => 'PIURA'],
            ['idDepa' => 21, 'Departamento' => 'PUNO'],
            ['idDepa' => 22, 'Departamento' => 'SAN MARTIN'],
            ['idDepa' => 23, 'Departamento' => 'TACNA'],
            ['idDepa' => 24, 'Departamento' => 'TUMBES'],
            ['idDepa' => 25, 'Departamento' => 'UCAYALI'],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('departamentos');
    }
};
