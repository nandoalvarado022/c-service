<?php
session_start();?>
<!DOCTYPE html>
<html lang="es">
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<?php include "header.php";?>
	</head>
	<body id="inicio_session">
		<div class="container">
			<form action="valida_entrada.php" method="post">
				<div class="row">
					<div class="col-md-4"></div>
					<div class="col-md-4 text-center"><img src="images/login.png" class="icon-login"></div>
					<div class="col-md-4"></div>
				</div>
				<div class="row">
					<div class="col-md-4"></div>
					<div class="col-md-4">
						<input type="number" class="form-control" name="usuario" size ="1" autofocus="true" required maxlenght="3" placeholder="Codigo de usuario" title="Digite El Codigo Del Usuario"  />
					</div>
					<div class="col-md-4"></div>
				</div>				

				<div class="row">
					<div class="col-md-4"></div>				
					<div class="col-md-4">
						<input class="form-control" type="password" name="password" size="8" placeholder="Contraseña" />
					</div>
					<div class="col-md-4"></div>				
				</div>

				<div class="row">
					<div class="col-md-4"></div>
					<div class="col-md-4 text-center">
						
						<?php print isset($_GET["error"]) ? '<div class="row"><div class="col-xs-1"></div>
						<div class="col-md-12 col-xs-10 text-center alert alert-warning" role="alert">'.$_GET["error"].'</div><div class="col-xs-1"></div>' : "" ;?>
						<input class="btn btn-success" name="submit" type="submit" value="Ingresar">
						<button type="button" class="btn btn-default">Salir</button>
						
					</div>
					<div class="col-md-4"></div>
				</div>
			</form>
			
			


		</div>

		<style>
		input::-webkit-outer-spin-button,
		input::-webkit-inner-spin-button {
		    /* display: none; <- Crashes Chrome on hover */
		    -webkit-appearance: none;
		    margin: 0; /* <-- Apparently some margin are still there even though it's hidden */
		}
		</style>
	</body>
</html>