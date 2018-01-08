<?php
	$_POST["mail_1"] = isset($_POST["mail_1"]) ? $_POST["mail_1"] : "";
	$_POST["mail_2"] = isset($_POST["mail_2"]) ? $_POST["mail_2"] : "";
	$_POST["mail_3"] = isset($_POST["mail_3"]) ? $_POST["mail_3"] : "";
	$_POST["mail_4"] = isset($_POST["mail_4"]) ? $_POST["mail_4"] : "";
  	include "conex.php";
	echo
	$query = "select codigo, nombre from usuarios where codigo = $_POST[codigo]";
 	$resulta = mysqli_query($conexion, $query);
 	$rows = mysqli_num_rows($resulta);
   	if ($rows > 0) header('Location: entro.php?msg=El código '.$_POST["codigo"].' ya se encuentra en la BD.');
  	echo 
  	$query =  "INSERT INTO usuarios (codigo, nombre, pwd, grupo) VALUES ('$_POST[codigo]', '$_POST[nombre]', '$_POST[clave]', 'CON')";
	mysqli_query($conexion, $query);

	echo 
	$query =  "INSERT INTO contratistas (codigo, mail_1, mail_2, mail_3, mail_4) VALUES ('$_POST[codigo]', '$_POST[email_1]', '$_POST[email_2]', '$_POST[email_3]', '$_POST[email_4]')";
	mysqli_query($conexion, $query);
	header('Location: entro.php?msg=Registro corecto.');
?>