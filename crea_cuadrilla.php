<!DOCTYPE html>
<html>
	<head>
		<?php 
		include "header.php"; 
		include "conex.php";
		// print_r($_SESSION);
		?>
	</head> 
	 
	<body>
		<div class="group container">
			<header>
				<?php include "bienvenido.php";?>
			</header>
			
			<h3 style="margin: 20px 0 30px; text-align: center;">Creación de <span class="label label-default">Cuadrilla</span></h3>

			<?php 
			$sql="select * from cuadrillas where cod_coordinador='$_SESSION[coduser]'";
			$res = mysqli_query($conexion, $sql);
			$rows = mysqli_num_rows($res);?>
			<div class="alert alert-info col-md-4 col-md-offset-4" role="alert">
				Cantidad cuadrillas disponibles para crear:
			  	<b><?php echo (5-$rows);?></b>
			</div>
			<?php
			if ($rows < 5) {?>
				<form action="registro_cuadrilla.php" method="POST">
					
					<div class="row margin-bottom">
						<div class="col-md-6 col-md-offset-3">
						<input type="number" name="codigo" placeholder="Codigo" class="form-control" required>
						</div>
					</div>

					<div class="row margin-bottom">
					  	<div class="col-md-6 col-md-offset-3">
							<input type="text" name="nombre" placeholder="Nombre" class="form-control" required>
						</div>
					</div>

					 <div class="row margin-bottom">
						<div class="col-md-6 col-md-offset-3">
							<input type="password" name="clave"placeholder="Contraseña"  class="form-control" required>
						</div>
					</div>

					<div>
					  	<div class="col-md-6 col-md-offset-3 text-center">
					  	<input class="btn btn-default margin-right" onClick="window.location.href='entro.php'" name="submit" type="button" value="Volver">
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