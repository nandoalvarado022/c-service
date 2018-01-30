<?php
include "conex.php";
if (isset ($_POST['codigo'])) {
	$wnit = $_POST['codigo'];
	$wnombre = $_POST['nombre'];
	$wclave  = $_POST['clave'];
	// echo 
	$query = "select codigo, nombre from cuadrillas where codigo = $wnit";
	$resulta = mysqli_query($conexion, $query);
	$rows = mysqli_num_rows($resulta);
	if ($rows > 0) {
		header('Location: entro.php?msg=La cuadrilla con el codigo '.$wnit.' ya se encuentra en la BD.');
	} else {
		// echo
		$query =  "INSERT INTO cuadrillas (codigo, nombre, cod_coordinador) VALUES ('$wnit', '$wnombre', '".$_SESSION["coduser"]."')";
		$resulta = mysqli_query($conexion, $query);
		$gru = 'CUA';
		$query =  "INSERT INTO usuarios (codigo, nombre, pwd, grupo) VALUES ('$wnit', '$wnombre', '$wclave', '$gru')";
		$resulta = mysqli_query($conexion, $query);
		header('Location: entro.php?msg=Registro creado.');
	}
} 
?>