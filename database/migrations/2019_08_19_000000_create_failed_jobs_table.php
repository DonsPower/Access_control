<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFailedJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alumnos', function (Blueprint $table) {
            $table->id();
            $table->string('Nombre',40);
            $table->string('ApellidoP',40);
            $table->string('ApellidoM',40);
            $table->string('ProgramaAcademico',40);
            $table->string('Boleta',15);
            $table->string('TelefonoMovil',10);
            $table->string('TelefonoFijo',10);
            $table->string('TelefonoPersonal',10);
            $table->string('Correo',40);
            $table->string('NSS',15);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('failed_jobs');
    }
}
