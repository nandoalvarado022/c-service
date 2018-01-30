<?php
	include "conex.php";
	foreach($_GET as $nombre_campo => $valor){
		$asignacion = "\$" . $nombre_campo . "='" . $valor . "';";
		eval($asignacion);
	}
	
	foreach($_POST as $nombre_campo => $valor){
		$asignacion = "\$" . $nombre_campo . "='" . $valor . "';";
		eval($asignacion);
	}
	// print_r($_REQUEST);
	// recibiendo variables

	switch ($tipo_usuario) {
		// $_POST["mail_1"] = isset($_POST["mail_1"]) ? $_POST["mail_1"] : "";
		// $_POST["mail_2"] = isset($_POST["mail_2"]) ? $_POST["mail_2"] : "";
		// $_POST["mail_3"] = isset($_POST["mail_3"]) ? $_POST["mail_3"] : "";
		// $_POST["mail_4"] = isset($_POST["mail_4"]) ? $_POST["mail_4"] : "";
		case "EC":
			// cod_contratista es empresa padre
			$empresa_padre_cod=$_SESSION["coduser"];
			$query="INSERT INTO clientes (nombre, estado, empresa_padre) VALUES ('$nombre', 1, $empresa_padre_cod)";
			if(mysqli_query($conexion, $query)) header('Location: crea_usuarios.php?msg=Se creo la empresa cliente con exito!.');
			else header('Location: crea_usuarios.php?msg=Ocurrio un error, por favor comunicarse con el administrador.');
		break;

		case "EP":
			validar_usuario($codigo);
			if(ingresar_usr($codigo, $nombre, $clave, 'EP')) header('Location: crea_usuarios.php?msg=Se creo el registro con el código '.$codigo.' con exito!.');
			else header('Location: crea_usuarios.php?msg=Ocurrio un error, por favor comunicarse con el administrador.');
		break;

		case "COO":
			validar_usuario($codigo);
			if(ingresar_usr($codigo, $nombre, $clave, 'COO')){
				$empresa_padre_cod=$_SESSION["coduser"];
				$query="INSERT INTO coordinadores(codigo, empresa_padre) VALUES($codigo, $empresa_padre_cod)";
				mysqli_query($conexion, $query);
				header('Location: crea_usuarios.php?msg=Se creo el registro con el código '.$codigo.' con exito!.');
			} else header('Location: crea_usuarios.php?msg=Ocurrio un error, por favor comunicarse con el administrador.');
		break;
	}

	function validar_usuario($codigo_usr){
		global $conexion;
		$query = "select codigo, nombre from usuarios where codigo = $codigo_usr";
		$resulta = mysqli_query($conexion, $query);
		$rows = mysqli_num_rows($resulta);
		if ($rows > 0) header('Location: crea_usuarios.php?msg=El código '.$codigo.' ya se encuentra en la BD.');
	}

	function ingresar_usr($codigo, $nombre, $clave, $tipo){
		global $conexion;
		$query="INSERT INTO usuarios (codigo, nombre, pwd, grupo) VALUES ('$codigo', '$nombre', '$clave', '$tipo')";
		return mysqli_query($conexion, $query);
	}
?>