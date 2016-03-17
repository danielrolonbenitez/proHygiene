@extends('app')
@section('content')

<link rel="stylesheet" href="{{ asset('css/fullcalendar.css')}}">


<script src="{{ asset('js/moment.min.js')}}"></script>


<script src="{{ asset('js/fullcalendar.min.js')}}"></script>
<script src="{{ asset('js/es.js')}}"></script>





<div class="row">

		  <!-- Carousel -->
    <div id="myCarousel" class="carousel slide col-lg-offset-2" data-ride="carousel" style="max-width:700px;box-sizing:border-box;background-color:blue;text-aling:center"  data-interval="false">
    <!-- Indicators -->
           <div class="carousel-inner">
        <!-- Slider 1 -->
       
       
        <!-- Slider 2 -->

       <?php foreach($periodos as $periodo){

         	$array[]=$periodo->periodoNombre;//guardo todos los peridodos  para quitar el ultimo array luego;
           	$activo=$periodo->periodoNombre;//guarda el perdiodo que estara activo en el slider

          
          }
              
			 array_pop($array);//quito la ultimo elemento del array//   
			

             //var_dump($array)or die();
          
             foreach($array as $a){ //recorro todos  los elementos menos el ultimo que lo tengo en activo
            	echo "<div class='item' style='text-align:center;color:white;font-size:20px'>";

                echo"<span>".$a."</span>";

				echo"</div>";
             }
           ?>

			<div class="item active" style='text-align:center;color:white;font-size:20px'>
            <span><?php echo $activo; ?></span>
          
         	 </div>






     
      
          </div>
      <a class="left carousel-control" href="#myCarousel" data-slide="prev" onclick="presione()"><span class="glyphicon glyphicon-chevron-left"></span></a>
      <a class="right carousel-control" href="#myCarousel" data-slide="next" onclick="presione()"><span class="glyphicon glyphicon-chevron-right"></span></a>
    </div>      
    
    <!-- /.Carousel -->

</div><!--end row-->









       <div class="row">
       	    <div class="col-lg-offset-2">
	        	<a href="{{route('home')}}" style="color:black">< HOME</a>
			</div>
       </div>

		<div class="row">

			 	<div id='calendar' class="col-lg-offset-2 col-lg-6" ></div>
			 	


		</div>
	         

	         <div class="row" style="margin-top:30px">
					

					<div  class="col-lg-offset-5 "> <a class="btn btn-default" href="{{route('inscripcion')}}">INSCRIPCIÓN</a></div>
	         </div>



<script src="{{ asset('js/calendar.js')}}"></script>



<!--script envia por ajax el valor que tiene la caja -->


<!--script envia por ajax el valor que tiene la caja -->
<script>
  
 var param=$('.active').find('span').html();


function presione(){

  //almacena los alumno iscriptos por get//

  param=$('.active').find('span').html();


  
       var parametros = {
               "periodoNombre" : param,
                
        };
        $.ajax({
                data:  parametros,
                url:   'r',
                type:  'get',
               beforeSend: function () {
                    
                },
               success:  function (response) {
                        
             
                         



                       

                }
        });

  //alert("hola"+param);

 




}//en pesione





 //envia el  valor del parametro cuando se carga la pagina//

 var parametros = {
               "periodoNombre" : param,
                
        };



  $.ajax({
                data:  parametros,
                url:   'r',
                type:  'get',
               beforeSend: function () {
                    
                },
               success:  function (response) {
                        
                          console.log(response+"nome");

                           





                       

                }
        });








//carga fomulario//





</script>








@endsection