<?php
session_start();?>
<!DOCTYPE html>
<html lang="es">
	<head>		
		<link rel="stylesheet" type="text/css" href="cabecera.css">
		<link rel="stylesheet" type="text/css" href="diseño_forms.css">		
		<?php include "header.php";?>
	</head>
	<body id="panel_entro">
		<div class="container">
		<header>
			<?php
				include "bienvenido.php";
			?>	
			
		</header>
			
		<?php print isset($_GET["msg"]) ? '<br><div class="alert alert-warning" role="alert">'.$_GET["msg"].'</div>' : "";?>

		<ul class="nav">
			<?php 
			if (in_array($_SESSION['grpuser'], array("ADM", "CUA", "CON"))) {?>
				<div class="row">
					<div class="col-xs-10 col-xs-offset-1 col-md-6 col-md-offset-3 text-center">
						<li>
							<span class="glyphicon glyphicon-folder-open"></span>
							<a href="crea_cabecera.php">Actualizar Servicio ó Captura de Actividad</a>
						</li>
					</div>
				</div>
				<?php 
			}

			if (in_array($_SESSION['grpuser'], array("ADM", "CON"))) {?>
				<div class="row">
					<div class="col-xs-10 col-xs-offset-1 col-md-6 col-md-offset-3 text-center">
						<li>
							<span class="glyphicon glyphicon-user"></span>
							<a href="crea_clientes.php">Creación de Servicio/Proyecto</a>
						</li>
					</div>
				</div>
				<?php 
			}

			if (in_array($_SESSION['grpuser'], array("ADM", "CON"))) {?>
				<div class="row">
					<div class="col-xs-10 col-xs-offset-1 col-md-6 col-md-offset-3 text-center">
						<li>
							<span class="glyphicon glyphicon-flag"></span>
							<a href="crea_cuadrilla.php">Creacion De Cuadrillas</a>
						</li>
					</div>
				</div>
				<?php 
			}
			
			if (in_array($_SESSION['grpuser'], array("ADM"))) {?>
				<div class="row">
					<div class="col-xs-10 col-xs-offset-1 col-md-6 col-md-offset-3 text-center">
					 	<li>
							<span class="glyphicon glyphicon-folder-open"></span>
							<a href="crea_usuarios.php">Creación de Coordinador</a>
					 	</li>
					</div>
				</div>
			 	<?php
			}

			if (in_array($_SESSION['grpuser'], array("ADM", "CON"))) {?>
				<div class="row">
					<div class="col-xs-10 col-xs-offset-1 col-md-6 col-md-offset-3 text-center">
						<li>
							<span class="glyphicon glyphicon-list-alt"></span>
							<a href="first-informe.php">Informes</a>
						</li>
					</div>
				</div>
				<?php 
			}

			if (in_array($_SESSION['grpuser'], array("ADM", "CUA", "CON"))) {?>
				<div class="row">
					<div class="col-xs-10 col-xs-offset-1 col-md-6 col-md-offset-3 text-center">
						<li>
							<span class="glyphicon glyphicon-remove"></span>
							<a href="salir.php">Salir</a>
						</li>
					</div>
				</div>
				<?php 
			}?>
		</ul>
	</body>
</html>