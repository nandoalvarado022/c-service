<?php 
	// Cabeceras adicionales
	// $cabeceras .= 'To: Mary <mary@example.com>, Kelly <kelly@example.com>' . "\r\n";
	$cabeceras = 'From: Abarreto <info@softwareydiseno.com>' . "\r\n";
	// $cabeceras .= 'Cc: birthdayarchive@example.com' . "\r\n";
	// $cabeceras .= 'Bcc: birthdaycheck@example.com' . "\r\n";
	$mensaje = "Hola";
	mail("nandoalvarado022@gmail.com", "Archivo Excel", $mensaje, $cabeceras);
?>