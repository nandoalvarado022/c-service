<?php 
// print session_status();
// if (session_status()!=1){ session_start();}
if(isset($_SESSION["grpuser"])){
    // print_r($_SESSION);
}
// if($_SESSION['grpuser']!="ADM") header('Location: index.php?msg=No tiene permiso para ver esto.');
$cod_contratista=isset($_SESSION["cod_contratista"]) ? $_SESSION["cod_contratista"] : ""; ?>
<?php include "conex.php";
// echo "<pre>"; print_r($_SESSION); echo "</pre>";
?>
<!DOCTYPE html>
<html lang="es">
	<head>
		<?php include "header.php";?>
	</head>

	<body id="admin_herramientas">
		<div class="container">
			<header>
				<?php include "bienvenido.php";?>
			</header>

            <h3 style="margin: 20px 0 30px; text-align: center;">Administrador de <span class="label label-default">Usuarios</span></h3>
			<div>
				<form action="">
					
					<input class="form-control margin-bottom" type="text" placeholder="Nombre">
					<input class="form-control margin-bottom" type="email" name="" placeholder="Correo electronico">
				</form>
			</div>
        </div>
    </body>
</html>