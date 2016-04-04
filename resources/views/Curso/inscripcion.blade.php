@extends('app')
@section('content')

<style>
.setborder
{
 border: 1px solid black;
}

.alto{height: 40px}


.resetborder{border:none!important;}

.fondo{
	background-color:#A9C4EB;
}

.setInput{
 padding: 5px;
 margin-left: 10px;
}

</style>

<div class="row">


	<div class="col-lg-6 col-lg-offset-4">
		 <a href="{{route('home')}}" style="color:black;display:inline-block">< HOME</a>
		<div style="margin-top:10px;color:white;text-align:center;background-color:#286BCC;padding:5px 0px 5px 0px;border-radius:5px">
          <span style="font-weight:bold;font-size:20px;">Inscripción a Cursos {{$periodoNombre}}</span>
           <a class="aReset" href="{{route('vercalendario')}}" style="float:right;color:white;padding-right:10px;padding-top:5px">Ver Plan</a>
		</div>
		<div style="font-weight:bold;margin-top:5px;">Inscripto de:{{$userLoginWp[0]->display_name}}</div><br>
			
		

	</div>

</div>

      
       <div class="row"><!--begin form-->
						
				<div class="col-lg-offset-4" style="box-sizing:border-box">
					<form style="float:left" >
						<input type="hidden" id="periodoNombre" name="periodoNombre" value="{{$periodoNombre}}" />
							
						       
                     
                                    
									<select class="setInput" name="curso" id="curso" style="width:150px;margin-left:15px">
										 <option id="remove">Cursos</option>

										<?php

                                              foreach ($periodos as  $periodo) {
                                              	
                                               echo "<option value='{$periodo->idPeriodo}'>{$periodo->nombre}</option>";

                                              }


										?>


										
									</select>
								

								
									<input  type="text" class="setInput" style="margin-left:15px;width:90px"  id="fecha" name="fecha" value="Fecha"></input>
								
								
									<input class="setInput" type="email" style="margin-left:15px;width:150px"  placeholder="Email" name="email" id="email" value="" >

									<input class="setInput" type="text" style="margin-left:15px;width:150px"  placeholder="Skype" name="skype" id="skype" >		
					
							

					</form>
				
					
                <button  class="btn btn-default"  id="agregar"  onclick="guardar()" style="width:100px">AGREGAR</button>
             

            </div>
					

     </div><br><!--end form-->



                 <!--begin table-->
 						
       <div class="row">
						
						<div class="col-lg-6 col-lg-offset-4">	

							<table  style="width:100%" id="grilla">
								<thead>
									      <tr style="font-weight:bold;text-decoration:underline">
										  		<td align="center" class="setborder alto fondo">Curso</td>
										 		<td align="center" class="setborder alto fondo">Fecha</td>
										  		<td align="center"class="setborder alto fondo" >Email</td>
										  		<td align="center" class="setborder alto fondo">Role /Distribución</td>
										  		<td align="center" class="setborder alto fondo">Skype</td>
										  		<td></td>
												
										  </tr>
	                               </thead>
								    <tbody>
											
									
											
												

											



								   </tbody>


                                  


							</table>
							


						</div>


		</div>


					<!--end table-->





        <!--begin script-->
<script src="{{ asset('js/jquery.min.js')}}"></script>
  <script src="{{ asset('js/bootstrap.js')}}"></script>
  <script src="{{ asset('js/jquery-ui.js')}}"></script>




<script>
/* uso de jquery autocomplete y ajax para los campos de email*/

$("#email").on('keyup', function(){
									var valor=$(this).val();

									var uwp = {"valor" : valor,};

							         $.ajax({
												                data:  uwp,
												                url:   'listUsersWp',
												                type:  'get',
												               beforeSend: function () {
												                    
												                },
												               success:  function (response) {
															                	
																// console.log(response);
																					         
																$( "#email" ).autocomplete({
													     									source: response
													     								   });

													    									  }
										 }); 


								});//end users list

 


/**/







function guardar(){

	//almacena los alumno iscriptos por get//
	              
				   var curso=$("#curso").val();
				 var email=$("#email").val();
				   var skype=$("#skype").val();
				   var periodoNombre=$('#periodoNombre').val();

			if(email!==''){	  
				 var param = { "curso" : curso,"email" : email,"skype":skype,"periodoNombre":periodoNombre,};




									 $.ajax({
									                data:  param,
									                url:   'storeForm',
									                type:  'get',
									               beforeSend: function () {
									                    
									                },
									               success:  function () {
												                	
												             cargar();
												             $("#email").val(' ');//set val again to empty
												             $("#skype").val(' ');
												                    	
												                    	 }
									        });



                    


				}else{alert("debe ingresar un email")};

				}//en guardar


function  cargar(){
		       $.ajax({
			                data:'',
			                url:   'ajaxLoadGrilla',
			                type:  'get',
			               beforeSend: function () {},
			               
			               success:  function (data) {
						                	
						                console.log(data);

						                

						    $("#grilla").find('tbody').append("<tr id='"+data[0]['idCursoInscripto']+"'><td class='setborder'>"+data[0]["nombre"]+"</td><td class='setborder'>"+data[0]["fecha"]+"</td><td class='setborder'>"+data[0]["email"]+"</td><td class='setborder'>Ninguno</td><td class='setborder'>"+data[0]['skype']+"</td><td><i onclick='eliminar("+data[0]['idCursoInscripto']+")' class='glyphicon glyphicon-trash'></i></td></tr>");
			                    
							}
        			});








}// en cargar


   

//carg la fehca segun la opcion elegida//

$('select#curso').on('change',function(){
										    var valor = $(this).val();
										   
										   var parametros = {"valor" : valor, };
														        $.ajax({
														                data:  parametros,
														                url:   'ajaxFechaCurso',
														                type:  'get',
														               beforeSend: function () {
														                    
														                },
														               success:  function (response) {
																	                	
																		//console.log(response);
																		$("#fecha").find("value").remove();

																		$("#fecha").attr("value",response);


																            							}
														       		 });



										});//end select
						


//elimina de la grilla//



function eliminar(id){

 var parametros= {"id" : id,};
        $.ajax({
                data:  parametros,
                url:   'ajaxDeleteGrilla',
                type:  'get',
               beforeSend: function () {
                    
                },
               success:  function (datos) {
			                	
                           
                $("#"+datos+"").remove();
			     console.log(datos);
			                  
                          					}
       			 });




}


/*begin editar inscriptos

$( ".gridEdit" ).change(function(){

var id=id;
var skype=$(this).val();

alert("hello");
});
/*var parametros= {
               "id" : id,
               "skype":skype,
                
        };
        $.ajax({
                data:  parametros,
                url:   'ajaxEditGrilla',
                type:  'get',
               beforeSend: function () {
                    
                },
               success:  function (datos) {
			                	
                         
			                    console.log(datos);
			                  
                          

		            }
        });*/



/*}*/














</script>


@endsection