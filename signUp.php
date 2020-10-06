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

        #inconsistency {
			display: none;
        }
        
        #success {
			display: none;
		}

	</style>
</head>
<body class="body">
	
	<div class="container well" id="sha">
		<div class="row">
			<div class="col-sm-12">
				<h3 class="pt-3 text-center font-weight-bold text-secondary">Registro de Usuario</h3>
			</div>
		</div> 

		<form class="customized-form" action="" method="POST">
				<div class="form-group">
                    <span class="text-secondary font-weight-bold">Nombre completo:</span>
					<input type="text" class="form-control" placeholder="Escriba su nombre completo..." id="fullname" autocomplete="off" required>
				</div>
				<div class="form-group">
                    <span class="text-secondary font-weight-bold">Usuario:</span>
					<input type="text" class="form-control" placeholder="Escriba un usuario..." id="username" autocomplete="off" required>
				</div>
                <div class="form-group">
                    <span class="text-secondary font-weight-bold">Contraseña:</span>
					<input type="password" class="form-control" placeholder="Escriba una contraseña..." id="pass" autocomplete="off" required>
				</div>
                <div class="form-group">
                    <span class="text-secondary font-weight-bold">Confirmar contraseña:</span>
					<input type="password" class="form-control" placeholder="Confirmar la contraseña..." id="pass_confirmation" autocomplete="off" required>
				</div>

				<div class="alert alert-primary" id="sending" role="alert">
                    <i class="fa fa-spinner girar" style="font-size: 120%"></i> Registrando cuenta de usuario...
                </div>

                <div class="alert alert-danger" id="reject" role="alert"></div>

                <div class="alert alert-warning" id="inconsistency" role="alert">Las contraseña no coinciden</div>

                <div class="alert alert-success" id="success" role="alert">
                    <i class="fa fa-check" style="font-size: 120%"></i> Usuario creado con éxito
                </div>

				<input id="btnSignUp" type="submit" value="Crear cuenta" class="btn btn-success btn-block" />

	    </form>

        <div id="btnGoToSignIn" class="pb-3 text-center">
            <a href="signIn">Iniciar sesión</a>
        </div>
		
	</div>

	<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
	<script src="js/signUp.js"></script>
</body>
</html>