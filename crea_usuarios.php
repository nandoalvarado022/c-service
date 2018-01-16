<?php 
$cod_contratista=isset($_SESSION["cod_contratista"]) ? $_SESSION["cod_contratista"] : ""; ?>
<?php include "conex.php";?>
<!DOCTYPE html>
<html>
	<head>		
		<?php include "header.php";?>			 
	</head>  
	<body>
		<div class="container">
			<header>
				<?php include "bienvenido.php";?>
			</header>

            <h3 style="margin: 20px 0 30px; text-align: center;">Administrador de <span class="label label-default">Coordinador</span></h3>

			<div class="group container">
				<form action="registro_usuarios.php" method="POST">
						<div class="row">
						<div class="col-md-6 col-md-offset-3">
							<label for="Nit">Codigo</label>
								<input type="number" name="codigo" placeholder="Digite codigo del nuevo usuario Coordinador" class="form-control" required>
								
							</div>
					</div>
					<br>
					<div class="row">
						<div class="col-md-6 col-md-offset-3">
								<label for="Nombre">Nombre</label>
								<input type="text" name="nombre" placeholder="Digite nombre del nuevo usuario Coordinador" class="form-control" required>
							</div>
					</div>
					<br>
					<div class="row">
						<div class="col-md-6 col-md-offset-3">
								<label>Email</label>
								<input type="text" name="email_1" placeholder="Digite e-mail" class="form-control" >
							</div>
					</div>
					<br>
					 <div class="row">
						<div class="col-md-6 col-md-offset-3">
								<label for="clave">Clave</label>
								<input type="password" name="clave" placeholder="Digite clave del nuevo usuario Coordinador" class="form-control" required>
							</div>
					</div>
					<br>
					<div class="row">
						<div class="col-md-3 col-md-offset-3 text-center">
							<input class="btn btn-default" onClick="window.location.href='entro.php'" name="submit" type="button" value="Volver">
						</div>
						<div class="col-md-3 text-center">
							<input class="btn btn-success" name="submit" type="submit" value="Registrar" />
						</div>
					</div>         
				</form>
			</div>
		</div>
	</body>
</html>