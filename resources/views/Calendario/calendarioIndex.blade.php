@extends('app')
@section('content')
<link rel="stylesheet" href="{{ asset('css/fullcalendar.css')}}">




  <div class="row">
            <div class="col-lg-offset-2">
            <a href="{{route('home')}}" style="color:black">< HOME</a>
      </div>
       </div>



<div class="row">

		  <!-- Carousel -->
    <div id="myCarousel" class="carousel slide col-lg-offset-2" data-ride="carousel" style="max-width:700px;box-sizing:border-box;background-color:blue;text-aling:center;border-radius:5px 0px 5px 0px"  data-interval="false">
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



           
            echo'<div class="item active" style="text-align:center;color:white;font-size:20px">
            <span>'.$activo.'</span></div>';







          
             foreach($array as $a){ //recorro todos  los elementos menos el ultimo que lo tengo en activo
            	echo "<div class='item' style='text-align:center;color:white;font-size:20px'>";

                echo"<span>".$a."</span>";

				echo"</div>";
             }




           ?>







     
      
          </div>
      <a class="left carousel-control" href="#myCarousel" data-slide="prev" onclick="presione()"><span class="glyphicon glyphicon-chevron-left"></span></a>
      <a class="right carousel-control" href="#myCarousel" data-slide="next" onclick="presione()"><span class="glyphicon glyphicon-chevron-right"></span></a>
    </div>      
    
    <!-- /.Carousel -->

</div><!--end row-->









     
		<div class="row">

			 	<div id='calendar' class="col-lg-offset-2 col-lg-6" ></div>
        

		</div>
	         

	         <div class="row" style="margin-top:30px">
					

					<div  class="col-lg-offset-5 "> <a class="btn btn-default" href="{{route('inscripcion')}}">INSCRIPCIÓN</a></div>
	         </div>

@endsection






<!--script envia por ajax el valor que tiene la caja -->
<script src="{{ asset('js/jquery.min.js')}}"></script>
  <script src="{{ asset('js/bootstrap.js')}}"></script>
<script src="{{ asset('js/moment.min.js')}}"></script>
<script src="{{ asset('js/fullcalendar.min.js')}}"></script>
<script src="{{ asset('js/es.js')}}"></script>

<!--script envia por ajax el valor que tiene la caja -->
<script>




    
$(document).ready(function(){
     $date = new Date();
    $d = $date.getDate();
   $m = $date.getMonth()+1;
    $y = $date.getFullYear();
    $fecha=$y+"-"+$m+"-"+$d;

   
     $.ajax({
                
                url:   'r',
                type:  'get',
               beforeSend: function () {
                    
                },
               success:  function (response) {
                        
              

                         
                
         $('#calendar').fullCalendar("removeEvents");   



          $('#calendar').fullCalendar({
      defaultDate: $fecha,
      editable: false,
      eventLimit: true, // allow "more" link when too many events
      lang: 'es',
      eventOrder: 'id',

       eventClick: function(calEvent, jsEvent, view) {
        console.log(calEvent.descripcion);
        }
      
   
          });//end calendar//


      var cant=response.length;

           var events=[];
            var i;

            for(i=0;i<cant;i++){

             events.push({
                        title: response[i]['destinadoA']+"\n" + response[i]['nombreCurso']+"\n"+response[i]['desCurso'],
                        start: response[i]['fechaI'],
                        end: response[i]['fechaE'], // will be parsed
                        descripcion:response[i]['descripcion']
                    });

                }





           $('#calendar').fullCalendar('addEventSource', events);  
         //$('#calendar').fullCalendar('refetchEvents');
         

   






                       

                }//en succes
        


        });//en ajax












});//end document//


 





var param;
var b=0;
function presione(){//crea una bandera  para obtener el  texto del siguente html()//;

if(b==0){
  param=$(".active").closest('div').next().find('span').html();
b=1;
}else{param=$(".active").closest('div').prev().find('span').html(); b=0;}
 


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
                        
             
                         
                console.log(response);
         $('#calendar').fullCalendar("removeEvents");        
         $('#calendar').fullCalendar('addEventSource', response);      
         //$('#calendar').fullCalendar('refetchEvents');

                       

                }
        });

  }//end function presione;











</script>


