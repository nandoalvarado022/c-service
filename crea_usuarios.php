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
		<div class="container">
			<header>
				<?php
					session_start();
					//$cad = "Bienvenido Usuario ".$_SESSION['nomuser'].$_SESSION['grpuser'];
					include "bienvenido.php";
				?>  
				
			</header>
			<div class="group container">
				<form action="registro_usuarios.php" method="POST">         
						<h3>Registro de <span class="label label-default">Coordinador</span></h3>
						<div class="row">
						<div class="col-md-6 col-md-offset-3">
							<label for="Nit">Codigo</label>
								<input type="number" name="codigo" placeholder="Digite codigo del nuevo usuario Coordinador" class="form-control" required>
								
							</div>
					</div>

					<div class="row">
						<div class="col-md-6 col-md-offset-3">
								<label for="Nombre">Nombre</label>
								<input type="text" name="nombre" placeholder="Digite nombre del nuevo usuario Coordinador" class="form-control" required>
							</div>
					</div>

					<div class="row">
						<div class="col-md-6 col-md-offset-3">
								<label>Email 1</label>
								<input type="text" name="email_1" placeholder="Digite e-mail" class="form-control" >
							</div>
					</div>

					<div class="row">
						<div class="col-md-6 col-md-offset-3">
								<label>Email 2</label>
								<input type="text" name="email_2" class="form-control" >
							</div>
					</div>

					<div class="row">
						<div class="col-md-6 col-md-offset-3">
								<label>Email 3</label>
								<input type="text" name="email_3" class="form-control" >
							</div>
					</div>

					<div class="row">
						<div class="col-md-6 col-md-offset-3">
								<label>Email 4</label>
								<input type="text" name="email_4" class="form-control" >
							</div>
					</div>

					 <div class="row">
						<div class="col-md-6 col-md-offset-3">
								<label for="clave">Clave</label>
								<input type="password" name="clave" placeholder="Digite clave del nuevo usuario Coordinador" class="form-control" required>
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
		</div>
	</body>
</html>