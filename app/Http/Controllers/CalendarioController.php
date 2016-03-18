<?php namespace App\Http\Controllers;

use DB;
use App\CursosInscripto;
use Request;
use Redirect;
use calendario;
use Session;


class CalendarioController extends Controller {

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
	public function index()
	{
	
          $periodos=DB::select('select * from periodos group by periodoNombre');
		
		//var_dump($periodo) or die();

		return view('Calendario.calendarioIndex')->with('periodos',$periodos);
	}








   public function r()
   {
      //carga todos los eventos de un  periodo a el calendario//

     
        //$periodoNombre='periodo 12';
    

       if(Request::get('periodoNombre')){
      
         $periodoNombre=Request::get('periodoNombre');
        
        }else{ 

               $dato=DB::select("select periodoNombre from periodos group by periodoNombre order by periodoNombre desc");
               $periodoNombre=$dato[0]->periodoNombre;
              }

        //var_dump($periodoNombre)or die();

         

  $cursodescripcions =DB::select("select * from periodos as p join cursos as c  on p.idCursoF=c.idCurso where periodoNombre='{$periodoNombre}'");

             
      

    



         foreach($cursodescripcions as $curso)
              {
                  $destinadoA=$curso->destinado;
                  $nombreCurso=$curso->nombre;
                  $desCurso=$curso->desCorto;
                  $descripcion=$curso->descripcion;

                  $fecha=$curso->fecha;
                 

                $array2[]=array( "destinadoA"=>$destinadoA,"nombreCurso"=>$nombreCurso,"desCurso"=>$desCurso,"descripcion"=>$descripcion,"fechaI"=>$fecha,"fehcaE"=>$fecha);//obtiene  el nombre del curso
              }



         



          
           

       $json=$array2;

         //var_dump($json) or die();


      return $json;
    















   }














}//end class








