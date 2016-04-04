<?php namespace App\Http\Controllers;

use DB;
use App\CursosInscripto;
use Request;
use Redirect;
use Session;

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

	public function index()
	{    
        /*guarda la session del usuario logeado en wordpress*/
        session_start();
        $idSession=3;//$_SESSION['pg_user_id'];
		Session::put('idSession', $idSession);
         //$i=session::get('idSession');
         //var_dump($i);
        
		return view('Curso.index');
	}










	public function inscripcion()
	{
	
         //obtener  los datos de el  usuario logeado en wordpress de wordpress//

		$idLoginWp=Session::get('idSession');
		$userLoginWp=DB::connection('wordpress')->select("select  * from wp_pg_users as p join wp_users as w on p.wp_user_id=w.id where p.id='{$idLoginWp}'");
		
        //var_dump($wordpres)or die();



        

        //obtengo el ultimo periodo//
        $periodoNombre=DB::select("select periodoNombre from periodos order by periodoNombre desc limit 1");

        $periodoNombre=$periodoNombre[0]->periodoNombre;



		$periodos=DB::select("select * from periodos join cursos on periodos.idCursoF=cursos.idCurso where periodoNombre='{$periodoNombre}'");

		//var_dump($periodos) or die();

		return view('Curso.inscripcion')->with("periodos",$periodos)->with('periodoNombre',$periodoNombre)->with('userLoginWp',$userLoginWp);
	} 



	public function almacena()
	{
        
         $idFacilitador=Session::get('idSession');

		


          $cursos=new CursosInscripto();

          $cursos->idperiodoF=Request::get('curso');
          $cursos->periodoNombre=Request::get('periodoNombre');
          $cursos->idFacilitador=$idFacilitador;//almacenar el id que viene desde wordpress y se recupera de la session//
          $nombreFacilitador=DB::connection('wordpress')->select("select  * from wp_pg_users as p join wp_users as w on p.wp_user_id=w.id where p.id='{$idFacilitador}'"); //obtiene  el nombre del facilitador
          $cursos->nombreFacilitador=$nombreFacilitador[0]->display_name;
          $email=Request::get('email');
          $idEmail=DB::connection('wordpress')->select("select id from wp_users  where user_email='{$email}'");
		  $cursos->idUserInscripto=$idEmail[0]->id;   // procesar  el email almacenar el id  que viene desde el worpres buscar el id en una consulta//
          $cursos->email=$email;
          $cursos->skype=Request::get('skype');
          $cursos->save();

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






/*public function grillaEdit()
{
   $id=Request::get('id');
   $skype=Request::get('skype');
    DB::table('cursos_inscriptos')
	            ->where('idCursoInscripto', $id)
	            ->update(array('skype' => $skype));
	
	
}*/




public function listUsersWp()
{
   /*obtengo la letra para buscar el  email */
  $emailSearch=Request::get('valor');
   
  $userEmailSearch=DB::connection('wordpress')->select(" select user_email from wp_users  where user_email like '%{$emailSearch}%'");
		
  //var_dump($userEmailSearch) or die();
       foreach($userEmailSearch as $userEmail)
       {
       		

       		$ArrayEmail[]=$userEmail->user_email;
       }


   




return  $ArrayEmail;

}














}//end class








