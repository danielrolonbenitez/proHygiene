@extends('app')
@section('content')

<style>
.setborder
{
 border: 1px solid black;
}

.alto{height: 40px}


.resetborder{border:none!important;}


</style>

<div class="row">


	<div class="col-lg-6 col-lg-offset-4">
		 <a href="{{route('home')}}" style="color:black;display:inline-block">< HOME</a>
		<div style="margin-top:10px;color:white;text-align:center;background-color:blue;padding:5px 0px 5px 0px;border-radius:5px">
          <span style="font-weight:bold;font-size:20px">Inscripción a Cursos Periodo 12</span>
           <a class="aReset" style="float:right;color:white;padding-right:10px;padding-top:5px">Ver Plan</a>
		</div>
		<div style="font-weight:bold;margin-top:5px;">Inscripto de:Pablo killian</div><br>
			
		

	</div>

</div>

      
       <div class="row"><!--begin form-->
						
			<div class="col-lg-6 col-lg-offset-4">	
					<form  class="form-inline" style="float:left" >
						<!--input type="hidden" name="_token" value="{{ csrf_token() }}" /-->

						        <div class="form-group">

                                     
									<select class="form-control" name="curso" id="curso"  style="width:125px">
										 <option id="remove">Cursos</option>

										<?php

                                              foreach ($periodos as  $periodo) {
                                              	
                                               echo "<option value='{$periodo->idPeriodo}'>{$periodo->nombre}</option>";

                                              }


										?>


										
									</select>



									<input  type="text" class="form-control" style="width:100px" id="fecha" name="fecha" value="Fecha"></input>

									<input class="form-control" type="email" placeholder="Email" name="email" id="email" style="width:280px" />
									
								</div>

					</form>
					<button  class="btn btn-default" style="width:150px;" id="agregar"  onclick="guardar()">AGREGAR</button>
                 
             </div>


					

     </div><br><!--end form-->



                 <!--begin table-->
 						
       <div class="row">
						
						<div class="col-lg-6 col-lg-offset-4">	

							<table  style="width:100%" id="grilla">
								<thead>
									      <tr>
										  		<td align="center" class="setborder alto">Curso</td>
										 		<td align="center" class="setborder alto">Fecha</td>
										  		<td align="center"class="setborder alto" >Email</td>
										  		<td align="center" class="setborder alto">Role /Distribución</td>
										  		<td align="center" class="setborder alto">Skype</td>
										  		<td></td>
												
										  </tr>
	                               </thead>
								    <tbody>
											
									
											
												

											



								   </tbody>


                                  


							</table>
							


						</div>


		</div>


					<!--end table-->


<script>

function guardar(){

	//almacena los alumno iscriptos por get//
  var curso=$("#curso").val();

 

	var param = {
               "curso" : curso,
                
        };




					 $.ajax({
					                data:  param,
					                url:   'storeForm',
					                type:  'get',
					               beforeSend: function () {
					                    
					                },
					               success:  function () {
								                	
								             
								                    


							          }
					        });


 setTimeout ("cargar()", 200); 

}//en guardar


function  cargar(){
		       $.ajax({
			                data:'',
			                url:   'ajaxLoadGrilla',
			                type:  'get',
			               beforeSend: function () {},
			               
			               success:  function (data) {
						                	
						                console.log(data);

						                

						    $("#grilla").find('tbody').append("<tr id='"+data[0]['idCursoInscripto']+"'><td class='setborder'><input type='text' class='resetborder' value='"+data[0]["nombre"]+"'/></td><td class='setborder'>"+data[0]["fecha"]+"</td><td class='setborder'>dad@hotmail.com</td><td class='setborder'>admin</td><td class='setborder'>skype</td><td><i onclick='eliminar("+data[0]['idCursoInscripto']+")' class='glyphicon glyphicon-trash'></i></td></tr>");
			                    
							}
        			});








}// en cargar


   

//carg la fehca segun la opcion elegida//

$('select#curso').on('change',function(){
   
//$('#curso').find('#remove').remove().end();//remuevo el placeholder//
 
   var valor = $(this).val();
   
   

//alert("hello");


       var parametros = {
               "valor" : valor,
                
        };
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



//var id=id;

//alert(id);

      
 var parametros= {
               "id" : id,
                
        };
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














</script>


@endsection