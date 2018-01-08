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

		
	</body>
</html>