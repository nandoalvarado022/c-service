<?php 
$cod_contratista=isset($_SESSION["cod_contratista"]) ? $_SESSION["cod_contratista"] : ""; ?>
<?php include "conex.php";
include "functions.php";
?>
<!DOCTYPE html>
<html>
	<head><meta http-equiv="Content-Type" content="text/html; charset=gb18030">		
		<?php include "header.php";?>
	</head>
	<body>
	 	<div class="group container">
	 		<header>
				<?php include "bienvenido.php";?>
			</header>
			<h3 style="margin: 20px 0 30px; text-align: center;">Registro de <span class="label label-default">Servicios/Proyectos </span></h3>

		 	<form action="registro_clientes.php" method="POST">			  	
			  	<div class="row">
					<div class="col-md-6 col-md-offset-3">
						<label for="Nit">ID de Servicio/Proyecto</label>
			  			<input type="text" name="nit" class="form-control" required>
			  		</div>
				</div>
				<br>
				<div class="row">
					<div class="col-md-6 col-md-offset-3">
				  		<label for="Nombre">Nombre</label>
				  		<input type="text" name="nombre" class="form-control" required>
			  		</div>
				</div>
				<br>
				<div class="row">
					<div class="col-md-6 col-md-offset-3">
				  		<label for="Nombre">Empresa</label>
						<select id="cmb_empresa_cliente" class="form-control" name="">%
							<option value="">Seleccione</option>';
							<?php print cmb_empresa_cliente();?>
						</select>
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
	 	</div>
	</body>
</html>