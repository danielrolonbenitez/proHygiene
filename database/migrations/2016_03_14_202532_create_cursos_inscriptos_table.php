<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCursosInscriptosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
			


			Schema::create('cursos_inscriptos', function(Blueprint $table)
		{
			$table->increments('idCursoInscripto');
			$table->integer('idPeriodoF');
			$table->integer('idUserAlta');
			$table->integer('idUserInscripto');
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
		//
	}

}
