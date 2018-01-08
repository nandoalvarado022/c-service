<?php
ini_set( 'upload_max_size' , '12M' );
ini_set( 'post_max_size', '13M');
ini_set( 'memory_limit', '15M' );
include "conex.php";
// include "PHPMailerAutoload.php";
foreach($_GET as $nombre_campo => $valor){
   	$asignacion = "\$" . $nombre_campo . "='" . $valor . "';";
   	eval($asignacion);
}

foreach($_POST as $nombre_campo => $valor){
   	$asignacion = "\$" . $nombre_campo . "='" . $valor . "';";
   	eval($asignacion);
}

switch ($causa) {
	case 'subir_foto':
		$file = $_FILES[$name_element];
	    $nombre = $file["name"];
	    $tipo = $file["type"];
	    $ruta_provisional = $file["tmp_name"];
	    $size = $file["size"];
	    $dimensiones = getimagesize($ruta_provisional);
	    $width = $dimensiones[0];
	    $height = $dimensiones[1];
	    $carpeta = "images/captura_servicios/";
	    $fecha = new DateTime();
		$fecha->getTimestamp();
        echo $destino = $carpeta.$fecha->getTimestamp().".jpg";
        move_uploaded_file($ruta_provisional, $destino);
	break;

	case 'busca_cuadrilla_x_contratista':
		echo $sql = "select codigo, nombre from cuadrillas where cod_contratista = $cod_contratista";  // cod_cuadrilla es la variable que viene
		$resulta = mysqli_query($conexion, $sql);
		$rows = mysqli_num_rows($resulta);
		if (!$rows > 0) { echo '0';
		} else {
			while($data = mysqli_fetch_array($resulta)) {
				echo "<option value='".$data[0]."'>".$data[1]."</option>";
			}
		}	 
	break;

	case 'contratista':
		$cod_contratista = isset($cod_contratista) ? $cod_contratista : "0";
		
		$sql = "select nombre from usuarios where codigo = $cod_contratista";   // cod_contratista es la variable que viene
		$resulta = mysqli_query($conexion, $sql);
		$rows = mysqli_num_rows($resulta);
		if ($rows > 0) {
			while($nombre = mysqli_fetch_array($resulta)) {
				$contratista = $nombre[0];
				echo $contratista;
				$_SESSION["cod_contratista"] = $cod_contratista;
			}			
		} else {
			echo '0';
	   }
	break;

	case 'guardando_servicio':
		echo $sql =  "INSERT INTO servicios_cab VALUES (null, '$idservicio', $codigo_html_to_excel, '$busca_cuadrilla', '$busca_contratista', '$fecha', '$direccion', '$vlrtotal', null, '$descripcion', '$observaciones')";
		echo "<br>";
	
		if (!mysqli_query($conexion, $sql)) {
			echo "Error: " . mysqli_error($conexion);
		}

		// echo "<pre>"; print_r(json_decode($items)); echo "</pre>";
		foreach (json_decode($items) as $key => $value) {
			$sql = "INSERT into servicios_det values (null, '$idservicio', $codigo_html_to_excel, '$value->id_item', '".str_replace("<br>", " ", $value->cantidad)."', ".str_replace(",", ".", str_replace(".", "", $value->vlrtotal)).", null)";
			$resulta = mysqli_query($conexion, $sql);
		  	// echo("Error description: " . mysqli_error($resulta));

		}
	break;

	case 'guardando_tabla_servicios_html_excel':
		$sql = "insert into tbl_html_to_excel values(null, '".$codigo_servicio."', '".$tblExport."', null)";
		$resulta = mysqli_query($conexion, $sql);
		// echo 
		$codigo_html_to_excel = mysqli_insert_id($conexion);
		// enviando el correo        
        // echo 
        $sql = "SELECT mail_1, mail_2, mail_3, mail_4 FROM contratistas where codigo=".$contratista;
        $resulta = mysqli_query($conexion, $sql) or die ("error en consulta contratistas") ;
        $rows = mysqli_num_rows($resulta);
	    if ($rows > 0) {
	       	while($res = mysqli_fetch_array($resulta)) {
		       	for ($count=0; $count <= 3 ; $count++) {
		       		// echo "<br>Enviado a:";
		       		// echo $res[$count];
		       		$mensa = 'Sr Contratista usted puede visualizar el archivo de excel en el siguiente vinculo
		       		<a href="http://clsolutions.com.co/c-services/print_excel_servicio.php?codigo_documento='.$codigo_html_to_excel.'">
		       		http://clsolutions.com.co/c-services/print_excel_servicio.php?codigo_documento='.$codigo_html_to_excel."
		       		</a>";
		       		$cabeceras = 'MIME-Version: 1.0' . "\r\n";
					$cabeceras .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
					$cabeceras .= 'From: Abarreto <info@softwareydiseno.com>' . "\r\n";
					// Cabeceras adicionales
					// $cabeceras .= 'To: Mary <mary@example.com>, Kelly <kelly@example.com>' . "\r\n";
					// $cabeceras .= 'From: Recordatorio <cumples@example.com>' . "\r\n";
					// $cabeceras .= 'Cc: birthdayarchive@example.com' . "\r\n";
					// $cabeceras .= 'Bcc: birthdaycheck@example.com' . "\r\n";
		       		mail($res[$count], "Archivo Excel", $mensa, $cabeceras);
		       		// mail("nandoalvarado022@gmail.com", "Archivo Excel", $mensa, $cabeceras); break;
		       	}
	       	}
	    }
	    print json_encode(array('codigo_html_to_excel' => $codigo_html_to_excel));
	break;

	case 'item_hijo':
		$sql = "select subcodigo, nombre, unidad, vlrunitario from
		item_hijo ih where ih.codigo = ".$codigo_padre;

		$resulta = mysqli_query($conexion, $sql);
		$rows = mysqli_num_rows($resulta);
		if ($rows > 0) {
			echo "<option value=''>Seleccione</option>";
			while($registro=mysqli_fetch_row($resulta)){
				echo "<option data-vlrunitario='".$registro[3]."' data-unidad='".$registro[2]."' value='".$registro[0]."'>".utf8_encode($registro[1])."</option>";
			}
		} else{
			echo 0;
		}
	break;

	case 'cuadrilla':   		
		$sql = "select nombre from cuadrillas where codigo = $cod_cuadrilla";  // cod_cuadrilla es la variable que viene
		$resulta = mysqli_query($conexion, $sql);
		$rows = mysqli_num_rows($resulta);
		if (!$rows > 0) {
			echo '0';
		} else {
			while($nombre = mysqli_fetch_array($resulta)) {
				echo $cuadrilla = $nombre[0];
			}
		}	   
	break;

	case 'cliente':		
	   	$sql = "select nombre from clientes where cod_contratista = $_SESSION[cod_contratista] and codigo = $cod_cliente"; // cod_cliente es la variable que viene
	   	$resulta = mysqli_query($conexion, $sql);
	   	$rows = mysqli_num_rows($resulta);
	   	if (!$rows > 0) {
			echo '0';		  
		} else {
			while($nombre    = mysqli_fetch_array($resulta)) {
				echo $cliente = $nombre[0];
			}
		}	   
	break;
}