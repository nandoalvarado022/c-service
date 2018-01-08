<?php
include "conex.php";
if (isset ($_POST['nit'])) {
 	$wnit = $_POST['nit'];
 	$wnombre = $_POST['nombre'];
 	// $correo = $_POST['correo'];
 	$resulta = mysqli_query($conexion,"select codigo,nombre from clientes where Codigo = $wnit");
 	$rows = mysqli_num_rows($resulta);
 	if ($rows > 0) {  
		header('Location: entro.php?msg=No se pudo crear el cliente, contacte al administrador.');
	} else {
		$inserta =  "INSERT INTO clientes VALUES ('$wnit', '$wnombre', 1, null, $_SESSION[cod_contratista])";
		if (mysqli_query($conexion, $inserta)) {
			header('Location: entro.php?msg=Registro con exito.');
		}
 	}
}		
?>