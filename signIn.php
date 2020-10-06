<?php 
    session_start();
    if ($_SESSION) {
        header("Location: app/principal.php");
    }
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>PQRS App</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">	
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="css/style_owner.css">
	<style type="text/css">

		#sending {
			display: none;
		}

		#reject {
			display: none;
		}

	</style>
</head>
<body class="body">
	
	<div class="container well" id="sha">
		<div class="row">
			<div class="col-sm-12">
				<h3 class="pt-3 text-center font-weight-bold text-secondary">PQRS App</h3>
			</div>
		</div> 

		<form class="customized-form" action="#" method="POST">
				<div class="form-group">
					<input type="text" class="form-control" placeholder="Usuario" id="username" autocomplete="off" required>
				</div>
				

				<div class="form-group">
					<input type="password" class="form-control" placeholder="Contraseña" id="pass" required>
				</div>

				<div class="alert alert-info" id="sending" role="alert">
					<i class="fa fa-spinner girar" style="font-size: 120%"></i> Iniciando sesión...
				</div>

				<div class="alert alert-danger" id="reject" role="alert"></div>

				<input id="btnSignIn" type="submit" value="Acceder" class="btn btn-secondary btn-block" />

	    </form>

		<div class="pt-3 pb-3">
			<button id="btnGoToSignUp" class="btn btn-outline-success btn-block">Crear cuenta nueva</button>
		</div>
		
	</div>

	<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
	<script src="js/signIn.js"></script>
</body>
</html>