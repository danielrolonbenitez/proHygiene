<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/',['as'=>'home',function(){

	return view('Curso.index');
}]);

route::get('/inscripcion',['as'=>'inscripcion','uses'=>'CursoController@inscripcion']);



//ver calendario//

route::get('/calendario',['as'=>'vercalendario','uses'=>'CalendarioController@index']);











//carga las fechas que le corresponde a cada curso//

route::get('ajaxFechaCurso','CursoController@fechaCurso');

//alamacena las inscripciones//

route::get('storeForm','CursoController@almacena');




//carga la grilla//
route::get('ajaxLoadGrilla','CursoController@loadGrilla');


//elimina de la grilla por ajax//



route::get('ajaxDeleteGrilla','CursoController@grillaDelete');


//carga todos los eventos mediante  json a el calendario//

route::get('/loadEvent','CalendarioController@cargarEvento');

route::get('/r','CalendarioController@r');



// editar grilla inscripcion//
route::get('ajaxEditGrilla','CursoController@grillaEdit');


