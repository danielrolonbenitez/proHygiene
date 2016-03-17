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




    public function cargarEvento(){

           
         $value=Session::get('key');

          return  $value;
    }






   public function r()
   {
      //carga todos los eventos de un  periodo a el calendario//

     
        //$periodoNombre='periodo 12';

      $periodoNombre=Request::get('periodoNombre');

        //var_dump($periodoNombre)or die();

         

    $destinados=DB::select("select  destinado, fecha from  periodos where periodoNombre='{$periodoNombre}'");

  $cursodescripcions =DB::select("select nombre, desCorto, fecha from periodos as p join cursos as c  on p.idCursoF=c.idCurso where periodoNombre='{$periodoNombre}'");

             
      


              foreach($destinados as $key=>$destino)
              {
                  
                  $nombre=$destino->destinado;
                  $fecha=$destino->fecha;
                 

              
      
                    $array1[]=array("title"=>$nombre,"start"=>$fecha,"end"=>$fecha);
                  

              }

     










         foreach($cursodescripcions as $curso)
              {
                  
                  $nombre=$curso->nombre;
                  $desc=$curso->desCorto;


                  $fecha=$curso->fecha;
                 

                $array2[]=array("title"=>$nombre,"description"=>"This is a cool event","start"=>$fecha,"end"=>$fecha);
              }



         

          
           

       $json=array_merge($array1,$array2);

         //var_dump($json) or die();

      
         Session::put('key',$json);

      return $json;
       
   }














}//end class








