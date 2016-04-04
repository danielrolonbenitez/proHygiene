<?php namespace App\Http\Controllers;

use DB;
use App\CursosInscripto;
use Request;
use Redirect;
use Session;
use Auth;

class AdminController extends Controller {

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
        
        
		return view('Admin.loginIndex');
	}



   public function validaUser()
   {
   			 $email = Request::input('email');
        	$password = Request::input('password');

	
			  if (Auth::attempt(array('email' => $email, 'password' => $password)))
        {            
            
            
                return redirect::route('panel');
                        
 
		}else {  return "no validado";}

   }

    


   public function panel()
   {
   		
     return view('Admin.panel');
   }


 public function plantillaExcel()
 {
  
 //debido a que en la tabla cursos_isncripto se guardan todos los peridos  hacemos una consulta para obrener el id del ultimo periodo//

$lastPeriodoNombre=DB::select("select periodoNombre from cursos_inscriptos group by periodoNombre order By periodoNombre desc");

$lastPeriodoNombre=$lastPeriodoNombre[0]->periodoNombre;


 $data=DB::select("select * from cursos_inscriptos as c join periodos as p  on  c.idPeriodoF=p.idPeriodo   join cursos on cursos.idCurso=p.idCursoF    where c.periodoNombre='{$lastPeriodoNombre}'");

//var_dump($data) or die();
return view('Admin.plantillaExcel')->with('data',$data);
 }






}//end class








