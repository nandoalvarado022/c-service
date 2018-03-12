<?php
include "conex.php";
foreach($_POST as $nombre_campo => $valor){ 
	$asignacion = "\$" . $nombre_campo . "='" . $valor . "';"; 
	eval($asignacion); 
 }
/*
if (isset ($_POST['nit'])) {
 	$wnit = $_POST['nit'];
 	$wnombre = $_POST['nombre'];
 	// $correo = $_POST['correo'];
 	$resulta = mysqli_query($conexion,"select codigo,nombre from clientes where Codigo = $wnit");
 	$rows = mysqli_num_rows($resulta);
 	if ($rows > 0) {  
		header('Location: entro.php?msg=No se pudo crear el cliente, contacte al administrador.');
	} else {*/
		$sql =  "INSERT INTO servicios(id, nombre, empresa) VALUES ('$nit', '$nombre', $empresa)";
		if (mysqli_query($conexion, $sql)) {
			header('Location: entro.php?msg=Registro con éxito.');
		}
		/*
 	}
}		*/
?>