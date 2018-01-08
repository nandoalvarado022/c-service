<?php
include "conex.php";
// include "PHPMailerAutoload.php";
foreach($_GET as $nombre_campo => $valor){ 
   	$asignacion = "\$" . $nombre_campo . "='" . $valor . "';"; 
   	eval($asignacion); 
}

// print_r($_GET);
// echo $cod_contratista;
// exit();

switch ($causa) {

	case 'contratista':
		$cod_contratista = isset($cod_contratista) ? $cod_contratista : "0";
		
		$sql = "select nombre from contratistas where codigo = $cod_contratista";   // cod_contratista es la variable que viene
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
		echo $sql =  "INSERT INTO servicios VALUES ('$codigo_servicio', '$busca_cliente', '$busca_cuadrilla', '$busca_contratista', '$fecha', '$direccion', '$valor_total', null)";
		
		if (!mysqli_query($conexion, $sql)) {
			echo "Error: " . mysqli_error($conexion);
		}
	break;

	case 'guardando_tabla_servicios_html_excel':
		$sql = "insert into tbl_html_to_excel values(null, '".$tblExport."')";
		$resulta = mysqli_query($conexion, $sql);
		// echo 
		echo $codigo_excel = mysqli_insert_id($conexion);
		// enviando el correo        
        // echo 
        $sql = "SELECT mail_1, mail_2, mail_3, mail_4 FROM contratistas where codigo=".$_SESSION["cod_contratista"];		
        $resulta = mysqli_query($conexion, $sql) or die ("error en consulta contratistas") ;
        $rows = mysqli_num_rows($resulta);
	    if ($rows > 0) {
	       	while($res = mysqli_fetch_array($resulta)) {
		       	for ($count=0; $count <= 3 ; $count++) {
		       		// echo "<br>Enviado a:";
		       		// echo $res[$count];
		       		$mensa = 'Sr Contratista : Ud puede visualizar el archivo de excel en el siguiente vinculo
		       		<a href="http://softwareydiseno.clsolutions.com.co/print_excel_servicio.php?codigo_documento='.$codigo_excel.'">
		       		http://softwareydiseno.clsolutions.com.co/print_excel_servicio.php?codigo_documento='.$codigo_excel."
		       		</a>";
		       		$cabeceras  = 'MIME-Version: 1.0' . "\r\n";
					$cabeceras .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

					// Cabeceras adicionales
					// $cabeceras .= 'To: Mary <mary@example.com>, Kelly <kelly@example.com>' . "\r\n";
					// $cabeceras .= 'From: Recordatorio <cumples@example.com>' . "\r\n";
					// $cabeceras .= 'Cc: birthdayarchive@example.com' . "\r\n";
					// $cabeceras .= 'Bcc: birthdaycheck@example.com' . "\r\n";
		       		mail($res[$count], "Archivo Excel", $mensa, $cabeceras);
		       	}
	       	}
	    }
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
	   $sql = "select nombre from clientes where codigo = $cod_cliente";  // cod_cliente es la variable que viene
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