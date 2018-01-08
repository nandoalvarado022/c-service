<?php session_start();?>
<!DOCTYPE html>
<html>
	<head>
		<?php include "header.php"; 
		include "conex.php";?>
	</head> 
	 
	<body>
		<div class="group container">
			<header>
				<?php include "bienvenido.php";?>
			</header>
			
			<h3>Registro de 
				<span class="label label-default">Cuadrilla</span>
			</h3>
			<?php 
			$sql="select * from cuadrillas where cod_contratista='$_SESSION[coduser]'";
			$res = mysqli_query($conexion, $sql);
			$rows = mysqli_num_rows($res);?>
			<div class="alert alert-info" role="alert">
				Cantidad cuadrillas disponibles para crear:
			  	<b><?php echo (5-$rows);?></b>
			</div>
			<?php
			if ($rows < 5) {?>
				<form action="registro_cuadrilla.php" method="POST">
					
					<div class="row">
						<div class="col-md-6 col-md-offset-3">
						<label for="Nit">Codigo</label>
						<input type="number" name="codigo" placeholder="Digite codigo del nueva Cudrilla" class="form-control" required>
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
								<label for="clave">Clave</label>
								<input type="password" name="clave"placeholder="Digite clave del nuevo usuario Coordinador"  class="form-control" required>
							</div>
					</div>

					<br>

					<div class="row">
					  	<div class="col-md-6 col-md-offset-3 text-center">
					  	<input class="btn btn-default" onClick="window.location.href='entro.php'" name="submit" type="button" value="Volver">
						<input class="btn btn-success" name="submit" type="submit" value="Registrar" />
						</div>
					</div>         
			  	</form>
			  	<?php
			} else{?>
				<div class="alert alert-danger" role="alert">
				  	<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
				  	<span class="sr-only">Error:</span>
				  	Usted supero el limite de cuadrillas.
				  	<a class="btn btn-default" href="entro.php">Volver</a>
				</div>
				<?php
			}?>
		</div>
	</body>
</html>