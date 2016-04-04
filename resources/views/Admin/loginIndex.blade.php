<html>
<head>
<link rel="stylesheet" href="{{URL::asset('css/bootstrap.css')}}">
<link rel="stylesheet" href="{{URL::asset('css/main.css')}}">
</head>

<body>


<div class="row">
				
			<div  class="col-lg-4 col-lg-offset-4 loginForm" style="padding:20px;margin-top:5%;">
				<form id="pepe" action="{{ route('validaUser')}}" method="POST">
					<input type="hidden" name="_token" value="{{ csrf_token() }}">


				  <div class="form-group">
				    <label for="email">Email:</label>
				    <input type="email" class="form-control" name="email" placeholder="Email" required/>
				  </div>
				  <div class="form-group">
				    <label for="pwd">Password:</label>
				    <input type="password" class="form-control" name="password" placeholder="Password" required/>
				  </div>
				  
				  <button type="submit" class="btn btn-default">Ingresar</button>
				 
				
				</form>
			</div>

</div>

<!--script-->

<script scr="{{URL::asset('js/bootstrap.css')}}">





</body>

</html>
