<?php
  ob_start();
  session_start();
?>
<!DOCTYPE html>
<html>
	<head>
	
		<?php include "header.php";?>
	   
	</head> 
	 
	<body>

		<div class="group container">
			<header>
				<?php
					session_start();
					//$cad = "Bienvenido Usuario ".$_SESSION['nomuser'].$_SESSION['grpuser'];
					include "bienvenido.php";
				?>  
				
			</header>

			<form action="registro_cuadrilla.php" method="POST">         
				<h3>Registro de <span class="label label-default">Cuadrilla</span></h3>
				<div class="row">
					<div class="col-md-6 col-md-offset-3">
					<label for="Nit">Codigo</label>
					<input type="text" name="codigo" class="form-control" required>
					</div>
				</div>

				<div class="row">
				  <div class="col-md-6 col-md-offset-3">
					  <label for="Nombre">Nombre</label>
					  <input type="text" name="nombre" class="form-control" required>
					</div>
				</div>

				<br>

				<div class="row">
				  	<div class="col-md-6 col-md-offset-3 text-center">
					<input class="btn btn-success" name="submit" type="submit" value="Registrar" />
				  	<input class="btn btn-default" onClick="window.location.href='entro.php'" name="submit" type="button" value="Volver">
					</div>
				</div>         
		  	</form>
		</div>
	</body>
</html>