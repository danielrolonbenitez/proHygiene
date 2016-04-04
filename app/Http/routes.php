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


/*acceso a el panel de administracion*/
Route::get('/admin',['as'=>'login','uses'=>'AdminController@index']);

Route::post('/validaUser',['as'=>'validaUser','uses'=>'AdminController@validaUser']);

Route::get('/panel',['as'=>'panel','uses'=>'AdminController@panel']);

Route::get('logout','Auth\AuthController@getLogout');


Route::group(['middleware' => 'auth'], function()
{

Route::get('/pantillaExcel',['as'=>'plantillaExcel','uses'=>'AdminController@plantillaExcel']);

});

/**/








Route::get('/',['as'=>'home','uses'=>'CursoController@index']);

Route::get('/inscripcion',['as'=>'inscripcion','uses'=>'CursoController@inscripcion']);



//ver calendario//

Route::get('/calendario',['as'=>'vercalendario','uses'=>'CalendarioController@index']);











//carga las fechas que le corresponde a cada curso//

Route::get('ajaxFechaCurso','CursoController@fechaCurso');

//alamacena las inscripciones//

Route::get('storeForm','CursoController@almacena');




//carga la grilla//
route::get('ajaxLoadGrilla','CursoController@loadGrilla');


//elimina de la grilla por ajax//



route::get('ajaxDeleteGrilla','CursoController@grillaDelete');


//carga todos los eventos mediante  json a el calendario//

route::get('/loadEvent','CalendarioController@cargarEvento');

route::get('/r','CalendarioController@r');



// editar grilla inscripcion//
//route::get('ajaxEditGrilla','CursoController@grillaEdit');


//completa los email de usuarios//
route::get('listUsersWp','CursoController@listUsersWp');