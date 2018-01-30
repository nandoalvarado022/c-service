<?php	
	include "conex.php";	
	if (isset ($_POST['usuario'])) {
		$pro = $_POST['usuario'];
		$cla = $_POST['password'];
		$nompro = '';
		$query = "select nombre, grupo from usuarios where codigo = $pro and pwd=$cla";
		$resulta = mysqli_query($conexion, $query);
		$rows = mysqli_num_rows($resulta);
		if ($rows > 0) {
			while($nombre = mysqli_fetch_array($resulta)) {
			 	$_SESSION['nomuser'] = $nombre[0];
				$_SESSION['grpuser'] = $nombre[1];
				$_SESSION['coduser'] = $pro;

				switch ($_SESSION['grpuser']) {
					case 'CON':
						$_SESSION['cod_contratista'] = $pro;
					break;

					case 'CUA':
						$_SESSION['cod_cuadrilla'] = $pro;
						$query = "SELECT cod_contratista FROM cuadrillas where codigo = $pro";
						$resulta = mysqli_query($conexion, $query);
						$rows = mysqli_num_rows($resulta);
						if ($rows > 0) {
							while($data = mysqli_fetch_array($resulta)) {
								$_SESSION['cod_contratista'] = $data["cod_contratista"];
								
							}
						}
					break;
				}
			   	mysqli_close($conexion);      // cierra la conexion
		 		header('Location: entro.php');
			}
		} else{
	 		mysqli_close($conexion); // cierra la conexion
//	 		echo("Error  " . mysqli_error($conexion));
	 	    // header('Location: error.php');
		}
	}
?>