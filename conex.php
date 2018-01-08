<?php
	session_start();
	$conexion = mysqli_connect('www.clsolutions.com.co', 'id2431471_proyec', 'id2431471_proyec', 'id2431471_recursos');
	if (!$conexion) {
	    die('No pudo conectarse: ' . mysql_error());
	} else{
		
		// echo 'Conectado satisfactoriamente';
	}	
?>