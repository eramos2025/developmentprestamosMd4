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
        Schema::create('inversionista_cuentas', function (Blueprint $table) {
            $table->id();
            $table->string('nro_cuenta',25);
            $table->unsignedBigInteger('inversionista_id');
            $table->timestamps();

            $table->foreign('inversionista_id')->references('id')->on('inversionistas')
                ->onUpdate('cascade')
                ->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inversionista_cuentas');
    }
};
