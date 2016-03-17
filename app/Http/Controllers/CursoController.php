<?php namespace App\Http\Controllers;

use DB;
use App\CursosInscripto;
use Request;
use Redirect;

class CursoController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Home Controller
	|--------------------------------------------------------------------------
	|
	| This controller renders your application's "dashboard" for users that
	| are authenticated. Of course, you are free to change or remove the
	| controller as you wish. It is just here to get your app started!
	|
	*/

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	

	/**
	 * Show the application dashboard to the user.
	 *
	 * @return Response
	 */
	public function inscripcion()
	{
		$periodos=DB::select("select * from periodos join cursos on periodos.idCursoF=cursos.idCurso");

		//var_dump($periodos) or die();

		return view('Curso.inscripcion')->with("periodos",$periodos);
	}



	public function almacena()
	{
       
		


          $cursos=new CursosInscripto();

          $cursos->idperiodoF=Request::get('curso');
          $cursos->idUserAlta=1;  //almacenar el id que viene desde wordpress//
		  $cursos->idUserInscripto=1;     // procesar  el email almacenar el id  que viene desde el worpres buscar el id en una consulta//
          
          $cursos->save();

         
          /*devuelve los udarios agregados*/

          //$inscriptos=DB::select("select * from cursos_inscriptos  order by idCursoInscripto desc");

          //var_dump($inscriptos)or die();
          
     

	}


	public function loadGrilla()
	{
    

       $data=DB::select("select * from cursos_inscriptos as c join periodos as p on c.idPeriodoF=p.idPeriodo join cursos on p.idCursoF=cursos.idCurso order by idCursoInscripto desc limit 1");


		return $data;
	}














public function grillaDelete()
{
  
  $id=Request::get('id');

  //var_dump($datos) or die();

  DB::table('cursos_inscriptos')->where('idCursoInscripto', '=', $id)->delete();

 return $id;

}


public function fechaCurso()
{
	 $id=Request::get('valor');

	$response=DB::select("select fecha from periodos where idPeriodo={$id}");
	$fe=$response[0]->fecha;
	$fe=explode('-',$fe);
	$fecha=$fe[2]."/".$fe[1]."/".$fe[0];


	//var_dump($fecha) or die();
	   return $fecha;

}






}//end class








